<h1>
    s tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
<?php foreach ($meals as $meal): ?>
    <meal>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $meal->title,
            ['controller' => 's', 'action' => 'view', $meal->slug]
        ) ?></h4>
        <span><?= h($meal->created) ?></span>
    </meal>
<?php endforeach; ?>
</section>