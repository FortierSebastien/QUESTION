<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $topics = $this->Topics->find('all');
        $this->set([
            'topics' => $topics,
            '_serialize' => ['topics']
        ]);
    }

    public function view($id)
    {
        $topic = $this->Topics->get($id);
        $this->set([
            'topic' => $topic,
            '_serialize' => ['topic']
        ]);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $topic = $this->Topics->newEntity($this->request->getData());
        if ($this->Topics->save($topic)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'topic' => $topic,
            '_serialize' => ['message', 'topic']
        ]);
    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $topic = $this->Topics->get($id);
        $topic = $this->Topics->patchEntity($topic, $this->request->getData());
        if ($this->Topics->save($topic)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $topic = $this->Topics->get($id);
        $message = 'Deleted';
        if (!$this->Topics->delete($topic)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }


}
