<!-- File: src/Template/Articles/add.ctp -->

<h1>Add Meal</h1>
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
    
    
    echo $this->Form->button(__('Save Meal'));
    echo $this->Form->end();
?>