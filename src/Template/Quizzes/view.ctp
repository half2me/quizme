<?php
use Cake\Utility\Hash;
?>

    <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Quiz'), ['action' => 'edit', $quiz->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Quiz'), ['action' => 'delete', $quiz->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quiz->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Quizzes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quiz'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['controller' => 'AttributeTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['controller' => 'AttributeTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Data'), ['controller' => 'Data', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Data'), ['controller' => 'Data', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shared Users'), ['controller' => 'SharedUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shared User'), ['controller' => 'SharedUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="quizzes view large-9 medium-8 columns content">
    <h3><?= h($quiz->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Owner') ?></th>
            <td><?= $quiz->has('user') ? $this->Html->link($quiz->user->name, ['controller' => 'Users', 'action' => 'view', $quiz->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($quiz->name) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Quiz Data') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <?php foreach ($quiz->attribute_types as $attributeType): ?>
                    <td><?= h($attributeType->name) ?></td>
                <?php endforeach; ?>
            </tr>
            <?php if (!empty($quiz->data)): ?>
            <?php foreach ($quiz->data as $data): ?>
            <tr>
                <td><?= h($data->id) ?></td>
                <td>Name</td>
                <?php
                foreach ($quiz->attribute_types as $attributeType) {
                    $att = implode(', ', Hash::extract($data->attributes, "{n}[attribute_type_id={$attributeType->id}].value"));
                    echo "<td>$att</td>";
                }
                ?>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
