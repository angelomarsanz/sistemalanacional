<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Commission'), ['action' => 'edit', $commission->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Commission'), ['action' => 'delete', $commission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commission->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Commissions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commission'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commissions view large-9 medium-8 columns content">
    <h3><?= h($commission->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type Beneficiary') ?></th>
            <td><?= h($commission->type_beneficiary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coin') ?></th>
            <td><?= h($commission->coin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Method') ?></th>
            <td><?= h($commission->payment_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank') ?></th>
            <td><?= h($commission->bank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account') ?></th>
            <td><?= h($commission->account) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= h($commission->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher') ?></th>
            <td><?= h($commission->voucher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher Dir') ?></th>
            <td><?= h($commission->voucher_dir) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column1') ?></th>
            <td><?= h($commission->extra_column1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column2') ?></th>
            <td><?= h($commission->extra_column2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column3') ?></th>
            <td><?= h($commission->extra_column3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column4') ?></th>
            <td><?= h($commission->extra_column4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column5') ?></th>
            <td><?= h($commission->extra_column5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column6') ?></th>
            <td><?= h($commission->extra_column6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column7') ?></th>
            <td><?= h($commission->extra_column7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column8') ?></th>
            <td><?= h($commission->extra_column8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column9') ?></th>
            <td><?= h($commission->extra_column9) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column10') ?></th>
            <td><?= h($commission->extra_column10) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Status') ?></th>
            <td><?= h($commission->registration_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Status') ?></th>
            <td><?= h($commission->reason_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($commission->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($commission->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($commission->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Budget Id') ?></th>
            <td><?= $this->Number->format($commission->budget_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($commission->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pay Day') ?></th>
            <td><?= h($commission->pay_day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Status') ?></th>
            <td><?= h($commission->date_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($commission->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($commission->modified) ?></td>
        </tr>
    </table>
</div>
