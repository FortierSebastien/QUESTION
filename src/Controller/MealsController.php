<?php

// src/Controller/ArticlesController.php

namespace App\Controller;

class MealsController extends AppController {

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the meal belongs to the current user.
        $meal = $this->Meals->findBySlug($slug)->first();

        return $meal->user_id === $user['id'];
    }

    public function index() {
        $this->loadComponent('Paginator');
        $meals = $this->Paginator->paginate($this->Meals->find(
                        'all', [
                    'contain' => ['Users'],
        ]));
        $this->set(compact('meals'));
    }

    // Add to existing src/Controller/ArticlesController.php file

    public function view($slug = null) {
        $meal = $this->Meals->findBySlug($slug)->firstOrFail();
        $this->set(compact('meal'));
    }

    public function add() {
        $meal = $this->Meals->newEntity();
        if ($this->request->is('post')) {
            $meal = $this->Meals->patchEntity($meal, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $meal->user_id = $this->Auth->user('id');

            if ($this->Meals->save($meal)) {
                $this->Flash->success(__('Your meal has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your meal.'));
        }
        $this->set('meal', $meal);
    }

    public function edit($slug) {
        $meal = $this->Meals->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Meals->patchEntity($meal, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);

            if ($this->Meals->save($meal)) {
                $this->Flash->success(__('Your meal has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your meal.'));
        }

        $this->set('meal', $meal);
    }

    public function delete($slug) {
        $this->request->allowMethod(['post', 'delete']);

        $meal = $this->Meals->findBySlug($slug)->firstOrFail();
        if ($this->Meals->delete($meal)) {
            $this->Flash->success(__('The {0} meal has been deleted.', $meal->nom));
            return $this->redirect(['action' => 'index']);
        }
    }

}
