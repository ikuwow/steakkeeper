<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->notEmpty('id')
            ->add('id', 'valid', ['rule' => 'numeric']);

        $validator
            ->notEmpty('gh_user_id')
            ->add('gh_user_id', 'valid', ['rule' => 'numeric'])
            ->add('gh_user_id', ['unique' => ['rule' => 'validateUnique', 'provider' => 'table']]);

        $validator
            // ->notEmpty('email', 'Please input email address.')
            ->allowEmpty('email')
            ->add('email', 'valid', ['rule' => 'email', 'message' => 'Invalid email address.'])
            ->add('email', ['unique' => [
                'rule' => 'validateUnique', 'provider' => 'table', 'message' => 'That address is already exists.'
            ]]);

        $validator
            ->notEmpty('password');

        $validator
            ->notEmpty('name', 'Please fill username')
            ->add('name', ['max' => ['rule' => ['maxLength', 32], 'message' => 'username must be between 4 and 32']])
            ->add('name', ['min' => ['rule' => ['minLength', 4], 'message' => 'username must be between 4 and 32']])
            ->add('name', ['unique' => [
                'rule' => 'validateUnique', 'provider' => 'table', 'message' => 'That username is already exists.'
            ]])
            ->add('name', 'valid', [
                'rule' => function ($value, $context) {
                    return (bool)preg_match('/^[0-9a-zA-Z\.\-_]+$/', $value);
                }
            ]);

        $validator
            ->notEmpty('access_token')
            ->add('access_token', 'valid', ['rule' => 'alphaNumeric'])
            ->add('name', ['unique' => [
                'rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Non-unique access token.'
            ]]);

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
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
