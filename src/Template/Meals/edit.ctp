<!-- File: src/Template/Meals/edit.ctp -->

<h1>Edit Meal</h1>
<?php
    echo $this->Form->create($meal);
    echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('nom');
    echo $this->Form->control('prix', ['rows' => '3']);
    echo $this->Form->control('date');
    echo $this->Form->control('grosseur');
    echo $this->Form->button(__('Save Meal'));
    echo $this->Form->end();
?>