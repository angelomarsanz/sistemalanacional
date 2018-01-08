<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Patient'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Supervisors'), ['controller' => 'Supervisors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supervisor'), ['controller' => 'Supervisors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promoters'), ['controller' => 'Promoters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promoter'), ['controller' => 'Promoters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diarypatients'), ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diarypatient'), ['controller' => 'Diarypatients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historypatients'), ['controller' => 'Historypatients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historypatient'), ['controller' => 'Historypatients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Servicescontracts'), ['controller' => 'Servicescontracts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Servicescontract'), ['controller' => 'Servicescontracts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="patients index large-9 medium-8 columns content">
    <h3><?= __('Patients') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supervisor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promoter_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('another_half_capture') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sex') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_of_identification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identidy_card') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profession') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_not_specified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('workplace') ?></th>
                <th scope="col"><?= $this->Paginator->sort('professional_position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landline') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('swift_bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aba_bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_name_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_surname_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_of_identification_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identidy_card_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landline_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_phone_emergency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_name_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_surname_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_of_identification_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identidy_card_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landline_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_phone_companion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_own_resources') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sponsor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sponsor_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sponsor_identification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address_sponsor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_sponsor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landline_sponsor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_phone_sponsor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_diary_patient') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_history_patient') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsible_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('record_delete') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $this->Number->format($patient->id) ?></td>
                <td><?= $patient->has('user') ? $this->Html->link($patient->user->id, ['controller' => 'Users', 'action' => 'view', $patient->user->id]) : '' ?></td>
                <td><?= $patient->has('supervisor') ? $this->Html->link($patient->supervisor->id, ['controller' => 'Supervisors', 'action' => 'view', $patient->supervisor->id]) : '' ?></td>
                <td><?= $patient->has('promoter') ? $this->Html->link($patient->promoter->id, ['controller' => 'Promoters', 'action' => 'view', $patient->promoter->id]) : '' ?></td>
                <td><?= $patient->has('vendor') ? $this->Html->link($patient->vendor->id, ['controller' => 'Vendors', 'action' => 'view', $patient->vendor->id]) : '' ?></td>
                <td><?= h($patient->another_half_capture) ?></td>
                <td><?= h($patient->first_name) ?></td>
                <td><?= h($patient->second_name) ?></td>
                <td><?= h($patient->surname) ?></td>
                <td><?= h($patient->second_surname) ?></td>
                <td><?= h($patient->sex) ?></td>
                <td><?= h($patient->birthdate) ?></td>
                <td><?= h($patient->type_of_identification) ?></td>
                <td><?= h($patient->identidy_card) ?></td>
                <td><?= h($patient->profession) ?></td>
                <td><?= h($patient->item) ?></td>
                <td><?= h($patient->item_not_specified) ?></td>
                <td><?= h($patient->work_phone) ?></td>
                <td><?= h($patient->workplace) ?></td>
                <td><?= h($patient->professional_position) ?></td>
                <td><?= h($patient->work_address) ?></td>
                <td><?= h($patient->cell_phone) ?></td>
                <td><?= h($patient->landline) ?></td>
                <td><?= h($patient->email) ?></td>
                <td><?= h($patient->address) ?></td>
                <td><?= h($patient->bank) ?></td>
                <td><?= h($patient->bank_address) ?></td>
                <td><?= h($patient->swift_bank) ?></td>
                <td><?= h($patient->aba_bank) ?></td>
                <td><?= h($patient->first_name_emergency) ?></td>
                <td><?= h($patient->second_name_emergency) ?></td>
                <td><?= h($patient->surname_emergency) ?></td>
                <td><?= h($patient->second_surname_emergency) ?></td>
                <td><?= h($patient->type_of_identification_emergency) ?></td>
                <td><?= h($patient->identidy_card_emergency) ?></td>
                <td><?= h($patient->address_emergency) ?></td>
                <td><?= h($patient->email_emergency) ?></td>
                <td><?= h($patient->landline_emergency) ?></td>
                <td><?= h($patient->cell_phone_emergency) ?></td>
                <td><?= h($patient->first_name_companion) ?></td>
                <td><?= h($patient->second_name_companion) ?></td>
                <td><?= h($patient->surname_companion) ?></td>
                <td><?= h($patient->second_surname_companion) ?></td>
                <td><?= h($patient->type_of_identification_companion) ?></td>
                <td><?= h($patient->identidy_card_companion) ?></td>
                <td><?= h($patient->address_companion) ?></td>
                <td><?= h($patient->email_companion) ?></td>
                <td><?= h($patient->landline_companion) ?></td>
                <td><?= h($patient->cell_phone_companion) ?></td>
                <td><?= h($patient->payment_own_resources) ?></td>
                <td><?= h($patient->sponsor) ?></td>
                <td><?= h($patient->sponsor_type) ?></td>
                <td><?= h($patient->sponsor_identification) ?></td>
                <td><?= h($patient->address_sponsor) ?></td>
                <td><?= h($patient->email_sponsor) ?></td>
                <td><?= h($patient->landline_sponsor) ?></td>
                <td><?= h($patient->cell_phone_sponsor) ?></td>
                <td><?= h($patient->status_diary_patient) ?></td>
                <td><?= h($patient->status_history_patient) ?></td>
                <td><?= h($patient->responsible_user) ?></td>
                <td><?= h($patient->record_delete) ?></td>
                <td><?= h($patient->created) ?></td>
                <td><?= h($patient->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $patient->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patient->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?>
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
