<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Quizzes Controller
 *
 * @property \App\Model\Table\QuizzesTable $Quizzes
 */
class QuizzesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $quizzes = $this->paginate($this->Quizzes);

        $this->set(compact('quizzes'));
        $this->set('_serialize', ['quizzes']);
    }

    /**
     * View method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quiz = $this->Quizzes->get($id, [
            'contain' => ['Users', 'AttributeTypes', 'SharedUsers', 'Data' => function ($q) {
                return $q->contain(['Attributes']);
            }]
        ]);

        $this->set('quiz', $quiz);
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quiz = $this->Quizzes->newEntity();
        if ($this->request->is('post')) {
            $quiz = $this->Quizzes->patchEntity($quiz, $this->request->data);
            if ($this->Quizzes->save($quiz)) {
                $this->Flash->success(__('The quiz has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quiz could not be saved. Please, try again.'));
            }
        }
        $users = $this->Quizzes->Users->find('list', ['limit' => 200]);
        $this->set(compact('quiz', 'users'));
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quiz = $this->Quizzes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quiz = $this->Quizzes->patchEntity($quiz, $this->request->data);
            if ($this->Quizzes->save($quiz)) {
                $this->Flash->success(__('The quiz has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The quiz could not be saved. Please, try again.'));
            }
        }
        $users = $this->Quizzes->Users->find('list', ['limit' => 200]);
        $this->set(compact('quiz', 'users'));
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quiz = $this->Quizzes->get($id);
        if ($this->Quizzes->delete($quiz)) {
            $this->Flash->success(__('The quiz has been deleted.'));
        } else {
            $this->Flash->error(__('The quiz could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Start method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function start($id = null)
    {
        $quiz = $this->Quizzes->get($id, [
            'contain' => []
        ]);
        $this->set('quiz', $quiz);
        $this->set('_serialize', ['quiz']);
    }

    /**
     * Start method
     *
     * @param string|null $id Quiz id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function askRandomQuestion($id = null)
    {
        // Quiz type 1 ask about attributes for data

        // Select random data
        $data = $this->Quizzes->Data->find()
            ->select('Data.id')
            ->where(['Data.quiz_id' => $id])
            ->all()
            ->shuffle()
            ->sample(1)
            ->first();

        // Grab info
        $data = $this->Quizzes->Data->get($data->id, [
            'contain' => ['Attributes', 'Attributes.AttributeTypes']
        ]);

        // Select random attribute
        $attributeCollection = (new Collection($data->attributes))->sample(1);
        $attribute = $attributeCollection->first();

        // Select similar attributes
        $otherAttributes = $this->Quizzes->AttributeTypes->Attributes->find()
            ->where(['attribute_type_id' => $attribute->attribute_type_id])
            ->where(['id IS NOT' => $attribute->id])
            ->all()
            ->shuffle()
            ->sample(3)
            ->append($attributeCollection->toList());

        $this->set('data', $data);
        $this->set('correctAttribute', $attribute);
        $this->set('attributes', $otherAttributes);
        $this->set('_serialize', ['quiz']);
    }
}
