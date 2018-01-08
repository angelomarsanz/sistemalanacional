<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Multilevel'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="multilevels index large-9 medium-8 columns content">
    <h3><?= __('Multilevels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('father') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sex') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_of_identification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identidy_card') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profession') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cell_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('landline') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province_state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deactivation_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('swift_bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aba_bank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsible_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_record') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($multilevels as $multilevel): ?>
            <tr>
                <td><?= $this->Number->format($multilevel->id) ?></td>
                <td><?= $multilevel->has('user') ? $this->Html->link($multilevel->user->username, ['controller' => 'Users', 'action' => 'view', $multilevel->user->id]) : '' ?></td>
                <td><?= h($multilevel->father) ?></td>
                <td><?= h($multilevel->first_name) ?></td>
                <td><?= h($multilevel->second_name) ?></td>
                <td><?= h($multilevel->surname) ?></td>
                <td><?= h($multilevel->second_surname) ?></td>
                <td><?= h($multilevel->sex) ?></td>
                <td><?= h($multilevel->birthdate) ?></td>
                <td><?= h($multilevel->type_of_identification) ?></td>
                <td><?= h($multilevel->identidy_card) ?></td>
                <td><?= h($multilevel->profession) ?></td>
                <td><?= h($multilevel->cell_phone) ?></td>
                <td><?= h($multilevel->landline) ?></td>
                <td><?= h($multilevel->email) ?></td>
                <td><?= h($multilevel->country) ?></td>
                <td><?= h($multilevel->province_state) ?></td>
                <td><?= h($multilevel->city) ?></td>
                <td><?= h($multilevel->address) ?></td>
                <td><?= h($multilevel->active) ?></td>
                <td><?= h($multilevel->deactivation_date) ?></td>
                <td><?= h($multilevel->account_number) ?></td>
                <td><?= h($multilevel->bank) ?></td>
                <td><?= h($multilevel->bank_address) ?></td>
                <td><?= h($multilevel->swift_bank) ?></td>
                <td><?= h($multilevel->aba_bank) ?></td>
                <td><?= h($multilevel->responsible_user) ?></td>
                <td><?= h($multilevel->delete_record) ?></td>
                <td><?= h($multilevel->created) ?></td>
                <td><?= h($multilevel->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $multilevel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $multilevel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $multilevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multilevel->id)]) ?>
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
