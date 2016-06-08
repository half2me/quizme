<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attribute->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $attribute->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Attributes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Attribute Types'), ['controller' => 'AttributeTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attribute Type'), ['controller' => 'AttributeTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Data'), ['controller' => 'Data', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Data'), ['controller' => 'Data', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="attributes form large-9 medium-8 columns content">
    <?= $this->Form->create($attribute) ?>
    <fieldset>
        <legend><?= __('Edit Attribute') ?></legend>
        <?php
            echo $this->Form->input('attribute_type_id', ['options' => $attributeTypes]);
            echo $this->Form->input('value');
            echo $this->Form->input('data._ids', ['options' => $data]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
