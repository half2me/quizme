<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $quiz->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $quiz->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['controller' => 'AttributeTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['controller' => 'AttributeTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Data'), ['controller' => 'Data', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Data'), ['controller' => 'Data', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shared Users'), ['controller' => 'SharedUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shared User'), ['controller' => 'SharedUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quizzes form large-9 medium-8 columns content">
    <?= $this->Form->create($quiz) ?>
    <fieldset>
        <legend><?= __('Edit Quiz') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
