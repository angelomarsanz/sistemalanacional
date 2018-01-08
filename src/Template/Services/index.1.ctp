<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Service'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hiredservices'), ['controller' => 'Hiredservices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hiredservice'), ['controller' => 'Hiredservices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="services index large-9 medium-8 columns content">
    <h3><?= __('Services') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('service_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('service_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('full_service_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost_bolivars') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost_dollars') ?></th>
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
            <?php foreach ($services as $service): ?>
            <tr>
                <td><?= $this->Number->format($service->id) ?></td>
                <td><?= h($service->service_code) ?></td>
                <td><?= h($service->service_description) ?></td>
                <td><?= h($service->full_service_description) ?></td>
                <td><?= $this->Number->format($service->cost_bolivars) ?></td>
                <td><?= $this->Number->format($service->cost_dollars) ?></td>
                <td><?= h($service->registration_status) ?></td>
                <td><?= h($service->reason_status) ?></td>
                <td><?= h($service->date_status) ?></td>
                <td><?= h($service->responsible_user) ?></td>
                <td><?= h($service->created) ?></td>
                <td><?= $this->Number->format($service->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $service->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $service->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?>
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
