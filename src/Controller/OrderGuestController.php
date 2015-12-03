<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderGuest Controller
 *
 * @property \App\Model\Table\OrderGuestTable $OrderGuest
 */
class OrderGuestController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('orderGuest', $this->paginate($this->OrderGuest));
        $this->set('_serialize', ['orderGuest']);
    }

    /**
     * View method
     *
     * @param string|null $id Order Guest id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderGuest = $this->OrderGuest->get($id, [
            'contain' => ['OrderProducts']
        ]);
        $this->set('orderGuest', $orderGuest);
        $this->set('_serialize', ['orderGuest']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderGuest = $this->OrderGuest->newEntity();
        if ($this->request->is('post')) {
            $orderGuest = $this->OrderGuest->patchEntity($orderGuest, $this->request->data);
            if ($this->OrderGuest->save($orderGuest)) {
                $this->Flash->success(__('The order guest has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order guest could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('orderGuest'));
        $this->set('_serialize', ['orderGuest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Guest id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderGuest = $this->OrderGuest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderGuest = $this->OrderGuest->patchEntity($orderGuest, $this->request->data);
            if ($this->OrderGuest->save($orderGuest)) {
                $this->Flash->success(__('The order guest has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order guest could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('orderGuest'));
        $this->set('_serialize', ['orderGuest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Guest id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderGuest = $this->OrderGuest->get($id);
        if ($this->OrderGuest->delete($orderGuest)) {
            $this->Flash->success(__('The order guest has been deleted.'));
        } else {
            $this->Flash->error(__('The order guest could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
