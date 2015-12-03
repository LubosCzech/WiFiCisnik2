<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\I18n\Time;

/**
 * Menu Controller
 *
 * @property \App\Model\Table\MenuTable $Menu
 */
class MenuController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function indexAdm()
    {
        $this->set('menu', $this->paginate($this->Menu));
        $this->set('_serialize', ['menu']);
    }

    public function index()
    {

        $session = $this->request->session();

        if (!$this->Cookie->check('WiFiCisnik.RestaurantID')) {
            $this->set('isRestaurantID', 'false');
        } else {
            $this->set('isRestaurantID', 'true');
        }

        $restaurant_id = $this->Cookie->read('WiFiCisnik.RestaurantID');
        $this->Cookie->write('WiFiCisnik.RestaurantID',$restaurant_id);

        $rest_query = $this->Restaurant
            ->find()
            ->where(['Restaurant.ID' => $restaurant_id
            ])
            ->contain(['Configuration']);

        $restaurant = $rest_query->first();

        $this->set('restaurant', $restaurant);

        if ($this->request->is(['ajax'])) {
            //Product removed
            $product_id_remove = $this->request->query('product_id');
            if($product_id_remove!="" && $this->request->query('remove')){
                if ($session->check('Cart.Products')) {
                    $products_cart = $session->read('Cart.Products');
                    $new_products_cart = array();
                    foreach ($products_cart as $product) {
                        if ($product->ID === $product_id_remove) {
                            $product->Count -= 1;
                            if($product->Count!=0){
                                array_push($new_products_cart,$product);
                            }
                        }else{
                            array_push($new_products_cart,$product);
                        }
                    }

                    if(!empty($new_products_cart))
                    {
                        $session->write([
                            'Cart.Products' => $new_products_cart,
                        ]);
                        $this->set('isCart', 'true');
                        $this->set('productRemoved','true');
                        $this->set('cart', $session->read('Cart'));
                    }else{
                        $session->delete('Cart');
                        $this->set('isCart', 'false');
                        $this->set('isEmpty','true');
                    }
                    $this->render('../Element/cart_container');
                    return;
                }
            }

            //Product added to cart
            $product_id = $this->request->query('product_id');
            if($product_id!="" && $this->request->query('add')){
                $product_id_cart = $this->request->query['product_id'];
                $product_count_cart = $this->request->query['product_count'];
                $product_cart = $this->Product->get($product_id_cart);
                $category_active = $this->request->query['category_id'];

                $product_line = (object)['ID' => $product_id_cart, 'Name' => $product_cart['Name'], 'Price' => $product_cart['Price'], 'Count' => $product_count_cart];

                if ($session->check('Cart.Products')) {
                    $products_cart = $session->read('Cart.Products');
                    $product_found_in_cart = false;
                    foreach ($products_cart as $product) {
                        if ($product->ID === $product_id_cart) {
                            $product->Count += $product_count_cart;
                            $product_found_in_cart = true;
                        }
                    }
                    if (!$product_found_in_cart) {
                        array_push($products_cart, $product_line);
                    }
                    $session->write([
                        'Cart.Products' => $products_cart,
                    ]);
                } else {
                    $products_cart = array();
                    array_push($products_cart, $product_line);
                    $session->write([
                        'Cart.Place_ID' => $this->Cookie->read('WiFiCisnik.PlaceID'),
                        'Cart.Guest_ID' => $this->Cookie->read('WiFiCisnik.GuestID'),
                        'Cart.Products' => $products_cart,
                    ]);
                }
                $this->set('isCart', 'true');
                $this->set('cart', $session->read('Cart'));
                $this->set('isNewProductInCart', 'true');
                $this->set('lastActiveCategory',$category_active);
                $this->render('/Element/cart_container');
            }
        }

        //Show cart if not empty
        if ($session->check('Cart')) {
            $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
            $guestID_session = $session->read('Cart.Guest_ID');
            if ($guestID_cookie === $guestID_session) {
                $this->set('isCart', 'true');
                $this->set('cart', $session->read('Cart'));
            } else {
                $session->delete('Cart');
                $this->set('isCart', 'false');
            }
        } else {
            $this->set('isCart', 'false');
        }
        //Initial variables
        $this->set('isNewProductInCart', 'false');

        if($this->request->query('cartEmpty')){
            $this->set('cartEmpty','true');
        }

        //Post request
        if ($this->request->is(['post'])) {
            //Proces order
            if ($this->request->data('sendOrder') == 1) {
                //Get guestID
                $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
                //Get placeID
                $placeID_cookie = $this->Cookie->read('WiFiCisnik.PlaceID');
                //Get restaurantID
                $restaurantID_cookie = $this->Cookie->read('WiFiCisnik.RestaurantID');
                //Get payMethod
                $payment_ID = $this->request->data['payMethod'];
                $payMethod = $this->Payment->get($payment_ID, [
                    'contain' => []
                ]);

                //Save order
                $orders = $this->processCart($session);

                //Note
                $noteText = $this->request->data['note'];
                if(isset($noteText)&&!is_null($noteText)&&$noteText!=""){
                    $note = $this->Note->newEntity();
                    $note->Text = $noteText;
                    $note->OrderGuest_ID = $orders[0]->ID;
                    $note->Guest_ID = $guestID_cookie;
                    $this->Note->save($note);
                }

                //Cash paymethod
                if ($payMethod->Code === 'cash') {
                    //process payment
                    //No process because cash
                    //finish order
                    $session->write([
                        'WiFiCisnik.Payment.Order_ID' => $orders[0]->ID,
                        'WiFiCisnik.Payment.GPdata' => null,
                        'WiFiCisnik.Payment.Paymethod' => $payMethod,
                        'WiFiCisnik.Payment.Restaurant_ID' => $restaurantID_cookie,
                        'WiFiCisnik.Payment.Guest_ID' => $guestID_cookie,
                        'WiFiCisnik.Payment.Place_ID' => $placeID_cookie,
                        'WiFiCisnik.Payment.PaymentState' => 3,
                        'WiFiCisnik.Payment.ResultText' => 'Proveďte platbu u obsluhy',
                    ]);

                    return $this->redirect(['controller' => 'Payment', 'action' => 'finish']);


                }
                if ($payMethod->Code == 'masterpass') {
                    //Process payment
                    $guest_order = $orders[0];
                    $total_price = $guest_order->TotalPrice . '00';
                    $currency = 203;
                    $deposit_flag = 0;
                    $url = Router::url(array('controller' => 'Payment', 'action' => 'gpwebpay'), true);
                    $merch_id = '315200001';
                    $order_number = $guest_order->ID . rand(0, 9999999999);
                    $order_id = $guest_order->ID;
                    $data_sign = $data_sign = $merch_id . "|" . "CREATE_ORDER" . "|" . $order_number . "|" . $total_price . "|" . $currency . "|" . $deposit_flag . "|" . $order_id . "|" . $url . "|MPS";
                    $digest = $this->CSignature->sign($data_sign);
                    $gpdata = array('MERCHANTNUMBER' => $merch_id,
                        'OPERATION' => 'CREATE_ORDER',
                        'ORDERNUMBER' => $order_number,
                        'AMOUNT' => $total_price,
                        'CURRENCY' => $currency,
                        'DEPOSITFLAG' => $deposit_flag,
                        'MERORDERNUM' => $order_id,
                        'URL' => $url,
                        'PAYMETHOD' => 'MPS',
                        'DIGEST' => $digest);

                    $gpwebparams = http_build_query($gpdata);

                    $session->write([
                        'WiFiCisnik.Payment.Order_ID' => $orders[0]->ID,
                        'WiFiCisnik.Payment.GPdata' => $gpdata,
                        'WiFiCisnik.Payment.Paymethod' => $payMethod,
                        'WiFiCisnik.Payment.Restaurant_ID' => $restaurantID_cookie,
                        'WiFiCisnik.Payment.Guest_ID' => $guestID_cookie,
                        'WiFiCisnik.Payment.Place_ID' => $placeID_cookie,
                    ]);

                    return $this->redirect('https://3dsecure.gpwebpay.com/pgw/order.do?' . $gpwebparams);
                }

                if ($payMethod->Code == 'card_online') {
                    //Process payment
                    $guest_order = $orders[0];
                    $total_price = $guest_order->TotalPrice . '00';
                    $currency = 203;
                    $deposit_flag = 0;
                    $url = Router::url(array('controller' => 'Payment', 'action' => 'gpwebpay'), true);
                    $merch_id = '315200001';
                    $order_number = $guest_order->ID . rand(0, 9999999999);
                    $order_id = $guest_order->ID;
                    $data_sign = $merch_id . "|" . "CREATE_ORDER" . "|" . $order_number . "|" . $total_price . "|" . $currency . "|" . $deposit_flag . "|" . $order_id . "|" . $url;
                    $digest = $this->CSignature->sign($data_sign);
                    $gpdata = array('MERCHANTNUMBER' => $merch_id,
                        'OPERATION' => 'CREATE_ORDER',
                        'ORDERNUMBER' => $order_number,
                        'AMOUNT' => $total_price,
                        'CURRENCY' => $currency,
                        'DEPOSITFLAG' => $deposit_flag,
                        'MERORDERNUM' => $order_id,
                        'URL' => $url,
                        'DIGEST' => $digest);

                    $gpwebparams = http_build_query($gpdata);

                    $session->write([
                        'WiFiCisnik.Payment.Order_ID' => $orders[0]->ID,
                        'WiFiCisnik.Payment.GPdata' => $gpdata,
                        'WiFiCisnik.Payment.Paymethod' => $payMethod,
                        'WiFiCisnik.Payment.Restaurant_ID' => $restaurantID_cookie,
                        'WiFiCisnik.Payment.Guest_ID' => $guestID_cookie,
                        'WiFiCisnik.Payment.Place_ID' => $placeID_cookie,
                    ]);

                    return $this->redirect('https://3dsecure.gpwebpay.com/pgw/order.do?' . $gpwebparams);
                }
            }
        }

        //First enter to menu
        if (isset($_COOKIE['WCPID'])) {
            $place_code_Cookie = $_COOKIE['WCPID'];
            //$place = $this->Place->find()->where(['Place.Code ='=> $place_id_Cookie])->first();
            $query = $this->Place->find('all', [
                'conditions' => ['Code LIKE' => '%'.$place_code_Cookie.'%','Restaurant_ID'=>$restaurant_id]
            ]);
            $place = $query->first();
            $this->Cookie->write('WiFiCisnik.PlaceID', $place->ID);
            $this->Cookie->write('WiFiCisnik.PlaceName', $place->Name);
            setcookie('WCPID', '', time() - 3600);
            $this->set('isFirstEnter', 'true');

            $guest = $this->Guest->newEntity();
            $guest->Code = uniqid('wc_');
            $guest->Place_ID = $place->ID;
            $guest->Active = true;
            $guest->LastActive = Time::now('Europe/Prague');
            if ($this->Guest->save($guest)) {

                $this->Cookie->write('WiFiCisnik.GuestID', $guest->ID);
            }

        } else {
            $this->set('isFirstEnter', 'false');
        }

        if (!$this->Cookie->check('WiFiCisnik.PlaceID')) {
            // Pokud neni ID stolu, vyvolame dialog pro zadani
            $this->set('isPlaceID', 'false');
        } else {
            $this->set('isPlaceID', 'true');
            $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
            $current_guest = $this->Guest->get($guestID_cookie, [
                'contain' => []
            ]);

            $current_guest->Active = true;
            $current_guest->LastActive = Time::now('Europe/Prague');
            $this->Guest->save($current_guest);
        }

        $place_id = $this->Cookie->read('WiFiCisnik.PlaceID');

        $checkouts = $this->Checkout
            ->find()
            ->where(['Restaurant_ID =' => $restaurant_id])
            ->toArray();

        $places_valid = array();
        foreach ($checkouts as $checkout) {
            $places = $this->Place
                ->find()
                ->where(['Checkout_ID =' => $checkout->ID])
                ->toArray();
            $places_codes = array();
            foreach ($places as $single_place) {
                array_push($places_codes, $single_place->Code);
            }

            $places_valid = array_merge($places_valid, $places_codes);
        }
        $this->set('validPlaces', $places_valid);

        $menu = $this->Menu
            ->find()
            ->where(['Restaurant_ID =' => $restaurant_id])
            ->order(['Category_ID' => 'ASC'])
            ->toArray();

        $menu_tree = $this->createMenu($menu);

        $this->set('menu', $this->paginate($this->Menu));
        $this->set('_serialize', ['menu']);
        $this->set('menu_tree', $menu_tree);
        $this->set('img_path_prefix', Configure::read('App.imageBaseUrl'));


        $language = $this->Cookie->read('WiFiCisnik.Language');
        $localization = $this->Localization->find()->combine('Code', $language);
        $languageText = array();
        foreach ($localization as $code => $text){
            $languageText[$code] = $text;
        }
        $this->set('localization',$languageText);

    }

    private function createMenu($menu_db = null)
    {
        $menu = array();
        foreach ($menu_db as $row) {
            $category_id = $row['Category_ID'];
            $category = $this->Category->get($category_id, [
                'contain' => []
            ]);

            $menu_category = (object)['ID' => $category['ID'], 'Name' => $category['Name'], 'Products' => array()];
            if (!in_array($menu_category, $menu)) {
                array_push($menu, $menu_category);
            }


        }

        foreach ($menu_db as $row) {
            $product_id = $row['Product_ID'];

            $category_id = $row['Category_ID'];

            $product = $this->Product->get($product_id, [
                'contain' => []
            ]);

            foreach ($menu as $menu_category) {
                if ($menu_category->ID == $category_id)
                    array_push($menu_category->Products, $product);
            }


        }

        return $menu;
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menu->get($id, [
            'contain' => []
        ]);
        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menu = $this->Menu->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menu->patchEntity($menu, $this->request->data);
            if ($this->Menu->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
                return $this->redirect(['action' => 'index_adm']);
            } else {
                $this->Flash->error(__('The menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('menu'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menu->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menu->patchEntity($menu, $this->request->data);
            if ($this->Menu->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('menu'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menu->get($id);
        if ($this->Menu->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index_adm']);
    }

    private function processCart($session)
    {
        //Re-set cookies for place, guest and restaurant
        $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
        $placeID_cookie = $this->Cookie->read('WiFiCisnik.PlaceID');
        $restaurantID_cookie = $this->Cookie->read('WiFiCisnik.RestaurantID');
        $this->Cookie->delete('WiFiCisnik');
        $this->Cookie->write('WiFiCisnik.GuestID', $guestID_cookie);
        $this->Cookie->write('WiFiCisnik.PlaceID', $placeID_cookie);
        $this->Cookie->write('WiFiCisnik.RestaurantID', $restaurantID_cookie);
        //Load cart from session
        $cart_products = $session->read('Cart.Products');
        $placeID_order = $session->read('Cart.Place_ID');
        $guestID_order = $session->read('Cart.Guest_ID');
        //Try to get main order for place, if not exist, create one
        $query = $this->OrderMain->find('all', [
            'conditions' => ['OrderMain.Place_ID' => $placeID_order, 'OrderMain.OrderState' => 1]
        ]);
        $main_order = $query->first();
        if (is_null($main_order)) {
            $main_order = $this->OrderMain->newEntity();
            $main_order->OrderState = 0;
            $main_order->OrdersCount = 0;
            $main_order->Place_ID = $placeID_cookie;
            $main_order->Created = Time::now('Europe/Prague');
            $this->OrderMain->save($main_order);
        }
        //Delete previous uncomplete order
        $query = $this->OrderGuest->find('all', [
            'conditions' => ['OrderGuest.Place_ID' => $placeID_cookie,
                             'OrderGuest.Guest_ID' => $guestID_cookie,
                             'OrderGuest.OrderMain_ID' => $main_order->ID,
                             'OrderGuest.PaymentState IN' => ([0, 1, 2, 6]),
            ]
        ]);
        $guest_order_delete = $query->first();
        if(!is_null($guest_order_delete)){
            $this->OrderGuest->delete($guest_order_delete);
            $main_order->OrdersCount -= 1;
        }
        //Create guest order and Add guest order to main order
        $guest_order = $this->OrderGuest->newEntity();
        $guest_order->PaymentState = 0;
        $guest_order->OrderState = 0;
        $guest_order->Guest_ID = $guestID_cookie;
        $guest_order->Place_ID = $placeID_cookie;
        $guest_order->Payment_ID = $this->request->data['payMethod'];
        $guest_order->OrderMain_ID = $main_order->ID;
        $this->OrderGuest->save($guest_order);
        //Add products to guest order and calculate total price
        $total_price = 0;
        foreach ($cart_products as $product) {
            $product_order = $this->OrderProduct->newEntity();
            $product_order->Order_Guest_ID = $guest_order->ID;
            $product_order->Product_ID = $product->ID;
            $product_order->Quantity = $product->Count;
            $product_order->Price = $product->Price;
            $product_order->PriceTotal = $product->Count * $product->Price;
            $this->OrderProduct->save($product_order);
            $total_price += $product_order->PriceTotal;
        }
        //Save main order and guest order
        $main_order->OrdersCount += 1;
        $main_order->OrderState = 1;
        $guest_order->OrderState = 1;
        $guest_order->TotalPrice = $total_price;
        $this->OrderMain->save($main_order);
        $this->OrderGuest->save($guest_order);

        return [$guest_order, $main_order];
    }

    public function addToCartAjax(){
        //$this->className = 'Ajax.Ajax';
        $session = $this->request->session();
        if ($this->request->is(array('ajax'))) {
            $this->response->disableCache();
            //Product added to cart
            if ($this->request->data('product_id') != null) {
                $product_id_cart = $this->request->data['product_id'];
                $product_count_cart = $this->request->data['product_count'];
                $product_cart = $this->Product->get($product_id_cart);
                $category_active = $this->request->data['category_id'];

                $product_line = (object)['ID' => $product_id_cart, 'Name' => $product_cart['Name'], 'Price' => $product_cart['Price'], 'Count' => $product_count_cart];

                if ($session->check('Cart.Products')) {
                    $products_cart = $session->read('Cart.Products');
                    $product_found_in_cart = false;
                    foreach ($products_cart as $product) {
                        if ($product->ID === $product_id_cart) {
                            $product->Count += $product_count_cart;
                            $product_found_in_cart = true;
                        }
                    }
                    if (!$product_found_in_cart) {
                        array_push($products_cart, $product_line);
                    }
                    $session->write([
                        'Cart.Products' => $products_cart,
                    ]);
                } else {
                    $products_cart = array();
                    array_push($products_cart, $product_line);
                    $session->write([
                        'Cart.Place_ID' => $this->Cookie->read('WiFiCisnik.PlaceID'),
                        'Cart.Guest_ID' => $this->Cookie->read('WiFiCisnik.GuestID'),
                        'Cart.Products' => $products_cart,
                    ]);
                }
                $this->set('isCart', 'true');
                $this->set('cart', $session->read('Cart'));
                $this->set('isNewProductInCart', 'true');
                $this->set('lastActiveCategory',$category_active);
                //$this->render('../Element/menu_bottom');
                //$this->render('../Element/cart_container');
            }
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('CSignature', [
            'privatni' => WWW_ROOT . '/cert/col_key.pem',
            'verejny' => WWW_ROOT . '/cert/col_cert.pem',
            'heslo' => 'changeit'
        ]);
        //$this->loadComponent('Csrf');
        $this->loadModel('Category');
        $this->loadModel('Product');
        $this->loadModel('Restaurant');
        $this->loadModel('Checkout');
        $this->loadModel('Place');
        $this->loadModel('Guest');
        $this->loadModel('OrderGuest');
        $this->loadModel('OrderMain');
        $this->loadModel('OrderProduct');
        $this->loadModel('Payment');
        $this->loadModel('Note');
        $this->loadModel('Localization');
    }

}
