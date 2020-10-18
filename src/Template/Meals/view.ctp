<!-- File: src/Template/Articles/view.ctp -->

<h1><?= h($meal->nom) ?> </h1>
<h3>Prix du repas: <?= h($meal->prix) ?>$ </h3>
<p>Date de découverte du repas: <?= h($meal->date) ?></p>
<p>Grosseur du repas: <?= h($meal->grosseur) ?></p>

<p><small>Created: <?= $meal->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $meal->slug]) ?></p>


<p><?php
    $this->request->getSession()->write('Meal.id', $meal->id);
    $this->request->getSession()->write('Meal.slug', $meal->slug);
    echo $this->Html->link(__('New Comment'), ['controller' => 'Clients', 'action' => 'add']);
    ?></p>
<div class="related">
    <h4><?= __('Related Clients') ?></h4>
    <?php if (!empty($meal->clients)): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('note') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('commentaire') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('detail') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>

                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($meal->clients as $client): ?>
                    <tr>
                        <td><?= $this->Number->format($client->id) ?></td>
                        <td><?= h($client->note) ?></td>
                        <td><?= h($client->commentaire) ?></td>
                        <td><?= h($client->detail) ?></td>
                        <td><?= h($client->created) ?></td>
                        <td><?= h($client->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Clients', 'action' => 'view', $client->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Clients', 'action' => 'edit', $client->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clients', 'action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>