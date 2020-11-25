<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Restaurant $restaurant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $restaurant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Restaurants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Topics'), ['controller' => 'Topics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Topic'), ['controller' => 'Topics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="restaurants form large-9 medium-8 columns content">
    <?= $this->Form->create($restaurant) ?>
    <fieldset>
        <legend><?= __('Edit Restaurant') ?></legend>
        <?php
            echo $this->Form->control('topic_id', ['options' => $topics]);
            echo $this->Form->control('code');
            echo $this->Form->control('nom');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
