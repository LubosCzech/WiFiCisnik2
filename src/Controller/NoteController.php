<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Note Controller
 *
 * @property \App\Model\Table\NoteTable $Note
 */
class NoteController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('note', $this->paginate($this->Note));
        $this->set('_serialize', ['note']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Note->get($id, [
            'contain' => []
        ]);
        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Note->newEntity();
        if ($this->request->is('post')) {
            $note = $this->Note->patchEntity($note, $this->request->data);
            if ($this->Note->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('note'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Note->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Note->patchEntity($note, $this->request->data);
            if ($this->Note->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('note'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Note->get($id);
        if ($this->Note->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
