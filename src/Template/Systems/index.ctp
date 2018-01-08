<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New System'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="systems index large-9 medium-8 columns content">
    <h3><?= __('Systems') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('clinical_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('system_switch') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($systems as $system): ?>
            <tr>
                <td><?= $this->Number->format($system->id) ?></td>
                <td><?= h($system->clinical_name) ?></td>
                <td><?= h($system->identification) ?></td>
                <td><?= h($system->fiscal_address) ?></td>
                <td><?= h($system->tax_phone) ?></td>
                <td><?= h($system->logo) ?></td>
                <td><?= h($system->system_switch) ?></td>
                <td><?= h($system->created) ?></td>
                <td><?= h($system->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $system->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $system->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $system->id], ['confirm' => __('Are you sure you want to delete # {0}?', $system->id)]) ?>
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
