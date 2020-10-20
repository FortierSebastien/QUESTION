<!-- File: src/Template/Meals/add.ctp -->

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Meal'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Client'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="meals index large-9 medium-8 columns content">
    <h3><?= __('Meals') ?></h3>

    
<?php
    echo $this->Form->create($meal);
    // Hard code the user for now.
    
    
    
    echo $this->Form->control('nom');
    echo $this->Form->control('prix');
    echo $this->Form->control('date');
    echo $this->Form->control('grosseur');
    echo $this->Form->control('employer_id', ['type' => 'hidden', 'value' => 3]);
    echo $this->Form->control('client_id', ['type' => 'hidden', 'value' => 2]);
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('tags._ids', ['options' => $tags]);
    
    echo $this->Form->button(__('Save Meal'));
    echo $this->Form->end();
    ?></div>