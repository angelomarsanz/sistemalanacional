<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Patienthistory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="patienthistories index large-9 medium-8 columns content">
    <h3><?= __('Patienthistories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('short_description_activity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('detailed_activity_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_date_finish') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_result') ?></th>
                <th scope="col"><?= $this->Paginator->sort('detailed_result_activity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsible_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted_record') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patienthistories as $patienthistory): ?>
            <tr>
                <td><?= $this->Number->format($patienthistory->id) ?></td>
                <td><?= $patienthistory->has('budget') ? $this->Html->link($patienthistory->budget->id, ['controller' => 'Budgets', 'action' => 'view', $patienthistory->budget->id]) : '' ?></td>
                <td><?= h($patienthistory->activity_date) ?></td>
                <td><?= h($patienthistory->short_description_activity) ?></td>
                <td><?= h($patienthistory->detailed_activity_description) ?></td>
                <td><?= h($patienthistory->activity_date_finish) ?></td>
                <td><?= h($patienthistory->activity_result) ?></td>
                <td><?= h($patienthistory->detailed_result_activity) ?></td>
                <td><?= h($patienthistory->responsible_user) ?></td>
                <td><?= h($patienthistory->deleted_record) ?></td>
                <td><?= h($patienthistory->created) ?></td>
                <td><?= h($patienthistory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $patienthistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patienthistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patienthistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patienthistory->id)]) ?>
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
