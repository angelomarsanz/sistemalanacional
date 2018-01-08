<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Multilevel'), ['action' => 'edit', $multilevel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Multilevel'), ['action' => 'delete', $multilevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multilevel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Multilevels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multilevel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="multilevels view large-9 medium-8 columns content">
    <h3><?= h($multilevel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $multilevel->has('user') ? $this->Html->link($multilevel->user->username, ['controller' => 'Users', 'action' => 'view', $multilevel->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Father') ?></th>
            <td><?= h($multilevel->father) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($multilevel->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Name') ?></th>
            <td><?= h($multilevel->second_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($multilevel->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Surname') ?></th>
            <td><?= h($multilevel->second_surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sex') ?></th>
            <td><?= h($multilevel->sex) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Identification') ?></th>
            <td><?= h($multilevel->type_of_identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identidy Card') ?></th>
            <td><?= h($multilevel->identidy_card) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profession') ?></th>
            <td><?= h($multilevel->profession) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone') ?></th>
            <td><?= h($multilevel->cell_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline') ?></th>
            <td><?= h($multilevel->landline) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($multilevel->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($multilevel->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province State') ?></th>
            <td><?= h($multilevel->province_state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($multilevel->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($multilevel->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account Number') ?></th>
            <td><?= h($multilevel->account_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank') ?></th>
            <td><?= h($multilevel->bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Address') ?></th>
            <td><?= h($multilevel->bank_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swift Bank') ?></th>
            <td><?= h($multilevel->swift_bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aba Bank') ?></th>
            <td><?= h($multilevel->aba_bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($multilevel->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($multilevel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthdate') ?></th>
            <td><?= h($multilevel->birthdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deactivation Date') ?></th>
            <td><?= h($multilevel->deactivation_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($multilevel->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($multilevel->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $multilevel->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Record') ?></th>
            <td><?= $multilevel->delete_record ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
