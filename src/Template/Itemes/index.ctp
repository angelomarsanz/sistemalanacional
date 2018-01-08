<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Iteme'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemes index large-9 medium-8 columns content">
    <h3><?= __('Itemes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('registration_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsible_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemes as $iteme): ?>
            <tr>
                <td><?= $this->Number->format($iteme->id) ?></td>
                <td><?= $iteme->has('budget') ? $this->Html->link($iteme->budget->id, ['controller' => 'Budgets', 'action' => 'view', $iteme->budget->id]) : '' ?></td>
                <td><?= h($iteme->registration_status) ?></td>
                <td><?= h($iteme->reason_status) ?></td>
                <td><?= h($iteme->date_status) ?></td>
                <td><?= h($iteme->responsible_user) ?></td>
                <td><?= h($iteme->created) ?></td>
                <td><?= h($iteme->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $iteme->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $iteme->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $iteme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $iteme->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
