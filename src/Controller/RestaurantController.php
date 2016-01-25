<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\UserTable;
use Cake\I18n\Time;
use Cake\Utility\Inflector;

/**
 * Restaurant Controller
 *
 * @property \App\Model\Table\RestaurantTable $Restaurant
 */
class RestaurantController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('restaurant', $this->paginate($this->Restaurant));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurant = $this->Restaurant->get($id, [
            'contain' => []
        ]);
        $this->set('restaurant', $restaurant);
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $restaurant = $this->Restaurant->newEntity();
        if ($this->request->is('post')) {
            $restaurant = $this->Restaurant->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurant->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('restaurant'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $restaurant = $this->Restaurant->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurant = $this->Restaurant->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurant->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('restaurant'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurant->get($id);
        if ($this->Restaurant->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function main($code = null,$lang=null)
    {
        $session = $this->request->session();

        //Init variables
        $this->set('isPaymentNotify','false');
        $this->set('paymentState',0);
        $this->set('resultText','');

        if ($session->check('WiFiCisnik')) {
            $code = $session->read('WiFiCisnik.RestaurantCode');
            $showPaymentNotify = $session->read('WiFiCisnik.ShowPaymentNotify');
            $paymentState = $session->read('WiFiCisnik.PaymentState');
            $resultText = $session->read('WiFiCisnik.PaymentResult');
            $session->delete('WiFiCisnik');
            $this->set('isPaymentNotify',$showPaymentNotify);
            $this->set('paymentState',$paymentState);
            $this->set('resultText',$resultText);
        }

        if ($this->Cookie->check('WiFiCisnik.GuestID')) {
            $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
            $current_guest = $this->Guest->get($guestID_cookie, [
                'contain' => []
            ]);

            $current_guest->Active = false;
            $this->Guest->save($current_guest);
            $this->set('currentUser',$current_guest);

            if ($this->Cookie->check('WiFiCisnik.PlaceID')){
                $placeID_cookie = $this->Cookie->read('WiFiCisnik.PlaceID');
                $guests_place = $this->Guest
                    ->find()
                    ->where(['Place_ID =' => $placeID_cookie, 'Active' => true])
                    ->toArray()
                ;

                //If no other is active, close main order
                if(!$guests_place){
                    $query = $this->OrderMain->find('all', [
                        'conditions' => ['OrderMain.Place_ID' => $placeID_cookie, 'OrderMain.OrderState' => 1]
                    ]);
                    $main_order = $query->first();
                    if(!is_null($main_order)){
                        //TODO
                        //Pokud nenajdeme uzivatelskou objednavku s kompletní platbou neuzavirat
                        $orderGuestUncomplete  = $this->OrderGuest->find('all',[
                            'conditions'=>['OrderGuest.OrderMain_ID'=>$main_order->ID, 'OrderGuest.PaymentState'=>0]
                        ])->count();
                        if($orderGuestUncomplete>0 && $main_order->OrdersCount==1){
                            $main_order->OrderState=1;
                        }else{
                            $main_order->OrderState=2;
                        }
                        $this->OrderMain->save($main_order);
                    }
                }
            }
        }

        if(is_null($code)){
            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->Cookie->read('WiFiCisnik.RestaurantID')
                ])
                ->contain(['Configuration','News']);

            $restaurant = $rest_query->first();
        }else{
            $rest_query = $this->Restaurant
                ->find()
                ->where(['Code LIKE' => '%'.$code.'%'])
                ->contain(['Configuration','News']);

            $restaurant = $rest_query->first();
        }

        if(is_null($restaurant)){
            return $this->redirect('http://www.wificisnik.cz');
        }

        $this->set('restaurant', $restaurant);
        $this->set('_serialize', ['restaurant']);

        $isLangSet = true;

            switch (ucfirst($lang)) {
                case 'Cz':
                    $language = 'Czech';
                    break;
                case 'En':
                    $language = 'English';
                    break;
                case 'De':
                    $language = 'German';
                    break;
                case 'Sk':
                    $language = 'Slovak';
                    break;
                case 'Pl':
                    $language = 'Polish';
                    break;
                default:
                    $language = 'Czech';
                    $isLangSet=false;
            }

        if ($isLangSet){
            $this->Cookie->write('WiFiCisnik.Language', $language);
        }else{
            if($this->Cookie->check('WiFiCisnik.Language')){
                $language = $this->Cookie->read('WiFiCisnik.Language');
            }else{
                $this->Cookie->write('WiFiCisnik.Language', $language);
            }
        }

        $localization = $this->Localization->find()->combine('Code', $language);
        $languageText = array();
        foreach ($localization as $code => $text){
            $languageText[$code] = $text;
        }
        $this->set('localization',$languageText);
        $this->set('language',$language);

        $this->Cookie->write('WiFiCisnik.RestaurantID', $restaurant['ID']);

        $session->write('Guest.RestaurantID',$restaurant['ID']);
        $session->write('Guest.Language',$language);
        $session->write('Guest.LanguageCode',ucfirst($lang));
    }

    public function login(){
        $session = $this->request->session();
        $badLogin = false;
        if ($this->request->is(['post'])) {
            //Login
            if($this->request->data('login')){
                $login = $this->request->data('input_login');
                $pass = $this->request->data('input_pass');

                $query = $this->User->find('all', [
                    'conditions' => ['User.Login =' => $login]
                ]);
                $user = $query->first();
                if (is_null($user)){
                    $badLogin = true;
                }
                if ($user->Password==$pass){
                    $checkout = $this->Checkout
                        ->find()
                        ->where(['Checkout.ID ='=>$user->Checkout_ID])
                        ->contain(['Restaurant'])
                        ->first()
                    ;
                    $restaurant= $checkout->restaurant;

                    $isLogged = true;
                    $this->Cookie->write('WiFiCisnik.Admin.UserID',$user->ID);
                    $this->Cookie->write('WiFiCisnik.Admin.Role',$user->Role);
                    $this->Cookie->write('WiFiCisnik.Admin.RestaurantID',$restaurant->ID);

                    $session->write('WiFiCisnik.Admin.UserID',$user->ID);
                    $session->write('WiFiCisnik.Admin.Role',$user->Role);
                    $session->write('WiFiCisnik.Admin.RestaurantID',$restaurant->ID);
                }else{
                    $badLogin=true;
                }
            }
        }

        if($this->Cookie->check('WiFiCisnik.Admin.UserID')){
            $this->set('showLogin','false');
            return $this->redirect(['controller'=>'Restaurant','action' => 'admin']);
        }else{
            $this->set('showLogin','true');
        }

        if ($badLogin){
            $this->set('badLogin','true');
        }else{
            $this->set('badLogin','false');
        }

    }

    public function admin($code = null)
    {
        $session = $this->request->session();

        if ($this->request->is('ajax')) {

            $user_id = $this->request->query('userID');
            $restaurant_id = $this->request->query('restaurantID');
            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $restaurant_id
                ])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->Cookie->write('WiFiCisnik.Admin.UserID',$user_id);
            $this->Cookie->write('WiFiCisnik.Admin.RestaurantID',$restaurant_id);

        }else{

            if($this->Cookie->check('WiFiCisnik.Admin.UserID')){
                $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            }else{
                return $this->redirect(['controller'=>'Restaurant','action' => 'login']);
            }

            if(is_null($code)){
                $rest_query = $this->Restaurant
                    ->find()
                    ->where(['Restaurant.ID' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')
                    ])
                    ->contain(['Configuration']);

                $restaurant = $rest_query->first();
            }else{
                $rest_query = $this->Restaurant
                    ->find()
                    ->where(['Restaurant.Code LIKE' => '%'.$code.'%'])
                    ->contain(['Configuration']);

                $restaurant = $rest_query->first();
            }
        }



        $this->set('restaurant', $restaurant);

        //Process order
        if ($this->request->is(['post'])) {
            //Product added to cart
            if($this->request->data('order_id') != null){
                $edited_order = $this->OrderMain->get($this->request->data('order_id'), [
                    'contain' => []
                ]);
                $edited_order->OrderState=5;
                $edited_order->User_ID = $user_id;
                $this->OrderMain->save($edited_order);
            }
        }

        $logged_user = $this->User->get($user_id, [
            'contain' => []
        ]);

        $places = $this->Place
            ->find('all')
            ->select(['ID'])
            ->where(['Checkout_ID =' => $logged_user->Checkout_ID])
            ->toArray()
        ;

        $place_ids = array();
        foreach($places as $place){
            array_push($place_ids,$place->ID);
        }
       /* $orders_main = $this->OrderMain
            ->find()
            ->where(['Place_ID IN' => $place_ids,'OrderState >'=>1])
            ->contain(['Place','States','OrderGuest.Product','OrderGuest.Payment','User'])
            ->order(['Created' => 'DESC'])
        ;*/
        $orders_main = $this->OrderMain
            ->find()
            ->where(['Place_ID IN' => $place_ids,
                'OrderState >'=>1,
                'Created >' => new Time($restaurant->configuration->Archive.' hours ago','Europe/Prague')
            ])
            ->contain(['Place',
                'States',
                'OrderGuest.Product',
                'OrderGuest.Payment',
                'User',
                'OrderGuest.Note',
                'OrderGuest'=> function ($q) {
                    return $q
                        ->where(['OrderGuest.PaymentState' => 3]);}])
            ->order(['Created' => 'DESC'])
        ;

        $orders_main_archive = $this->OrderMain
            ->find()
            ->where(['Place_ID IN' => $place_ids,
                'OrderState >'=>1,
                'Created <' => new Time($restaurant->configuration->Archive.' hours ago','Europe/Prague')
            ])
            ->contain(['Place',
                'States',
                'OrderGuest.Product',
                'OrderGuest.Payment',
                'User',
                'OrderGuest.Note',
                'OrderGuest'=> function ($q) {
                    return $q
                        ->where(['OrderGuest.PaymentState' => 3]);}])
            ->order(['Created' => 'DESC'])
        ;

        if($this->request->query('model')=='OrderMain')
        {
            $this->set('orderMain', $this->paginate($orders_main));
        }else{
            $this->set('orderMain', $this->paginate($orders_main,['pageUser'=>1]));
        }

       $this->set('orderMainArchive',$orders_main_archive->toArray());

        $this->set('allowedPlaces',$place_ids);
        $this->set('loggedUser',$logged_user);

        $restaurant_id_cookie = $this->Cookie->read('WiFiCisnik.Admin.RestaurantID');

        $allUsers = $this->User->find('all')->where(['Restaurant_ID'=>$restaurant_id_cookie]);

        $this->set('allUsers',$allUsers);

        $products = $this->Product
            ->find()
            ->where(['Restaurant_ID' => $restaurant_id_cookie
            ]);

        if($this->request->query('model')=='Products')
        {
            $this->set('product', $this->paginate($products));
        }else{
            $this->set('product', $this->paginate($products,['pageUser'=>1]));
        }

        $categories = $this->Category
            ->find()
            ->where(['Restaurant_ID' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')
            ]);

        if($this->request->query('model')=='Category')
        {
            $this->set('category', $this->paginate($categories));
        }else{
            $this->set('category', $this->paginate($categories,['pageUser'=>1]));
        }


        $menu = $this->Menu
            ->find()
            ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
            ->order(['Position' => 'ASC'])
            ->toArray();


        $menu_tree = $this->createMenu($menu);
        $this->set('menu', $menu_tree);

        $checkout = $this->Checkout
            ->find()
            ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
            ->order(['ID' => 'ASC'])
            ->toArray();

        $this->set('checkout', $checkout);

        $place_admin = $this->Place
            ->find()
            ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
            ->order(['ID' => 'ASC'])
            ->toArray();

        $this->set('place', $place_admin);

        $rating = $this->Rating
            ->find()
            ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
            ->order(['ID' => 'DESC'])
            ->toArray();

        $this->set('rating', $rating);

        $news = $this->News
            ->find()
            ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
            ->order(['ID' => 'ASC'])
            ->toArray();

        $this->set('news', $news);

        if ($this->request->is('ajax')) {
            $this->render('../Element/orders_container');
        }

        $this->Cookie->write('WiFiCisnik.Admin.RestaurantID', $restaurant->ID);
        $this->Cookie->write('WiFiCisnik.Admin.UserID', $logged_user->ID);
        $this->Cookie->write('WiFiCisnik.Admin.Role', $logged_user->Role);
    }

    public function newOrdersCountAjax() {
        if ($this->request->is(array('ajax'))) {
            $this->response->disableCache();
            $ids = json_decode(urldecode($this->request->query('ids')));
            $newOrders = $this->OrderMain->find()->where(['Place_ID IN'=> $ids,'OrderState =' => 2])->count();
            $this->set('result', array('newOrders' => $newOrders));
            $this->set('_serialize', array('result'));
        }
    }

    public function newNotificationsAjax() {
        if ($this->request->is(array('ajax'))) {
            $this->response->disableCache();
            $ids = json_decode(urldecode($this->request->query('ids')));
            $newNotifications = $this->Notification->find()->where(['Place_ID IN'=> $ids,'State =' => 1])->toArray();

            $notifications = array();
            foreach($newNotifications as $notification){
                $notification->State=3;
                $this->Notification->save($notification);
                $place = $this->Place->get($notification->Place_ID);
                array_push($notifications,$place->Name);
            }
            $this->set('result', array('newNotifications' => $notifications));
            $this->set('_serialize', array('result'));
        }
    }

    public function rateAjax(){
        if ($this->request->is(array('ajax'))) {
            $rating = $this->Rating->newEntity();

            if($this->request->data['name']){
                $rating->Guest_Name = $this->request->data['name'];
            }
            if($this->request->data['comment']){
                $rating->Comment = $this->request->data['comment'];
            }
            if($this->request->data['question1']){
                $rating->Question1 = $this->request->data['question1'];
            }
            if($this->request->data['question2']){
                $rating->Question2 = $this->request->data['question2'];
            }
            if($this->request->data['question3']){
                $rating->Question3 = $this->request->data['question3'];
            }
            if($this->request->data['question4']){
                $rating->Question4 = $this->request->data['question4'];
            }
            if($this->request->data['question5']){
                $rating->Question5 = $this->request->data['question5'];
            }
            $rating->Restaurant_ID = $this->request->data['restaurant_id'];

            $this->Rating->Save($rating);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
        }
    }

    public function saveConfigGuestAjax(){
        if ($this->request->is(array('ajax'))) {

            $lang = $this->request->data['language'];

            switch (ucfirst($lang)) {
                case 'Cz':
                    $language = 'Czech';
                    break;
                case 'En':
                    $language = 'English';
                    break;
                case 'De':
                    $language = 'German';
                    break;
                case 'Sk':
                    $language = 'Slovak';
                    break;
                case 'Pl':
                    $language = 'Polish';
                    break;
                default:
                    $language = 'Czech';
            }

            $this->Cookie->write('WiFiCisnik.Language', $language);
            $session = $this->request->session();

            $session->write('Guest.Language',$language);
            $session->write('Guest.LanguageCode',ucfirst($lang));

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
        }
    }

    public function removePlaceGuestAjax(){
        if ($this->request->is(array('ajax'))) {

            $session = $this->request->session();

            if ($this->Cookie->check('WiFiCisnik.GuestID')) {
                $guestID_cookie = $this->Cookie->read('WiFiCisnik.GuestID');
                $current_guest = $this->Guest->get($guestID_cookie, [
                    'contain' => []
                ]);

                $current_guest->Active = false;
                $this->Guest->save($current_guest);
                $this->set('currentUser',$current_guest);

                if ($this->Cookie->check('WiFiCisnik.PlaceID')){
                    $placeID_cookie = $this->Cookie->read('WiFiCisnik.PlaceID');
                    $this->Cookie->delete('WiFiCisnik.PlaceID');
                    $guests_place = $this->Guest
                        ->find()
                        ->where(['Place_ID =' => $placeID_cookie, 'Active' => true])
                        ->toArray()
                    ;

                    //If no other is active, close main order
                    if(!$guests_place){
                        $query = $this->OrderMain->find('all', [
                            'conditions' => ['OrderMain.Place_ID' => $placeID_cookie, 'OrderMain.OrderState' => 1]
                        ]);
                        $main_order = $query->first();
                        if(!is_null($main_order)){
                            $main_order->OrderState=2;
                            $this->OrderMain->save($main_order);
                        }
                    }
                }
            }

            if($session->check('Cart')){
                $session->delete('Cart');
            }

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
        }
    }

    public function createNotificationAjax() {
        if ($this->request->is(array('ajax'))) {
            $this->response->disableCache();
            $guest_id = $this->request->query('Guest_ID');
            $place_code = $this->request->query('Place_ID');
            $this->log('Place code = '.$place_code, 'debug');
            if($guest_id=='0'){
                $place = $this->Place->find()->where(['Place.Code ='=> $place_code])->first();
            }else{
                $place = $this->Place->get($place_code);
            }
            $notification = $this->Notification->newEntity();
            $notification->Guest_ID = $guest_id;
            $notification->Place_ID = $place->ID;
            $notification->State=1;
            $this->Notification->save($notification);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('OrderGuest');
        $this->loadModel('OrderMain');
        $this->loadModel('OrderProduct');
        $this->loadModel('Checkout');
        $this->loadModel('Place');
        $this->loadModel('States');
        $this->loadModel('User');
        $this->loadModel('Guest');
        $this->loadModel('Note');
        $this->loadModel('Notification');
        $this->loadModel('Product');
        $this->loadModel('Category');
        $this->loadModel('Menu');
        $this->loadModel('News');
        $this->loadModel('Rating');
        $this->loadModel('Configuration');
        $this->loadModel('Localization');
    }

    function paginate($object = null,$options=null)
    {
        if (is_object($object)) {
            $table = $object;
        }

        if (is_string($object) || $object === null) {
            $try = [$object, $this->modelClass];
            foreach ($try as $tableName) {
                if (empty($tableName)) {
                    continue;
                }
                $table = $this->loadModel($tableName);
                break;
            }
        }

        $this->loadComponent('CustomPaginator');
        if (empty($table)) {
            throw new RuntimeException('Unable to locate an object compatible with paginate.');
        }
        if($options==null){
            $options=$this->paginate;
        }
        return $this->CustomPaginator->paginate($table, $options);
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

    public function saveNewsAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['news_id'] && $this->request->query['news_id']!=""){
               $news = $this->News->get($this->request->query['news_id'], ['contain' => []]);
            }else{
                $news = $this->News->newEntity();
                $news->Restaurant_ID = $this->request->query['restaurant_id'];
            }

            $news->Text = $this->request->query['news_text'];
            $news->Title = $this->request->query['title_text'];
            $news->Created = Time::now('Europe/Prague');

            $this->News->Save($news);

            $news = $this->News
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id'] ])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('news', $news);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/news_container');
        }
    }

    public function removeNewsAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['news_id'] && $this->request->query['news_id']!=""){
                $news = $this->News->get($this->request->query['news_id'], ['contain' => []]);
            }
            $this->News->delete($news);

            $news = $this->News
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id'] ])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('news', $news);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/news_container');
        }
    }

    public function saveProductAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['product_id'] && $this->request->query['product_id']!=""){
                $product = $this->Product->get($this->request->query['product_id'], ['contain' => []]);
            }else{
                $product = $this->Product->newEntity();
                $product->Restaurant_ID = $this->request->query['restaurant_id'];
                $product->IsOption=0;

            }

            $product->Name = $this->request->query['name_text'];
            $product->Description = $this->request->query['description_text'];
            $product->Price = $this->request->query['price_text'];
            $product->ImageUrl = $this->request->query['image_text'];
            $product->Code = Inflector::slug($this->request->query['name_text']);


            $this->Product->Save($product);

            $products = $this->Product
                ->find()
                ->where(['Restaurant_ID' => $this->request->query['restaurant_id']]);

            $this->set('product', $this->paginate($products,['pageUser'=>1]));

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/product_container');
        }
    }

    public function removeProductAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['product_id'] && $this->request->query['product_id']!=""){
                $product = $this->Product->get($this->request->query['product_id'], ['contain' => []]);
            }
            $this->Product->delete($product);

            $products = $this->Product
                ->find()
                ->where(['Restaurant_ID' => $this->request->query['restaurant_id']]);

            $this->set('product', $this->paginate($products,['pageUser'=>1]));

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/product_container');
        }
    }

    public function saveCategoryAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['category_id'] && $this->request->query['category_id']!=""){
                $category = $this->Category->get($this->request->query['category_id'], ['contain' => []]);
            }else{
                $category = $this->Category->newEntity();
                $category->Restaurant_ID = $this->request->query['restaurant_id'];
            }

            $category->Name = $this->request->query['category_text'];
            $category->Code = Inflector::slug($this->request->query['category_text']);


            $this->Category->Save($category);

            $categories = $this->Category
                ->find()
                ->where(['Restaurant_ID' => $this->request->query['restaurant_id']]);

            $this->set('category', $this->paginate($categories,['pageUser'=>1]));


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/category_container');
        }
    }

    public function removeCategoryAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['category_id'] && $this->request->query['category_id']!=""){
                $category = $this->Category->get($this->request->query['category_id'], ['contain' => []]);
            }
            $this->Category->delete($category);

            $categories = $this->Category
                ->find()
                ->where(['Restaurant_ID' => $this->request->query['restaurant_id']]);

            $this->set('category', $this->paginate($categories,['pageUser'=>1]));

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/category_container');
        }
    }

    public function saveCheckoutAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['checkout_id'] && $this->request->query['checkout_id']!=""){
                $checkout = $this->Checkout->get($this->request->query['checkout_id'], ['contain' => []]);
            }else{
                $checkout = $this->Checkout->newEntity();
                $checkout->Restaurant_ID = $this->request->query['restaurant_id'];
            }

            $checkout->Name = $this->request->query['checkout_text'];
            $checkout->Code = Inflector::slug($this->request->query['checkout_text']);


            $this->Checkout->Save($checkout);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/checkout_container');
        }
    }

    public function removeCheckoutAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['checkout_id'] && $this->request->query['checkout_id']!=""){
                $checkout = $this->Checkout->get($this->request->query['checkout_id'], ['contain' => []]);
            }
            $this->Checkout->delete($checkout);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/checkout_container');
        }
    }

    public function savePlaceAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['place_id'] && $this->request->query['place_id']!=""){
                $place = $this->Place->get($this->request->query['place_id'], ['contain' => []]);
            }else{
                $place = $this->Place->newEntity();
                $place->Restaurant_ID = $this->request->query['restaurant_id'];
            }

            $place->Name = $this->request->query['place_text'];
            $place->Code = $this->request->query['place_code'];
            $place->Checkout_ID = $this->request->query['place_checkout'];

            $this->Place->Save($place);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);

            $place = $this->Place
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('place', $place);


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/place_container');
        }
    }

    public function removePlaceAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['place_id'] && $this->request->query['place_id']!=""){
                $place = $this->Place->get($this->request->query['place_id'], ['contain' => []]);
            }
            $this->Place->delete($place);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);

            $place = $this->Place
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('place', $place);


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/place_container');
        }
    }



    public function saveMenuAjax(){
        if ($this->request->is(array('ajax'))) {

            $menu_tree = $this->request->data['list'];
            $restaurant_id = $this->Cookie->read('WiFiCisnik.Admin.RestaurantID');


            $menu_to_delete = $this->Menu->find('all')->where(['Restaurant_ID'=> $restaurant_id]);
            foreach($menu_to_delete as $menu_del){
                    $this->Menu->delete($menu_del);
            }


            //$this->set('changedMenu',$menu_tree);

            $pos = 0;
            foreach($menu_tree as $menu_cat){
                $cat_id = $menu_cat['id'];
                $this->set('cat_id',$cat_id);
                $this->set('changedMenu',$menu_cat);
                foreach($menu_cat['children'] as $menu_product){
                    $menu_row = $this->Menu->newEntity();
                    $menu_row->Restaurant_ID = $restaurant_id;
                    $menu_row->Category_ID = $cat_id;
                    $menu_row->Product_ID = $menu_product['id'];
                    $menu_row->Position = $pos;
                    $this->Menu->Save($menu_row);
                    $pos++;
                }
            }

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $restaurant_id])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $menu = $this->Menu
                ->find()
                ->where(['Restaurant_ID =' => $this->Cookie->read('WiFiCisnik.Admin.RestaurantID')])
                ->order(['Position' => 'ASC'])
                ->toArray();


            $menu_tree = $this->createMenu($menu);
            $this->set('menu', $menu_tree);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/menu_container');
        }
    }

    public function saveRestaurantAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['restaurant_id'] && $this->request->query['restaurant_id']!=""){
                $restaurant = $this->Restaurant->get($this->request->query['restaurant_id'], ['contain' => []]);
            }
            $restaurant->Name = $this->request->query['restaurant_name'];
            $restaurant->LogoUrl = $this->request->query['restaurant_logoUrl'];
            $restaurant->WebUrl = $this->request->query['restaurant_webUrl'];

            $this->Restaurant->Save($restaurant);

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/restaurant_container');
        }
    }

    public function saveRestaurantConfigAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['configuration_id'] && $this->request->query['configuration_id']!=""){
                $configuration = $this->Configuration->get($this->request->query['configuration_id'], ['contain' => []]);
            }
            $configuration = $this->Configuration->patchEntity($configuration, $this->request->query);

            $this->Configuration->Save($configuration);

            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/restaurant_adv_container');
        }
    }

    public function saveUserAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['user_id'] && $this->request->query['user_id']!=""){
                $user = $this->User->get($this->request->query['user_id'], ['contain' => []]);
            }else{
                $user = $this->User->newEntity();
                $user->Restaurant_ID = $this->request->query['restaurant_id'];
            }

            $user->FullName = $this->request->query['user_fullname'];
            $user->Login = $this->request->query['user_login'];
            $user->Password = $this->request->query['user_password'];
            $user->Role = $this->request->query['user_role'];
            $user->Checkout_ID = $this->request->query['user_checkout'];


            $this->User->Save($user);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);

            $allUsers = $this->User
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('allUsers', $allUsers);


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/user_container');
        }
    }

    public function removeUserAjax(){
        if ($this->request->is(array('ajax'))) {

            if($this->request->query['user_id'] && $this->request->query['user_id']!=""){
                $user = $this->User->get($this->request->query['user_id'], ['contain' => []]);
            }
            $this->User->delete($user);

            $checkout = $this->Checkout
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('checkout', $checkout);

            $allUsers = $this->User
                ->find()
                ->where(['Restaurant_ID =' => $this->request->query['restaurant_id']])
                ->order(['ID' => 'ASC'])
                ->toArray();

            $this->set('allUsers', $allUsers);


            $rest_query = $this->Restaurant
                ->find()
                ->where(['Restaurant.ID' => $this->request->query['restaurant_id']])
                ->contain(['Configuration']);

            $restaurant = $rest_query->first();

            $this->set('restaurant',$restaurant);

            $user_id = $this->Cookie->read('WiFiCisnik.Admin.UserID');
            $logged_user = $this->User->get($user_id, [
                'contain' => []
            ]);
            $this->set('loggedUser',$logged_user);

            $this->set('result', array('result' => 'ok'));
            $this->set('_serialize', array('result'));
            $this->render('../Element/user_container');
        }
    }
}
