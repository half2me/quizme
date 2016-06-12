<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Data;
use Cake\Collection\Collection;
use Cake\Utility\Hash;

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

                // If CSV is attached, parse and save
                if (!empty($this->request->data['csv']['tmp_name'])) {
                    $csv = [];
                    foreach (file($this->request->data['csv']['tmp_name']) as $row) {
                        $csv[] = str_getcsv($row, ";");
                    }

                    $dataEntity = null;

                    foreach ($csv as $rowNum => $row) {
                        foreach ($row as $columnNum => $cell) {
                            if ($rowNum != 0) { // First row contains column names
                                if (strlen($cell)) {
                                    if ($columnNum == 0) {
                                        // New data entity
                                        $dataEntity = $this->Quizzes->Data->newEntity();
                                        $dataEntity->name = $cell;
                                        $dataEntity->quiz_id = $quiz->id;
                                        $this->Quizzes->Data->save($dataEntity);
                                    } else {
                                        // attribute for last added data entity
                                        $attType = $this->Quizzes->AttributeTypes->findByName($csv[0][$columnNum])->first();
                                        if (!$attType) {
                                            // Create new one
                                            $attType = $this->Quizzes->AttributeTypes->newEntity();
                                            $attType->name = $csv[0][$columnNum];
                                            $attType->quiz_id = $quiz->id;
                                            $this->Quizzes->AttributeTypes->save($attType);
                                        }

                                        // Process multiple attributes
                                        $split = explode(", ", $cell);
                                        if (count($split) > 1) {
                                            // Multiple values allowed, set cardinality bit
                                            $attType->cardinality = true;
                                            $this->Quizzes->AttributeTypes->save($attType);
                                        }

                                        foreach ($split as $a) {
                                            $att = $this->Quizzes->Data->Attributes->findByValue($a)->first();
                                            if (!$att) {
                                                // Create new attribute
                                                $att = $this->Quizzes->Data->Attributes->newEntity();
                                                $att->value = $a;
                                                $att->attribute_type_id = $attType->id;
                                                $this->Quizzes->Data->Attributes->save($att);
                                            }
                                            $this->Quizzes->Data->Attributes->link($dataEntity, [$att]);
                                            $this->Quizzes->Data->Attributes->save($att);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

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
    public function random($id = null)
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

        $goodAtts = Hash::extract($data->attributes, '{n}.id');

        // Select random attribute
        $attributeCollection = (new Collection($data->attributes))->shuffle()->sample(1);
        $attribute = $attributeCollection->first();

        // Select similar bad attributes
        $otherAttributes = $this->Quizzes->AttributeTypes->Attributes->find()
            ->where(['Attributes.attribute_type_id' => $attribute->attribute_type_id])
            ->where(['Attributes.id NOT IN' => $goodAtts])
            ->all()
            ->shuffle()
            ->sample(3)
            ->append($attributeCollection);

        $otherAttributes = new Collection($otherAttributes->toList());
        $otherAttributes = $otherAttributes->shuffle();

        $this->set('data', $data);
        $this->set('correctAttribute', $attribute);
        $this->set('attributes', $otherAttributes);
        $this->set('_serialize', ['quiz']);
    }

    public function random2($id = null)
    {
        // Quiz type 2 ask about data for attribute

        // Select random attribute
        $attribute = $this->Quizzes->Data->Attributes->find()
            ->select('Attributes.id')
            ->matching('Data', function($q) use ($id) {
                return $q->where(['quiz_id' => $id]);
            })
            ->all()
            ->shuffle()
            ->sample(1)
            ->first();

        // Grab info
        $attribute = $this->Quizzes->Data->Attributes->get($attribute->id, [
            'contain' => ['AttributeTypes', 'Data']
        ]);

        $goodData = Hash::extract($attribute->data, '{n}.id');

        // Select random good data
        $dataCollection = (new Collection($attribute->data))->shuffle()->sample(1);
        $data = $dataCollection->first();

        // Select similar bad data
        $otherData = $this->Quizzes->Data->find()
            ->where(['Data.quiz_id' => $id])
            ->where(['Data.id NOT IN' => $goodData])
            ->matching('Attributes', function ($q) use ($attribute) {
                return $q->where(['Attributes.attribute_type_id' => $attribute->attribute_type_id]);
            })
            ->all()
            ->shuffle()
            ->sample(3)
            ->append($dataCollection);

        $otherData = new Collection($otherData->toList());
        $otherData = $otherData->shuffle();

        $this->set('correctData', $data);
        $this->set('attribute', $attribute);
        $this->set('data', $otherData);
        $this->set('_serialize', ['quiz']);
    }
}
