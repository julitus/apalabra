<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Challenges Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\HasMany $Questions
 *
 * @method \App\Model\Entity\Challenge get($primaryKey, $options = [])
 * @method \App\Model\Entity\Challenge newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Challenge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Challenge|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Challenge saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Challenge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Challenge[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Challenge findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChallengesTable extends Table
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

        $this->setTable('challenges');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Questions', [
            'foreignKey' => 'challenge_id',
            'saveStrategy' => 'replace'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'challenge_id'
        ]);
        $this->hasMany('Records', [
            'foreignKey' => 'challenge_id'
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('time')
            ->requirePresence('time', 'create')
            ->notEmptyString('time');

        $validator
            ->scalar('code')
            ->maxLength('code', 32)
            ->allowEmptyString('code');

        $validator
            ->numeric('points')
            ->requirePresence('points', 'create')
            ->notEmptyString('points');

        $validator
            ->integer('rows')
            ->requirePresence('rows', 'create')
            ->notEmptyString('rows');

        $validator
            ->integer('attemps')
            ->notEmptyString('attemps');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
