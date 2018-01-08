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
                ['action' => 'delete', $system->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $system->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Systems'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="systems form large-9 medium-8 columns content">
    <?= $this->Form->create($system) ?>
    <fieldset>
        <legend><?= __('Edit System') ?></legend>
        <?php
            echo $this->Form->input('clinical_name');
            echo $this->Form->input('identification');
            echo $this->Form->input('fiscal_address');
            echo $this->Form->input('tax_phone');
            echo $this->Form->input('logo');
            echo $this->Form->input('system_switch');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
