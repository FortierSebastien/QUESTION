<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Meals'), ['controller' => 'Meals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal'), ['controller' => 'Meals', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($file->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($file->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($file->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $file->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Meals') ?></h4>
        <?php if (!empty($file->meals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Prix') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Grosseur') ?></th>
                <th scope="col"><?= __('Employer Id') ?></th>
                <th scope="col"><?= __('Client Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Nom') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($file->meals as $meals): ?>
            <tr>
                <td><?= h($meals->id) ?></td>
                <td><?= h($meals->prix) ?></td>
                <td><?= h($meals->date) ?></td>
                <td><?= h($meals->grosseur) ?></td>
                <td><?= h($meals->employer_id) ?></td>
                <td><?= h($meals->client_id) ?></td>
                <td><?= h($meals->user_id) ?></td>
                <td><?= h($meals->created) ?></td>
                <td><?= h($meals->modified) ?></td>
                <td><?= h($meals->slug) ?></td>
                <td><?= h($meals->nom) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Meals', 'action' => 'view', $meals->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Meals', 'action' => 'edit', $meals->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Meals', 'action' => 'delete', $meals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
