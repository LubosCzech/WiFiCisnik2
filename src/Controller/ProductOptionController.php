<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductOption Controller
 *
 * @property \App\Model\Table\ProductOptionTable $ProductOption
 */
class ProductOptionController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('productOption', $this->paginate($this->ProductOption));
        $this->set('_serialize', ['productOption']);
    }

    /**
     * View method
     *
     * @param string|null $id Product Option id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productOption = $this->ProductOption->get($id, [
            'contain' => []
        ]);
        $this->set('productOption', $productOption);
        $this->set('_serialize', ['productOption']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productOption = $this->ProductOption->newEntity();
        if ($this->request->is('post')) {
            $productOption = $this->ProductOption->patchEntity($productOption, $this->request->data);
            if ($this->ProductOption->save($productOption)) {
                $this->Flash->success(__('The product option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productOption'));
        $this->set('_serialize', ['productOption']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Option id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productOption = $this->ProductOption->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productOption = $this->ProductOption->patchEntity($productOption, $this->request->data);
            if ($this->ProductOption->save($productOption)) {
                $this->Flash->success(__('The product option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productOption'));
        $this->set('_serialize', ['productOption']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Option id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productOption = $this->ProductOption->get($id);
        if ($this->ProductOption->delete($productOption)) {
            $this->Flash->success(__('The product option has been deleted.'));
        } else {
            $this->Flash->error(__('The product option could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
