<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Patients'), ['controller' => 'Patients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Patient'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diarypatients'), ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diarypatient'), ['controller' => 'Diarypatients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Patienthistories'), ['controller' => 'Patienthistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Patienthistory'), ['controller' => 'Patienthistories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="budgets index large-9 medium-8 columns content">
    <h3><?= __('Budgets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('patient_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('application date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surgery') ?></th>
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
            <?php foreach ($budgets as $budget): ?>
            <tr>
                <td><?= $this->Number->format($budget->id) ?></td>
                <td><?= $budget->has('patient') ? $this->Html->link($budget->patient->id, ['controller' => 'Patients', 'action' => 'view', $budget->patient->id]) : '' ?></td>
                <td><?= h($budget->application date) ?></td>
                <td><?= h($budget->surgery) ?></td>
                <td><?= h($budget->activity_date_finish) ?></td>
                <td><?= h($budget->activity_result) ?></td>
                <td><?= h($budget->detailed_result_activity) ?></td>
                <td><?= h($budget->responsible_user) ?></td>
                <td><?= h($budget->deleted_record) ?></td>
                <td><?= h($budget->created) ?></td>
                <td><?= h($budget->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $budget->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $budget->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $budget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $budget->id)]) ?>
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
