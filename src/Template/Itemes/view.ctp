<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Iteme'), ['action' => 'edit', $iteme->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Iteme'), ['action' => 'delete', $iteme->id], ['confirm' => __('Are you sure you want to delete # {0}?', $iteme->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Itemes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Iteme'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemes view large-9 medium-8 columns content">
    <h3><?= h($iteme->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Budget') ?></th>
            <td><?= $iteme->has('budget') ? $this->Html->link($iteme->budget->id, ['controller' => 'Budgets', 'action' => 'view', $iteme->budget->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Status') ?></th>
            <td><?= h($iteme->registration_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Status') ?></th>
            <td><?= h($iteme->reason_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($iteme->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($iteme->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Status') ?></th>
            <td><?= h($iteme->date_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($iteme->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($iteme->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Itemes') ?></h4>
        <?= $this->Text->autoParagraph(h($iteme->itemes)); ?>
    </div>
</div>
