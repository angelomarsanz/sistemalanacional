<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="parameters form large-9 medium-8 columns content">
    <?= $this->Form->create($parameter) ?>
    <fieldset>
        <legend><?= __('Add Parameter') ?></legend>
        <?php
            echo $this->Form->input('ambient');
            echo $this->Form->input('dollar_promoter_percentage');
            echo $this->Form->input('dollar_father_percentage');
            echo $this->Form->input('dollar_grandfather_percentage');
            echo $this->Form->input('bolivar_promoter_percentage');
            echo $this->Form->input('bolivar_father_percentage');
            echo $this->Form->input('bolivar_grandfather_percentage');
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
            echo $this->Form->input('extra_column11');
            echo $this->Form->input('extra_column12');
            echo $this->Form->input('extra_column13');
            echo $this->Form->input('extra_column14');
            echo $this->Form->input('extra_column15');
            echo $this->Form->input('extra_column16');
            echo $this->Form->input('extra_column17');
            echo $this->Form->input('extra_column18');
            echo $this->Form->input('extra_column19');
            echo $this->Form->input('extra_column20');
            echo $this->Form->input('registration_status');
            echo $this->Form->input('reason_status');
            echo $this->Form->input('date_status', ['empty' => true]);
            echo $this->Form->input('responsible_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
