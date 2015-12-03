<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Guest Controller
 *
 * @property \App\Model\Table\GuestTable $Guest
 */
class GuestController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('guest', $this->paginate($this->Guest));
        $this->set('_serialize', ['guest']);
    }

    /**
     * View method
     *
     * @param string|null $id Guest id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guest = $this->Guest->get($id, [
            'contain' => []
        ]);
        $this->set('guest', $guest);
        $this->set('_serialize', ['guest']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guest = $this->Guest->newEntity();
        if ($this->request->is('post')) {
            $guest = $this->Guest->patchEntity($guest, $this->request->data);
            if ($this->Guest->save($guest)) {
                $this->Flash->success(__('The guest has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guest could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('guest'));
        $this->set('_serialize', ['guest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Guest id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guest = $this->Guest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guest = $this->Guest->patchEntity($guest, $this->request->data);
            if ($this->Guest->save($guest)) {
                $this->Flash->success(__('The guest has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The guest could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('guest'));
        $this->set('_serialize', ['guest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Guest id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guest = $this->Guest->get($id);
        if ($this->Guest->delete($guest)) {
            $this->Flash->success(__('The guest has been deleted.'));
        } else {
            $this->Flash->error(__('The guest could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
