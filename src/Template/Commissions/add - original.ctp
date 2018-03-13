<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Commissions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="commissions form large-9 medium-8 columns content">
    <?= $this->Form->create($commission) ?>
    <fieldset>
        <legend><?= __('Add Commission') ?></legend>
        <?php
            echo $this->Form->input('user_id');
            echo $this->Form->input('budget_id');
            echo $this->Form->input('type_beneficiary');
            echo $this->Form->input('amount');
            echo $this->Form->input('coin');
            echo $this->Form->input('payment_method');
            echo $this->Form->input('bank');
            echo $this->Form->input('account');
            echo $this->Form->input('reference');
            echo $this->Form->input('pay_day', ['empty' => true]);
            echo $this->Form->input('voucher');
            echo $this->Form->input('voucher_dir');
            echo $this->Form->input('extra_column1');
            echo $this->Form->input('extra_column2');
            echo $this->Form->input('extra_column3');
            echo $this->Form->input('extra_column4');
            echo $this->Form->input('extra_column5');
            echo $this->Form->input('extra_column6');
            echo $this->Form->input('extra_column7');
            echo $this->Form->input('extra_column8');
            echo $this->Form->input('extra_column9');
            echo $this->Form->input('extra_column10');
            echo $this->Form->input('registration_status');
            echo $this->Form->input('reason_status');
            echo $this->Form->input('date_status', ['empty' => true]);
            echo $this->Form->input('responsible_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
