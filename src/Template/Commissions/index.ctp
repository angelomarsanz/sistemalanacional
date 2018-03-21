<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Commission'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Budgets'), ['controller' => 'Budgets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Budget'), ['controller' => 'Budgets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commissions index large-9 medium-8 columns content">
    <h3><?= __('Commissions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('budget_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_beneficiary') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pay_day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_dir') ?></th>
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
            <?php foreach ($commissions as $commission): ?>
            <tr>
                <td><?= $this->Number->format($commission->id) ?></td>
                <td><?= $commission->has('user') ? $this->Html->link($commission->user->full_name, ['controller' => 'Users', 'action' => 'view', $commission->user->id]) : '' ?></td>
                <td><?= $commission->has('budget') ? $this->Html->link($commission->budget->id, ['controller' => 'Budgets', 'action' => 'view', $commission->budget->id]) : '' ?></td>
                <td><?= h($commission->type_beneficiary) ?></td>
                <td><?= $this->Number->format($commission->amount) ?></td>
                <td><?= h($commission->payment_method) ?></td>
                <td><?= h($commission->bank) ?></td>
                <td><?= h($commission->account) ?></td>
                <td><?= h($commission->reference) ?></td>
                <td><?= h($commission->pay_day) ?></td>
                <td><?= h($commission->voucher) ?></td>
                <td><?= h($commission->voucher_dir) ?></td>
                <td><?= h($commission->extra_column1) ?></td>
                <td><?= h($commission->extra_column2) ?></td>
                <td><?= h($commission->extra_column3) ?></td>
                <td><?= h($commission->extra_column4) ?></td>
                <td><?= h($commission->extra_column5) ?></td>
                <td><?= h($commission->extra_column6) ?></td>
                <td><?= h($commission->extra_column7) ?></td>
                <td><?= h($commission->extra_column8) ?></td>
                <td><?= h($commission->extra_column9) ?></td>
                <td><?= h($commission->extra_column10) ?></td>
                <td><?= h($commission->registration_status) ?></td>
                <td><?= h($commission->reason_status) ?></td>
                <td><?= h($commission->date_status) ?></td>
                <td><?= h($commission->responsible_user) ?></td>
                <td><?= h($commission->created) ?></td>
                <td><?= h($commission->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $commission->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commission->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commission->id)]) ?>
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