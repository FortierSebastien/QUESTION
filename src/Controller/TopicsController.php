<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['getByTopic', 'add', 'edit', 'delete']);
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    { 
        
        $this->viewBuilder()->setLayout('topicsSpa');
        $topics = $this->Topics->find('all');
        
//        $krajRegions = $this->paginate($this->KrajRegions);
        
      //  $topics = $this->paginate($this->Topics);

        $this->set(compact('topics'));
}

    }