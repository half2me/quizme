<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quizzes'), ['controller' => 'Quizzes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quiz'), ['controller' => 'Quizzes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attributes'), ['controller' => 'Attributes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attribute'), ['controller' => 'Attributes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attributeTypes index large-9 medium-8 columns content">
    <h3><?= __('Attribute Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('cardinality') ?></th>
                <th><?= $this->Paginator->sort('quiz_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attributeTypes as $attributeType): ?>
            <tr>
                <td><?= $this->Number->format($attributeType->id) ?></td>
                <td><?= h($attributeType->name) ?></td>
                <td><?= $this->Number->format($attributeType->cardinality) ?></td>
                <td><?= $attributeType->has('quiz') ? $this->Html->link($attributeType->quiz->id, ['controller' => 'Quizzes', 'action' => 'view', $attributeType->quiz->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $attributeType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attributeType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attributeType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attributeType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
