<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Itemes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemes form large-9 medium-8 columns content">
    <?= $this->Form->create($iteme) ?>
    <fieldset>
        <legend><?= __('Add Iteme') ?></legend>
        <?php
            echo $this->Form->input('budget_id', ['options' => $budgets]);
            echo $this->Form->input('itemes');
            echo $this->Form->input('registration_status');
            echo $this->Form->input('reason_status');
            echo $this->Form->input('date_status', ['empty' => true]);
            echo $this->Form->input('responsible_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
