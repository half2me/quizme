<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attributeType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $attributeType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['controller' => 'Quizzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quiz'), ['controller' => 'Quizzes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attributes'), ['controller' => 'Attributes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attribute'), ['controller' => 'Attributes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attributeTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($attributeType) ?>
    <fieldset>
        <legend><?= __('Edit Attribute Type') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('cardinality');
            echo $this->Form->input('quiz_id', ['options' => $quizzes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
