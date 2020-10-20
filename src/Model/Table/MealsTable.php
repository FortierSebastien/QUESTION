<?php

// src/Model/Table/sTable.php

namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class MealsTable extends Table {

    public function initialize(array $config) {
        
        parent::initialize($config);
         $this->setTable('meals');
        $this->setDisplayField('nom');
        $this->setPrimaryKey('id');
   
        $this->addBehavior('Translate', ['fields' => ['nom']]);
   
        $this->addBehavior('Timestamp');
        
         $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
             'joinType' => 'INNER',
        ]);
          $this->hasMany('Clients', [
            'foreignKey' => 'meal_id',
        ]);
       
          
          $this->belongsToMany('Tags', [
            'foreignKey' => 'meal_id',
              'targetForeignKey'=> 'tag_id',
              'joinTable' => 'meals_tags',
        ]);
    }

// Add the following method.

    public function beforeSave($event, $entity, $options) {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->nom);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 61);
        }
    }
    

// Add the following method.
public function validationDefault(Validator $validator)
{
    $validator
        ->allowEmptyString('prix', false)
        ->minLength('title', 1)
        ->maxLength('title', 10)

        ->allowEmptyString('nom', false)
        ->minLength('nom', 3);

    return $validator;
}

  public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    
    

// The $query argument is a query builder instance.
// The $options array will contain the 'tags' option we passed
// to find('tagged') in our controller action.
    public function findTagged(Query $query, array $options) {
        $columns = [
            'Meals.id', 'Meals.user_id', 'Meals.nom',
            'Meals.prix', 'Meals.date','Meals.grosseur', 'Meals.created',
            'Meals.slug',
        ];

        $query = $query
                ->select($columns)
                ->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find meals that have no tags.
            $query->leftJoinWith('Tags')
                    ->where(['Tags.nom IS' => null]);
        } else {
            // Find meals that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                    ->where(['Tags.nom IN' => $options['tags']]);
        }

        return $query->group(['Meals.id']);
    }


}
