<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Diarypatient'), ['action' => 'edit', $diarypatient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Diarypatient'), ['action' => 'delete', $diarypatient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diarypatient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Diarypatients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diarypatient'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="diarypatients view large-9 medium-8 columns content">
    <h3><?= h($diarypatient->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $diarypatient->has('budget') ? $this->Html->link($diarypatient->budget->id, ['controller' => 'Budgets', 'action' => 'view', $diarypatient->budget->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description Activity') ?></th>
            <td><?= h($diarypatient->short_description_activity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Detailed Activity Description') ?></th>
            <td><?= h($diarypatient->detailed_activity_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Result') ?></th>
            <td><?= h($diarypatient->activity_result) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Detailed Result Activity') ?></th>
            <td><?= h($diarypatient->detailed_result_activity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($diarypatient->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($diarypatient->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Date') ?></th>
            <td><?= h($diarypatient->activity_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Date Finish') ?></th>
            <td><?= h($diarypatient->activity_date_finish) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($diarypatient->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($diarypatient->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Record') ?></th>
            <td><?= $diarypatient->deleted_record ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
