<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Place Controller
 *
 * @property \App\Model\Table\PlaceTable $Place
 */
class PlaceController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('place', $this->paginate($this->Place));
        $this->set('_serialize', ['place']);
    }

    /**
     * View method
     *
     * @param string|null $id Place id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $place = $this->Place->get($id, [
            'contain' => []
        ]);
        $this->set('place', $place);
        $this->set('_serialize', ['place']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $place = $this->Place->newEntity();
        if ($this->request->is('post')) {
            $place = $this->Place->patchEntity($place, $this->request->data);
            if ($this->Place->save($place)) {
                $this->Flash->success(__('The place has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The place could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('place'));
        $this->set('_serialize', ['place']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Place id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $place = $this->Place->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $place = $this->Place->patchEntity($place, $this->request->data);
            if ($this->Place->save($place)) {
                $this->Flash->success(__('The place has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The place could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('place'));
        $this->set('_serialize', ['place']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Place id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $place = $this->Place->get($id);
        if ($this->Place->delete($place)) {
            $this->Flash->success(__('The place has been deleted.'));
        } else {
            $this->Flash->error(__('The place could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
