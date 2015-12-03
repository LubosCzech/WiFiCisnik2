<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Configuration Controller
 *
 * @property \App\Model\Table\ConfigurationTable $Configuration
 */
class ConfigurationController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('configuration', $this->paginate($this->Configuration));
        $this->set('_serialize', ['configuration']);
    }

    /**
     * View method
     *
     * @param string|null $id Configuration id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuration = $this->Configuration->get($id, [
            'contain' => []
        ]);
        $this->set('configuration', $configuration);
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuration = $this->Configuration->newEntity();
        if ($this->request->is('post')) {
            $configuration = $this->Configuration->patchEntity($configuration, $this->request->data);
            if ($this->Configuration->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuration'));
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuration id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuration = $this->Configuration->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuration = $this->Configuration->patchEntity($configuration, $this->request->data);
            if ($this->Configuration->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuration'));
        $this->set('_serialize', ['configuration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuration id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuration = $this->Configuration->get($id);
        if ($this->Configuration->delete($configuration)) {
            $this->Flash->success(__('The configuration has been deleted.'));
        } else {
            $this->Flash->error(__('The configuration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
