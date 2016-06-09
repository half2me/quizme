<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quizzes'), ['controller' => 'Quizzes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quiz'), ['controller' => 'Quizzes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shared Users'), ['controller' => 'SharedUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shared User'), ['controller' => 'SharedUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Quizzes') ?></h4>
        <?php if (!empty($user->quizzes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->quizzes as $quizzes): ?>
            <tr>
                <td><?= h($quizzes->id) ?></td>
                <td><?= h($quizzes->user_id) ?></td>
                <td><?= h($quizzes->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Quizzes', 'action' => 'view', $quizzes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Quizzes', 'action' => 'edit', $quizzes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Quizzes', 'action' => 'delete', $quizzes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quizzes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Shared Users') ?></h4>
        <?php if (!empty($user->shared_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Quiz Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->shared_users as $sharedUsers): ?>
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
