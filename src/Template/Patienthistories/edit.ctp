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
                ['action' => 'delete', $patienthistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $patienthistory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Patienthistories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="patienthistories form large-9 medium-8 columns content">
    <?= $this->Form->create($patienthistory) ?>
    <fieldset>
        <legend><?= __('Edit Patienthistory') ?></legend>
        <?php
            echo $this->Form->input('budget_id', ['options' => $budgets]);
            echo $this->Form->input('activity_date', ['empty' => true]);
            echo $this->Form->input('short_description_activity');
            echo $this->Form->input('detailed_activity_description');
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
