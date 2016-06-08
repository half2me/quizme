<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Attribute'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['controller' => 'AttributeTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['controller' => 'AttributeTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Data'), ['controller' => 'Data', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Data'), ['controller' => 'Data', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attributes index large-9 medium-8 columns content">
    <h3><?= __('Attributes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('attribute_type_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attributes as $attribute): ?>
            <tr>
                <td><?= $this->Number->format($attribute->id) ?></td>
                <td><?= $attribute->has('attribute_type') ? $this->Html->link($attribute->attribute_type->name, ['controller' => 'AttributeTypes', 'action' => 'view', $attribute->attribute_type->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $attribute->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attribute->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attribute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attribute->id)]) ?>
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
