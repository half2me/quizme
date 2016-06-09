<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Attribute'), ['action' => 'edit', $attribute->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attribute'), ['action' => 'delete', $attribute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attribute->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Attributes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attribute'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['controller' => 'AttributeTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['controller' => 'AttributeTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Data'), ['controller' => 'Data', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Data'), ['controller' => 'Data', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="attributes view large-9 medium-8 columns content">
    <h3><?= h($attribute->value) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Attribute Type') ?></th>
            <td><?= $attribute->has('attribute_type') ? $this->Html->link($attribute->attribute_type->name, ['controller' => 'AttributeTypes', 'action' => 'view', $attribute->attribute_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($attribute->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Value') ?></h4>
        <?= $this->Text->autoParagraph(h($attribute->value)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Data') ?></h4>
        <?php if (!empty($attribute->data)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Quiz Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($attribute->data as $data): ?>
            <tr>
                <td><?= h($data->id) ?></td>
                <td><?= h($data->quiz_id) ?></td>
                <td><?= h($data->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Data', 'action' => 'view', $data->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Data', 'action' => 'edit', $data->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Data', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
