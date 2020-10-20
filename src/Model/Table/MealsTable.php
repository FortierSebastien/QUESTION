<?php

// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class MealsTable extends Table {

    public function initialize(array $config) {
        
        parent::initialize($config);
   
        $this->addBehavior('Translate', ['fields' => ['nom']]);
   
        $this->addBehavior('Timestamp');
        
         $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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

}
