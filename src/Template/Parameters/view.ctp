<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parameters view large-9 medium-8 columns content">
    <h3><?= h($parameter->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ambient') ?></th>
            <td><?= h($parameter->ambient) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column1') ?></th>
            <td><?= h($parameter->extra_column1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column2') ?></th>
            <td><?= h($parameter->extra_column2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column3') ?></th>
            <td><?= h($parameter->extra_column3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column4') ?></th>
            <td><?= h($parameter->extra_column4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column5') ?></th>
            <td><?= h($parameter->extra_column5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column6') ?></th>
            <td><?= h($parameter->extra_column6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column7') ?></th>
            <td><?= h($parameter->extra_column7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column8') ?></th>
            <td><?= h($parameter->extra_column8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column9') ?></th>
            <td><?= h($parameter->extra_column9) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column10') ?></th>
            <td><?= h($parameter->extra_column10) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column11') ?></th>
            <td><?= h($parameter->extra_column11) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column12') ?></th>
            <td><?= h($parameter->extra_column12) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column13') ?></th>
            <td><?= h($parameter->extra_column13) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column14') ?></th>
            <td><?= h($parameter->extra_column14) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column15') ?></th>
            <td><?= h($parameter->extra_column15) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column16') ?></th>
            <td><?= h($parameter->extra_column16) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column17') ?></th>
            <td><?= h($parameter->extra_column17) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column18') ?></th>
            <td><?= h($parameter->extra_column18) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column19') ?></th>
            <td><?= h($parameter->extra_column19) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extra Column20') ?></th>
            <td><?= h($parameter->extra_column20) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Status') ?></th>
            <td><?= h($parameter->registration_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Status') ?></th>
            <td><?= h($parameter->reason_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($parameter->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($parameter->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dollar Promoter Percentage') ?></th>
            <td><?= $this->Number->format($parameter->dollar_promoter_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dollar Father Percentage') ?></th>
            <td><?= $this->Number->format($parameter->dollar_father_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dollar Grandfather Percentage') ?></th>
            <td><?= $this->Number->format($parameter->dollar_grandfather_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bolivar Promoter Percentage') ?></th>
            <td><?= $this->Number->format($parameter->bolivar_promoter_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bolivar Father Percentage') ?></th>
            <td><?= $this->Number->format($parameter->bolivar_father_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bolivar Grandfather Percentage') ?></th>
            <td><?= $this->Number->format($parameter->bolivar_grandfather_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Status') ?></th>
            <td><?= h($parameter->date_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($parameter->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($parameter->modified) ?></td>
        </tr>
    </table>
</div>
