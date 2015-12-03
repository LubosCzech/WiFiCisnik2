<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notification Controller
 *
 * @property \App\Model\Table\NotificationTable $Notification
 */
class NotificationController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('notification', $this->paginate($this->Notification));
        $this->set('_serialize', ['notification']);
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notification->get($id, [
            'contain' => []
        ]);
        $this->set('notification', $notification);
        $this->set('_serialize', ['notification']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notification->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notification->patchEntity($notification, $this->request->data);
            if ($this->Notification->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification = $this->Notification->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notification->patchEntity($notification, $this->request->data);
            if ($this->Notification->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notification->get($id);
        if ($this->Notification->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
