<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $budget->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $budget->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Patients'), ['controller' => 'Patients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Patient'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Diarypatients'), ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Diarypatient'), ['controller' => 'Diarypatients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Patienthistories'), ['controller' => 'Patienthistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Patienthistory'), ['controller' => 'Patienthistories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="budgets form large-9 medium-8 columns content">
    <?= $this->Form->create($budget) ?>
    <fieldset>
        <legend><?= __('Edit Budget') ?></legend>
        <?php
            echo $this->Form->input('patient_id', ['options' => $patients]);
            echo $this->Form->input('application date');
            echo $this->Form->input('surgery');
            echo $this->Form->input('activity_date_finish', ['empty' => true]);
            echo $this->Form->input('activity_result');
            echo $this->Form->input('detailed_result_activity');
            echo $this->Form->input('responsible_user');
            echo $this->Form->input('deleted_record');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
