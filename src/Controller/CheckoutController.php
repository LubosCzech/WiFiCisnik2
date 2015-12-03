<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Checkout Controller
 *
 * @property \App\Model\Table\CheckoutTable $Checkout
 */
class CheckoutController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('checkout', $this->paginate($this->Checkout));
        $this->set('_serialize', ['checkout']);
    }

    /**
     * View method
     *
     * @param string|null $id Checkout id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkout = $this->Checkout->get($id, [
            'contain' => []
        ]);
        $this->set('checkout', $checkout);
        $this->set('_serialize', ['checkout']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkout = $this->Checkout->newEntity();
        if ($this->request->is('post')) {
            $checkout = $this->Checkout->patchEntity($checkout, $this->request->data);
            if ($this->Checkout->save($checkout)) {
                $this->Flash->success(__('The checkout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('checkout'));
        $this->set('_serialize', ['checkout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkout id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkout = $this->Checkout->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkout = $this->Checkout->patchEntity($checkout, $this->request->data);
            if ($this->Checkout->save($checkout)) {
                $this->Flash->success(__('The checkout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The checkout could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('checkout'));
        $this->set('_serialize', ['checkout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkout id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkout = $this->Checkout->get($id);
        if ($this->Checkout->delete($checkout)) {
            $this->Flash->success(__('The checkout has been deleted.'));
        } else {
            $this->Flash->error(__('The checkout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
