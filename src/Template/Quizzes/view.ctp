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
            <th><?= __('User') ?></th>
            <td><?= $quiz->has('user') ? $this->Html->link($quiz->user->name, ['controller' => 'Users', 'action' => 'view', $quiz->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($quiz->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Attribute Types') ?></h4>
        <?php if (!empty($quiz->attribute_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Cardinality') ?></th>
                <th><?= __('Quiz Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($quiz->attribute_types as $attributeTypes): ?>
            <tr>
                <td><?= h($attributeTypes->id) ?></td>
                <td><?= h($attributeTypes->name) ?></td>
                <td><?= h($attributeTypes->cardinality) ?></td>
                <td><?= h($attributeTypes->quiz_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AttributeTypes', 'action' => 'view', $attributeTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AttributeTypes', 'action' => 'edit', $attributeTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AttributeTypes', 'action' => 'delete', $attributeTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attributeTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Data') ?></h4>
        <?php if (!empty($quiz->data)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Quiz Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($quiz->data as $data): ?>
            <tr>
                <td><?= h($data->id) ?></td>
                <td><?= h($data->quiz_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Shared Users') ?></h4>
        <?php if (!empty($quiz->shared_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Quiz Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($quiz->shared_users as $sharedUsers): ?>
            <tr>
                <td><?= h($sharedUsers->quiz_id) ?></td>
                <td><?= h($sharedUsers->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SharedUsers', 'action' => 'view', $sharedUsers->quiz_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SharedUsers', 'action' => 'edit', $sharedUsers->quiz_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SharedUsers', 'action' => 'delete', $sharedUsers->quiz_id], ['confirm' => __('Are you sure you want to delete # {0}?', $sharedUsers->quiz_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
