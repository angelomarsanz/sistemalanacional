<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Positions'), ['controller' => 'Positions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Position'), ['controller' => 'Positions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $employee->has('user') ? $this->Html->link($employee->user->username, ['controller' => 'Users', 'action' => 'view', $employee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code For User') ?></th>
            <td><?= h($employee->code_for_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($employee->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Name') ?></th>
            <td><?= h($employee->second_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($employee->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Surname') ?></th>
            <td><?= h($employee->second_surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sex') ?></th>
            <td><?= h($employee->sex) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nationality') ?></th>
            <td><?= h($employee->nationality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Identification') ?></th>
            <td><?= h($employee->type_of_identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identity Card') ?></th>
            <td><?= h($employee->identity_card) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rif') ?></th>
            <td><?= h($employee->rif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile Photo') ?></th>
            <td><?= h($employee->profile_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile Photo Dir') ?></th>
            <td><?= h($employee->profile_photo_dir) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Place Of Birth') ?></th>
            <td><?= h($employee->place_of_birth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Of Birth') ?></th>
            <td><?= h($employee->country_of_birth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone') ?></th>
            <td><?= h($employee->cell_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline') ?></th>
            <td><?= h($employee->landline) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($employee->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($employee->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Degree Instruction') ?></th>
            <td><?= h($employee->degree_instruction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Withdrawal') ?></th>
            <td><?= h($employee->reason_withdrawal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Classification') ?></th>
            <td><?= h($employee->classification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= $employee->has('position') ? $this->Html->link($employee->position->id, ['controller' => 'Positions', 'action' => 'view', $employee->position->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Working Agreement') ?></th>
            <td><?= h($employee->working_agreement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($employee->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hours Month') ?></th>
            <td><?= $this->Number->format($employee->hours_month) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percentage Imposed') ?></th>
            <td><?= $this->Number->format($employee->percentage_imposed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthdate') ?></th>
            <td><?= h($employee->birthdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Of Admission') ?></th>
            <td><?= h($employee->date_of_admission) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Retirement Date') ?></th>
            <td><?= h($employee->retirement_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Deleted') ?></th>
            <td><?= $employee->record_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
