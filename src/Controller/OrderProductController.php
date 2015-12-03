<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderProduct Controller
 *
 * @property \App\Model\Table\OrderProductTable $OrderProduct
 */
class OrderProductController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Product', 'OrderGuest']
        ];
        $this->set('orderProduct', $this->paginate($this->OrderProduct));
        $this->set('_serialize', ['orderProduct']);
    }

    /**
     * View method
     *
     * @param string|null $id Order Product id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderProduct = $this->OrderProduct->get($id, [
            'contain' => ['Product', 'OrderGuest']
        ]);
        $this->set('orderProduct', $orderProduct);
        $this->set('_serialize', ['orderProduct']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderProduct = $this->OrderProduct->newEntity();
        if ($this->request->is('post')) {
            $orderProduct = $this->OrderProduct->patchEntity($orderProduct, $this->request->data);
            if ($this->OrderProduct->save($orderProduct)) {
                $this->Flash->success(__('The order product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order product could not be saved. Please, try again.'));
            }
        }
        $product = $this->OrderProduct->Product->find('list', ['limit' => 200]);
        $orderGuest = $this->OrderProduct->OrderGuest->find('list', ['limit' => 200]);
        $this->set(compact('orderProduct', 'product', 'orderGuest'));
        $this->set('_serialize', ['orderProduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Product id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderProduct = $this->OrderProduct->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderProduct = $this->OrderProduct->patchEntity($orderProduct, $this->request->data);
            if ($this->OrderProduct->save($orderProduct)) {
                $this->Flash->success(__('The order product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order product could not be saved. Please, try again.'));
            }
        }
        $product = $this->OrderProduct->Product->find('list', ['limit' => 200]);
        $orderGuest = $this->OrderProduct->OrderGuest->find('list', ['limit' => 200]);
        $this->set(compact('orderProduct', 'product', 'orderGuest'));
        $this->set('_serialize', ['orderProduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Product id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderProduct = $this->OrderProduct->get($id);
        if ($this->OrderProduct->delete($orderProduct)) {
            $this->Flash->success(__('The order product has been deleted.'));
        } else {
            $this->Flash->error(__('The order product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
