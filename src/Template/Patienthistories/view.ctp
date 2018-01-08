<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Patienthistory'), ['action' => 'edit', $patienthistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Patienthistory'), ['action' => 'delete', $patienthistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patienthistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Patienthistories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patienthistory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="patienthistories view large-9 medium-8 columns content">
    <h3><?= h($patienthistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $patienthistory->has('budget') ? $this->Html->link($patienthistory->budget->id, ['controller' => 'Budgets', 'action' => 'view', $patienthistory->budget->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description Activity') ?></th>
            <td><?= h($patienthistory->short_description_activity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Detailed Activity Description') ?></th>
            <td><?= h($patienthistory->detailed_activity_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Result') ?></th>
            <td><?= h($patienthistory->activity_result) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Detailed Result Activity') ?></th>
            <td><?= h($patienthistory->detailed_result_activity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($patienthistory->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($patienthistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Date') ?></th>
            <td><?= h($patienthistory->activity_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Date Finish') ?></th>
            <td><?= h($patienthistory->activity_date_finish) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($patienthistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($patienthistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Record') ?></th>
            <td><?= $patienthistory->deleted_record ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
