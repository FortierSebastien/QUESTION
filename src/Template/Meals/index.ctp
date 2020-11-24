<!-- File: src/Template/Meals/index.ctp  (edit links added) -->


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Meal'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Meal'), ['controller' => 'Meals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Client'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
         <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Categorie'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categorie'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="meals index large-9 medium-8 columns content">
    <h3><?= __('Meals') ?></h3>
<?= $this->Html->link("Add Meal", ['action' => 'add']) ?>
    <table cellpadding="0" cellspacing="0">

    <tr>
        <th><?= __('Title')?></th>
        <th><?= __('Created')?></th>
        <th><?= __('Image')?></th>
        <th><?= __('By')?></th>
        <th><?= __('Action')?></th>

    </tr>

<!-- Here's where we iterate through our $meals query object, printing out meal info -->

<?php foreach ($meals as $meal): ?>
    <tr>
        <td>
            <?= $this->Html->link($meal->nom, ['action' => 'view', $meal->slug]) ?>
        </td>
        <td>
            <?= $meal->created->format(DATE_RFC850) ?>
        </td>
        <td>
        <?php
            if(isset($meal->files[0])){
                
                echo $this->Html->image($meal->files[0]->path . $meal->files[0]->name,[
                "alt" => $meal->files[0]->name,
                "width" => "200px",
                "height" => "150px",
                'url' => ['controller' => 'Files', 'action' => 'view', $meal->files[0]->id]
                ]);
            }
            ?>
        </td>
 <td>
            <?= $this->Html->link($meal->user->email, ['controller' => 'users', 'action' => 'view', $meal->user_id])?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $meal->slug]) ?>
  
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $meal->slug],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>
</div>