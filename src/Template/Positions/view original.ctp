<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Position'), ['action' => 'edit', $position->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Position'), ['action' => 'delete', $position->id], ['confirm' => __('Are you sure you want to delete # {0}?', $position->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Positions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Position'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="positions view large-9 medium-8 columns content">
    <h3><?= h($position->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($position->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Salary') ?></th>
            <td><?= h($position->type_of_salary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Salary Increase') ?></th>
            <td><?= h($position->reason_salary_increase) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($position->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($position->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Wage') ?></th>
            <td><?= $this->Number->format($position->minimum_wage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Effective Date Increase') ?></th>
            <td><?= h($position->effective_date_increase) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($position->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($position->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Deleted') ?></th>
            <td><?= $position->record_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($position->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Code For User') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Second Name') ?></th>
                <th scope="col"><?= __('Surname') ?></th>
                <th scope="col"><?= __('Second Surname') ?></th>
                <th scope="col"><?= __('Sex') ?></th>
                <th scope="col"><?= __('Nationality') ?></th>
                <th scope="col"><?= __('Type Of Identification') ?></th>
                <th scope="col"><?= __('Identity Card') ?></th>
                <th scope="col"><?= __('Rif') ?></th>
                <th scope="col"><?= __('Profile Photo') ?></th>
                <th scope="col"><?= __('Profile Photo Dir') ?></th>
                <th scope="col"><?= __('Place Of Birth') ?></th>
                <th scope="col"><?= __('Country Of Birth') ?></th>
                <th scope="col"><?= __('Birthdate') ?></th>
                <th scope="col"><?= __('Cell Phone') ?></th>
                <th scope="col"><?= __('Landline') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Degree Instruction') ?></th>
                <th scope="col"><?= __('Date Of Admission') ?></th>
                <th scope="col"><?= __('Retirement Date') ?></th>
                <th scope="col"><?= __('Reason Withdrawal') ?></th>
                <th scope="col"><?= __('Classification') ?></th>
                <th scope="col"><?= __('Position Id') ?></th>
                <th scope="col"><?= __('Working Agreement') ?></th>
                <th scope="col"><?= __('Hours Month') ?></th>
                <th scope="col"><?= __('Percentage Imposed') ?></th>
                <th scope="col"><?= __('Record Deleted') ?></th>
                <th scope="col"><?= __('Responsible User') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($position->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->user_id) ?></td>
                <td><?= h($employees->code_for_user) ?></td>
                <td><?= h($employees->first_name) ?></td>
                <td><?= h($employees->second_name) ?></td>
                <td><?= h($employees->surname) ?></td>
                <td><?= h($employees->second_surname) ?></td>
                <td><?= h($employees->sex) ?></td>
                <td><?= h($employees->nationality) ?></td>
                <td><?= h($employees->type_of_identification) ?></td>
                <td><?= h($employees->identity_card) ?></td>
                <td><?= h($employees->rif) ?></td>
                <td><?= h($employees->profile_photo) ?></td>
                <td><?= h($employees->profile_photo_dir) ?></td>
                <td><?= h($employees->place_of_birth) ?></td>
                <td><?= h($employees->country_of_birth) ?></td>
                <td><?= h($employees->birthdate) ?></td>
                <td><?= h($employees->cell_phone) ?></td>
                <td><?= h($employees->landline) ?></td>
                <td><?= h($employees->email) ?></td>
                <td><?= h($employees->address) ?></td>
                <td><?= h($employees->degree_instruction) ?></td>
                <td><?= h($employees->date_of_admission) ?></td>
                <td><?= h($employees->retirement_date) ?></td>
                <td><?= h($employees->reason_withdrawal) ?></td>
                <td><?= h($employees->classification) ?></td>
                <td><?= h($employees->position_id) ?></td>
                <td><?= h($employees->working_agreement) ?></td>
                <td><?= h($employees->hours_month) ?></td>
                <td><?= h($employees->percentage_imposed) ?></td>
                <td><?= h($employees->record_deleted) ?></td>
                <td><?= h($employees->responsible_user) ?></td>
                <td><?= h($employees->created) ?></td>
                <td><?= h($employees->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
