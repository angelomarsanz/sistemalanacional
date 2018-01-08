<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Patient'), ['action' => 'edit', $patient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Patient'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Patients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patient'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Supervisors'), ['controller' => 'Supervisors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supervisor'), ['controller' => 'Supervisors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Promoters'), ['controller' => 'Promoters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promoter'), ['controller' => 'Promoters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Diarypatients'), ['controller' => 'Diarypatients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Diarypatient'), ['controller' => 'Diarypatients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historypatients'), ['controller' => 'Historypatients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historypatient'), ['controller' => 'Historypatients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Servicescontracts'), ['controller' => 'Servicescontracts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Servicescontract'), ['controller' => 'Servicescontracts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="patients view large-9 medium-8 columns content">
    <h3><?= h($patient->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $patient->has('user') ? $this->Html->link($patient->user->id, ['controller' => 'Users', 'action' => 'view', $patient->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supervisor') ?></th>
            <td><?= $patient->has('supervisor') ? $this->Html->link($patient->supervisor->id, ['controller' => 'Supervisors', 'action' => 'view', $patient->supervisor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Promoter') ?></th>
            <td><?= $patient->has('promoter') ? $this->Html->link($patient->promoter->id, ['controller' => 'Promoters', 'action' => 'view', $patient->promoter->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $patient->has('vendor') ? $this->Html->link($patient->vendor->id, ['controller' => 'Vendors', 'action' => 'view', $patient->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Another Half Capture') ?></th>
            <td><?= h($patient->another_half_capture) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($patient->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Name') ?></th>
            <td><?= h($patient->second_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($patient->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Surname') ?></th>
            <td><?= h($patient->second_surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sex') ?></th>
            <td><?= h($patient->sex) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Identification') ?></th>
            <td><?= h($patient->type_of_identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identidy Card') ?></th>
            <td><?= h($patient->identidy_card) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profession') ?></th>
            <td><?= h($patient->profession) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= h($patient->item) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Not Specified') ?></th>
            <td><?= h($patient->item_not_specified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Phone') ?></th>
            <td><?= h($patient->work_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Workplace') ?></th>
            <td><?= h($patient->workplace) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Professional Position') ?></th>
            <td><?= h($patient->professional_position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Address') ?></th>
            <td><?= h($patient->work_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone') ?></th>
            <td><?= h($patient->cell_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline') ?></th>
            <td><?= h($patient->landline) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($patient->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($patient->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank') ?></th>
            <td><?= h($patient->bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Address') ?></th>
            <td><?= h($patient->bank_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Swift Bank') ?></th>
            <td><?= h($patient->swift_bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aba Bank') ?></th>
            <td><?= h($patient->aba_bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name Emergency') ?></th>
            <td><?= h($patient->first_name_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Name Emergency') ?></th>
            <td><?= h($patient->second_name_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname Emergency') ?></th>
            <td><?= h($patient->surname_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Surname Emergency') ?></th>
            <td><?= h($patient->second_surname_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Identification Emergency') ?></th>
            <td><?= h($patient->type_of_identification_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identidy Card Emergency') ?></th>
            <td><?= h($patient->identidy_card_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address Emergency') ?></th>
            <td><?= h($patient->address_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Emergency') ?></th>
            <td><?= h($patient->email_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline Emergency') ?></th>
            <td><?= h($patient->landline_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone Emergency') ?></th>
            <td><?= h($patient->cell_phone_emergency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name Companion') ?></th>
            <td><?= h($patient->first_name_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Name Companion') ?></th>
            <td><?= h($patient->second_name_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname Companion') ?></th>
            <td><?= h($patient->surname_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Surname Companion') ?></th>
            <td><?= h($patient->second_surname_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Of Identification Companion') ?></th>
            <td><?= h($patient->type_of_identification_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identidy Card Companion') ?></th>
            <td><?= h($patient->identidy_card_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address Companion') ?></th>
            <td><?= h($patient->address_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Companion') ?></th>
            <td><?= h($patient->email_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline Companion') ?></th>
            <td><?= h($patient->landline_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone Companion') ?></th>
            <td><?= h($patient->cell_phone_companion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sponsor') ?></th>
            <td><?= h($patient->sponsor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sponsor Type') ?></th>
            <td><?= h($patient->sponsor_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sponsor Identification') ?></th>
            <td><?= h($patient->sponsor_identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address Sponsor') ?></th>
            <td><?= h($patient->address_sponsor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Sponsor') ?></th>
            <td><?= h($patient->email_sponsor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landline Sponsor') ?></th>
            <td><?= h($patient->landline_sponsor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cell Phone Sponsor') ?></th>
            <td><?= h($patient->cell_phone_sponsor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status Diary Patient') ?></th>
            <td><?= h($patient->status_diary_patient) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status History Patient') ?></th>
            <td><?= h($patient->status_history_patient) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($patient->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($patient->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthdate') ?></th>
            <td><?= h($patient->birthdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($patient->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($patient->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Own Resources') ?></th>
            <td><?= $patient->payment_own_resources ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Delete') ?></th>
            <td><?= $patient->record_delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Diarypatients') ?></h4>
        <?php if (!empty($patient->diarypatients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Patient Id') ?></th>
                <th scope="col"><?= __('Event Date') ?></th>
                <th scope="col"><?= __('Short Description Event') ?></th>
                <th scope="col"><?= __('Detailed Event Description') ?></th>
                <th scope="col"><?= __('Observations') ?></th>
                <th scope="col"><?= __('Responsible User') ?></th>
                <th scope="col"><?= __('Deleted Record') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($patient->diarypatients as $diarypatients): ?>
            <tr>
                <td><?= h($diarypatients->id) ?></td>
                <td><?= h($diarypatients->patient_id) ?></td>
                <td><?= h($diarypatients->event_date) ?></td>
                <td><?= h($diarypatients->short_description_event) ?></td>
                <td><?= h($diarypatients->detailed_event_description) ?></td>
                <td><?= h($diarypatients->observations) ?></td>
                <td><?= h($diarypatients->responsible_user) ?></td>
                <td><?= h($diarypatients->deleted_record) ?></td>
                <td><?= h($diarypatients->created) ?></td>
                <td><?= h($diarypatients->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Diarypatients', 'action' => 'view', $diarypatients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Diarypatients', 'action' => 'edit', $diarypatients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Diarypatients', 'action' => 'delete', $diarypatients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diarypatients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Historypatients') ?></h4>
        <?php if (!empty($patient->historypatients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Patient Id') ?></th>
                <th scope="col"><?= __('Event Date') ?></th>
                <th scope="col"><?= __('Short Description Event') ?></th>
                <th scope="col"><?= __('Detailed Description Event') ?></th>
                <th scope="col"><?= __('Indications') ?></th>
                <th scope="col"><?= __('Medical Recipe') ?></th>
                <th scope="col"><?= __('Observations') ?></th>
                <th scope="col"><?= __('Responsible User') ?></th>
                <th scope="col"><?= __('Deleted Record') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($patient->historypatients as $historypatients): ?>
            <tr>
                <td><?= h($historypatients->id) ?></td>
                <td><?= h($historypatients->patient_id) ?></td>
                <td><?= h($historypatients->event_date) ?></td>
                <td><?= h($historypatients->short_description_event) ?></td>
                <td><?= h($historypatients->detailed_description_event) ?></td>
                <td><?= h($historypatients->indications) ?></td>
                <td><?= h($historypatients->medical_recipe) ?></td>
                <td><?= h($historypatients->observations) ?></td>
                <td><?= h($historypatients->responsible_user) ?></td>
                <td><?= h($historypatients->deleted_record) ?></td>
                <td><?= h($historypatients->created) ?></td>
                <td><?= h($historypatients->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Historypatients', 'action' => 'view', $historypatients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Historypatients', 'action' => 'edit', $historypatients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Historypatients', 'action' => 'delete', $historypatients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historypatients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Servicescontracts') ?></h4>
        <?php if (!empty($patient->servicescontracts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Patient Id') ?></th>
                <th scope="col"><?= __('Contract Code') ?></th>
                <th scope="col"><?= __('Coin') ?></th>
                <th scope="col"><?= __('Contracted Amount') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Surcharge') ?></th>
                <th scope="col"><?= __('For Installments') ?></th>
                <th scope="col"><?= __('Amount Fees') ?></th>
                <th scope="col"><?= __('Service Balance') ?></th>
                <th scope="col"><?= __('Supervisor Commission Percentage') ?></th>
                <th scope="col"><?= __('Supervisor Commission Balance') ?></th>
                <th scope="col"><?= __('Promoter Commission Percentage') ?></th>
                <th scope="col"><?= __('Promoter Commission Balance') ?></th>
                <th scope="col"><?= __('Vendor Commission Percentage') ?></th>
                <th scope="col"><?= __('Vendor Commission Balance') ?></th>
                <th scope="col"><?= __('Responsible User') ?></th>
                <th scope="col"><?= __('Deleted Record') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($patient->servicescontracts as $servicescontracts): ?>
            <tr>
                <td><?= h($servicescontracts->id) ?></td>
                <td><?= h($servicescontracts->patient_id) ?></td>
                <td><?= h($servicescontracts->contract_code) ?></td>
                <td><?= h($servicescontracts->coin) ?></td>
                <td><?= h($servicescontracts->contracted_amount) ?></td>
                <td><?= h($servicescontracts->discount) ?></td>
                <td><?= h($servicescontracts->surcharge) ?></td>
                <td><?= h($servicescontracts->for_installments) ?></td>
                <td><?= h($servicescontracts->amount_fees) ?></td>
                <td><?= h($servicescontracts->service_balance) ?></td>
                <td><?= h($servicescontracts->supervisor_commission_percentage) ?></td>
                <td><?= h($servicescontracts->supervisor_commission_balance) ?></td>
                <td><?= h($servicescontracts->promoter_commission_percentage) ?></td>
                <td><?= h($servicescontracts->promoter_commission_balance) ?></td>
                <td><?= h($servicescontracts->vendor_commission_percentage) ?></td>
                <td><?= h($servicescontracts->vendor_commission_balance) ?></td>
                <td><?= h($servicescontracts->responsible_user) ?></td>
                <td><?= h($servicescontracts->deleted_record) ?></td>
                <td><?= h($servicescontracts->created) ?></td>
                <td><?= h($servicescontracts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Servicescontracts', 'action' => 'view', $servicescontracts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Servicescontracts', 'action' => 'edit', $servicescontracts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Servicescontracts', 'action' => 'delete', $servicescontracts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicescontracts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
