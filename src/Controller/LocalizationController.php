<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Localization Controller
 *
 * @property \App\Model\Table\LocalizationTable $Localization
 */
class LocalizationController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('localization', $this->paginate($this->Localization));
        $this->set('_serialize', ['localization']);
    }

    /**
     * View method
     *
     * @param string|null $id Localization id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $localization = $this->Localization->get($id, [
            'contain' => []
        ]);
        $this->set('localization', $localization);
        $this->set('_serialize', ['localization']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $localization = $this->Localization->newEntity();
        if ($this->request->is('post')) {
            $localization = $this->Localization->patchEntity($localization, $this->request->data);
            if ($this->Localization->save($localization)) {
                $this->Flash->success(__('The localization has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The localization could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('localization'));
        $this->set('_serialize', ['localization']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Localization id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $localization = $this->Localization->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $localization = $this->Localization->patchEntity($localization, $this->request->data);
            if ($this->Localization->save($localization)) {
                $this->Flash->success(__('The localization has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The localization could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('localization'));
        $this->set('_serialize', ['localization']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Localization id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $localization = $this->Localization->get($id);
        if ($this->Localization->delete($localization)) {
            $this->Flash->success(__('The localization has been deleted.'));
        } else {
            $this->Flash->error(__('The localization could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
