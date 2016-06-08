<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AttributeTypes Controller
 *
 * @property \App\Model\Table\AttributeTypesTable $AttributeTypes
 */
class AttributeTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Quizzes']
        ];
        $attributeTypes = $this->paginate($this->AttributeTypes);

        $this->set(compact('attributeTypes'));
        $this->set('_serialize', ['attributeTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Attribute Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attributeType = $this->AttributeTypes->get($id, [
            'contain' => ['Quizzes', 'Attributes']
        ]);

        $this->set('attributeType', $attributeType);
        $this->set('_serialize', ['attributeType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attributeType = $this->AttributeTypes->newEntity();
        if ($this->request->is('post')) {
            $attributeType = $this->AttributeTypes->patchEntity($attributeType, $this->request->data);
            if ($this->AttributeTypes->save($attributeType)) {
                $this->Flash->success(__('The attribute type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attribute type could not be saved. Please, try again.'));
            }
        }
        $quizzes = $this->AttributeTypes->Quizzes->find('list', ['limit' => 200]);
        $this->set(compact('attributeType', 'quizzes'));
        $this->set('_serialize', ['attributeType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attribute Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attributeType = $this->AttributeTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attributeType = $this->AttributeTypes->patchEntity($attributeType, $this->request->data);
            if ($this->AttributeTypes->save($attributeType)) {
                $this->Flash->success(__('The attribute type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attribute type could not be saved. Please, try again.'));
            }
        }
        $quizzes = $this->AttributeTypes->Quizzes->find('list', ['limit' => 200]);
        $this->set(compact('attributeType', 'quizzes'));
        $this->set('_serialize', ['attributeType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attribute Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attributeType = $this->AttributeTypes->get($id);
        if ($this->AttributeTypes->delete($attributeType)) {
            $this->Flash->success(__('The attribute type has been deleted.'));
        } else {
            $this->Flash->error(__('The attribute type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
