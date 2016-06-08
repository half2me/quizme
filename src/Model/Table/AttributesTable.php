<?php
namespace App\Model\Table;

use App\Model\Entity\Attribute;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attributes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AttributeTypes
 * @property \Cake\ORM\Association\BelongsToMany $Data
 */
class AttributesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('attributes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('AttributeTypes', [
            'foreignKey' => 'attribute_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Data', [
            'foreignKey' => 'attribute_id',
            'targetForeignKey' => 'data_id',
            'joinTable' => 'data_attributes'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['attribute_type_id'], 'AttributeTypes'));
        return $rules;
    }
}
