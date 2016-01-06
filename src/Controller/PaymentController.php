<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Payment Controller
 *
 * @property \App\Model\Table\PaymentTable $Payment
 */
class PaymentController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('payment', $this->paginate($this->Payment));
        $this->set('_serialize', ['payment']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payment->get($id, [
            'contain' => []
        ]);
        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payment->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payment->patchEntity($payment, $this->request->data);
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('payment'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payment->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payment->patchEntity($payment, $this->request->data);
            if ($this->Payment->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('payment'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payment->get($id);
        if ($this->Payment->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function gpwebpay(){
        $session = $this->request->session();

        if($session->check('WiFiCisnik.Payment')){
            $order_id = urldecode($this->request->query('MERORDERNUM'));
            $prcode = urldecode($this->request->query('PRCODE'));
            $resultText = urldecode($this->request->query('RESULTTEXT'));

            $paymentState = 2;

            if($prcode==0){
                $paymentState = 3;
            }else{
                $paymentState = 6;
            }

            if($session->read('WiFiCisnik.Payment.Order_ID')!=$order_id){
                $paymentState = 6;
            }

            $session->write([
                'WiFiCisnik.Payment.PaymentState' => $paymentState,
                'WiFiCisnik.Payment.ResultText' => $resultText,
            ]);

            return $this->redirect(['controller'=>'Payment','action' => 'finish']);
        }
    }

    public function finish()
    {
        $session = $this->request->session();

        if ($session->check('Guest')) {
            $languageCode = $session->read('Guest.LanguageCode');
        }else{
            $languageCode='Cz';
        }

        if ($session->check('WiFiCisnik.Payment')) {
            $guest_order_ID = $session->read('WiFiCisnik.Payment.Order_ID');
            $restaurant_ID = $session->read('WiFiCisnik.Payment.Restaurant_ID');
            $guest_ID = $session->read('WiFiCisnik.Payment.Guest_ID');
            $place_ID = $session->read('WiFiCisnik.Payment.Place_ID');
            $paymentState = $session->read('WiFiCisnik.Payment.PaymentState');

            $guest_order = $this->OrderGuest->get($guest_order_ID, [
                'contain' => []
            ]);

            $restaurant = $this->Restaurant->get($restaurant_ID, [
                'contain' => []
            ]);

            $current_guest = $this->Guest->get($guest_ID, [
                'contain' => []
            ]);

            $main_order = $this->OrderMain->get($guest_order->OrderMain_ID, [
                'contain' => []
            ]);

            $guest_order->PaymentState = $paymentState;
            $guest_order->OrderState = 2;
            $this->OrderGuest->save($guest_order);
            $session->write([
                'WiFiCisnik.RestaurantCode' => $restaurant->Code,
                'WiFiCisnik.ShowPaymentNotify' => 'true',
                'WiFiCisnik.PaymentState' => $guest_order->PaymentState,
                'WiFiCisnik.PaymentResult' => $session->read('WiFiCisnik.Payment.ResultText'),
            ]);

            if($paymentState==6){
                $this->OrderGuest->delete($guest_order);
                if($main_order->OrdersCount==1){
                    $this->OrderMain->delete($main_order);
                }
                return $this->redirect(['controller' => 'Restaurant', 'action' => 'main', $restaurant->Code, $languageCode]);
            }

            //Disable active user
            $current_guest->Active = false;
            $this->Guest->save($current_guest);

            //Check if other guest is active
            $guests_place = $this->Guest
                ->find()
                ->where(['Place_ID =' => $place_ID, 'Active' => true])
                ->toArray();

            //If no other is active, close main order
            if (!$guests_place) {
                $main_order->OrderState = 2;
                $this->OrderMain->save($main_order);
            }

            $this->deleteCart($session);
            $session->delete('WiFiCisnik.Payment');

            return $this->redirect(['controller' => 'Restaurant', 'action' => 'main', $restaurant->Code, $languageCode]);
        }
    }

    private function deleteCart($session){
        //Delete cart from session
        $session->delete('Cart');
        $this->set('isCart','false');
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Restaurant');
        $this->loadModel('Checkout');
        $this->loadModel('Place');
        $this->loadModel('Guest');
        $this->loadModel('OrderGuest');
        $this->loadModel('OrderMain');
        $this->loadModel('OrderProduct');
        $this->loadModel('Payment');
    }
}
