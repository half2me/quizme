<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Attribute Type'), ['action' => 'edit', $attributeType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attribute Type'), ['action' => 'delete', $attributeType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attributeType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quizzes'), ['controller' => 'Quizzes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quiz'), ['controller' => 'Quizzes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attributes'), ['controller' => 'Attributes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attribute'), ['controller' => 'Attributes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="attributeTypes view large-9 medium-8 columns content">
    <h3><?= h($attributeType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($attributeType->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Quiz') ?></th>
            <td><?= $attributeType->has('quiz') ? $this->Html->link($attributeType->quiz->name, ['controller' => 'Quizzes', 'action' => 'view', $attributeType->quiz->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($attributeType->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cardinality') ?></th>
            <td><?= $attributeType->cardinality ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Attributes') ?></h4>
        <?php if (!empty($attributeType->attributes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Attribute Type Id') ?></th>
                <th><?= __('Value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($attributeType->attributes as $attributes): ?>
            <tr>
                <td><?= h($attributes->id) ?></td>
                <td><?= h($attributes->attribute_type_id) ?></td>
                <td><?= h($attributes->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Attributes', 'action' => 'view', $attributes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Attributes', 'action' => 'edit', $attributes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attributes', 'action' => 'delete', $attributes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attributes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
