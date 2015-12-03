<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderMain Controller
 *
 * @property \App\Model\Table\OrderMainTable $OrderMain
 */
class OrderMainController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('orderMain', $this->paginate($this->OrderMain));
        $this->set('_serialize', ['orderMain']);
    }

    /**
     * View method
     *
     * @param string|null $id Order Main id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderMain = $this->OrderMain->get($id, [
            'contain' => []
        ]);
        $this->set('orderMain', $orderMain);
        $this->set('_serialize', ['orderMain']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderMain = $this->OrderMain->newEntity();
        if ($this->request->is('post')) {
            $orderMain = $this->OrderMain->patchEntity($orderMain, $this->request->data);
            if ($this->OrderMain->save($orderMain)) {
                $this->Flash->success(__('The order main has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order main could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('orderMain'));
        $this->set('_serialize', ['orderMain']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Main id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderMain = $this->OrderMain->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderMain = $this->OrderMain->patchEntity($orderMain, $this->request->data);
            if ($this->OrderMain->save($orderMain)) {
                $this->Flash->success(__('The order main has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order main could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('orderMain'));
        $this->set('_serialize', ['orderMain']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Main id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderMain = $this->OrderMain->get($id);
        if ($this->OrderMain->delete($orderMain)) {
            $this->Flash->success(__('The order main has been deleted.'));
        } else {
            $this->Flash->error(__('The order main could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
