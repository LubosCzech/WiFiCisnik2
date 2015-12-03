<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rating Controller
 *
 * @property \App\Model\Table\RatingTable $Rating
 */
class RatingController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('rating', $this->paginate($this->Rating));
        $this->set('_serialize', ['rating']);
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rating = $this->Rating->get($id, [
            'contain' => []
        ]);
        $this->set('rating', $rating);
        $this->set('_serialize', ['rating']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rating = $this->Rating->newEntity();
        if ($this->request->is('post')) {
            $rating = $this->Rating->patchEntity($rating, $this->request->data);
            if ($this->Rating->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The rating could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('rating'));
        $this->set('_serialize', ['rating']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rating = $this->Rating->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Rating->patchEntity($rating, $this->request->data);
            if ($this->Rating->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The rating could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('rating'));
        $this->set('_serialize', ['rating']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Rating->get($id);
        if ($this->Rating->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
