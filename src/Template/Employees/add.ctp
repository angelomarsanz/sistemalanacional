<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Positions'), ['controller' => 'Positions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Position'), ['controller' => 'Positions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Add Employee') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('code_for_user');
            echo $this->Form->input('first_name');
            echo $this->Form->input('second_name');
            echo $this->Form->input('surname');
            echo $this->Form->input('second_surname');
            echo $this->Form->input('sex');
            echo $this->Form->input('nationality');
            echo $this->Form->input('type_of_identification');
            echo $this->Form->input('identity_card');
            echo $this->Form->input('rif');
            echo $this->Form->input('profile_photo');
            echo $this->Form->input('profile_photo_dir');
            echo $this->Form->input('place_of_birth');
            echo $this->Form->input('country_of_birth');
            echo $this->Form->input('birthdate');
            echo $this->Form->input('cell_phone');
            echo $this->Form->input('landline');
            echo $this->Form->input('email');
            echo $this->Form->input('address');
            echo $this->Form->input('degree_instruction');
            echo $this->Form->input('date_of_admission');
            echo $this->Form->input('retirement_date', ['empty' => true]);
            echo $this->Form->input('reason_withdrawal');
            echo $this->Form->input('classification');
            echo $this->Form->input('position_id', ['options' => $positions]);
            echo $this->Form->input('working_agreement');
            echo $this->Form->input('hours_month');
            echo $this->Form->input('percentage_imposed');
            echo $this->Form->input('record_deleted');
            echo $this->Form->input('responsible_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
