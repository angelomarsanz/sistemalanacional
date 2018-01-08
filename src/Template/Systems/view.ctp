<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit System'), ['action' => 'edit', $system->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete System'), ['action' => 'delete', $system->id], ['confirm' => __('Are you sure you want to delete # {0}?', $system->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Systems'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New System'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="systems view large-9 medium-8 columns content">
    <h3><?= h($system->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Clinical Name') ?></th>
            <td><?= h($system->clinical_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identification') ?></th>
            <td><?= h($system->identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fiscal Address') ?></th>
            <td><?= h($system->fiscal_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Phone') ?></th>
            <td><?= h($system->tax_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('System Switch') ?></th>
            <td><?= $system->system_switch ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
