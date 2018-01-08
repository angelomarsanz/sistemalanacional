<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Multilevels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="multilevels form large-9 medium-8 columns content">
    <?= $this->Form->create($multilevel) ?>
    <fieldset>
        <legend><?= __('Add Multilevel') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('father');
            echo $this->Form->input('first_name');
            echo $this->Form->input('second_name');
            echo $this->Form->input('surname');
            echo $this->Form->input('second_surname');
            echo $this->Form->input('sex');
            echo $this->Form->input('birthdate');
            echo $this->Form->input('type_of_identification');
            echo $this->Form->input('identidy_card');
            echo $this->Form->input('profession');
            echo $this->Form->input('cell_phone');
            echo $this->Form->input('landline');
            echo $this->Form->input('email');
            echo $this->Form->input('country');
            echo $this->Form->input('province_state');
            echo $this->Form->input('city');
            echo $this->Form->input('address');
            echo $this->Form->input('active');
            echo $this->Form->input('deactivation_date', ['empty' => true]);
            echo $this->Form->input('account_number');
            echo $this->Form->input('bank');
            echo $this->Form->input('bank_address');
            echo $this->Form->input('swift_bank');
            echo $this->Form->input('aba_bank');
            echo $this->Form->input('responsible_user');
            echo $this->Form->input('delete_record');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
