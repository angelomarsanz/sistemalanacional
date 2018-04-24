<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parameters index large-9 medium-8 columns content">
    <h3><?= __('Parameters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ambient') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dollar_promoter_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dollar_father_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dollar_grandfather_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bolivar_promoter_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bolivar_father_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bolivar_grandfather_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column9') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column10') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column11') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column12') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column13') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column14') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column15') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column16') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column17') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column18') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column19') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extra_column20') ?></th>
                <th scope="col"><?= $this->Paginator->sort('registration_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsible_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parameters as $parameter): ?>
            <tr>
                <td><?= $this->Number->format($parameter->id) ?></td>
                <td><?= h($parameter->ambient) ?></td>
                <td><?= $this->Number->format($parameter->dollar_promoter_percentage) ?></td>
                <td><?= $this->Number->format($parameter->dollar_father_percentage) ?></td>
                <td><?= $this->Number->format($parameter->dollar_grandfather_percentage) ?></td>
                <td><?= $this->Number->format($parameter->bolivar_promoter_percentage) ?></td>
                <td><?= $this->Number->format($parameter->bolivar_father_percentage) ?></td>
                <td><?= $this->Number->format($parameter->bolivar_grandfather_percentage) ?></td>
                <td><?= h($parameter->extra_column1) ?></td>
                <td><?= h($parameter->extra_column2) ?></td>
                <td><?= h($parameter->extra_column3) ?></td>
                <td><?= h($parameter->extra_column4) ?></td>
                <td><?= h($parameter->extra_column5) ?></td>
                <td><?= h($parameter->extra_column6) ?></td>
                <td><?= h($parameter->extra_column7) ?></td>
                <td><?= h($parameter->extra_column8) ?></td>
                <td><?= h($parameter->extra_column9) ?></td>
                <td><?= h($parameter->extra_column10) ?></td>
                <td><?= h($parameter->extra_column11) ?></td>
                <td><?= h($parameter->extra_column12) ?></td>
                <td><?= h($parameter->extra_column13) ?></td>
                <td><?= h($parameter->extra_column14) ?></td>
                <td><?= h($parameter->extra_column15) ?></td>
                <td><?= h($parameter->extra_column16) ?></td>
                <td><?= h($parameter->extra_column17) ?></td>
                <td><?= h($parameter->extra_column18) ?></td>
                <td><?= h($parameter->extra_column19) ?></td>
                <td><?= h($parameter->extra_column20) ?></td>
                <td><?= h($parameter->registration_status) ?></td>
                <td><?= h($parameter->reason_status) ?></td>
                <td><?= h($parameter->date_status) ?></td>
                <td><?= h($parameter->responsible_user) ?></td>
                <td><?= h($parameter->created) ?></td>
                <td><?= h($parameter->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $parameter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $parameter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
