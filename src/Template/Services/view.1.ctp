<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hiredservices'), ['controller' => 'Hiredservices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hiredservice'), ['controller' => 'Hiredservices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="services view large-9 medium-8 columns content">
    <h3><?= h($service->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Service Code') ?></th>
            <td><?= h($service->service_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Service Description') ?></th>
            <td><?= h($service->service_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Service Description') ?></th>
            <td><?= h($service->full_service_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Status') ?></th>
            <td><?= h($service->registration_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason Status') ?></th>
            <td><?= h($service->reason_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible User') ?></th>
            <td><?= h($service->responsible_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($service->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost Bolivars') ?></th>
            <td><?= $this->Number->format($service->cost_bolivars) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost Dollars') ?></th>
            <td><?= $this->Number->format($service->cost_dollars) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $this->Number->format($service->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Status') ?></th>
            <td><?= h($service->date_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($service->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Hiredservices') ?></h4>
        <?php if (!empty($service->hiredservices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Servicescontract Id') ?></th>
                <th scope="col"><?= __('Service Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Coin') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Responsible User') ?></th>
                <th scope="col"><?= __('Record Delete') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($service->hiredservices as $hiredservices): ?>
            <tr>
                <td><?= h($hiredservices->id) ?></td>
                <td><?= h($hiredservices->servicescontract_id) ?></td>
                <td><?= h($hiredservices->service_id) ?></td>
                <td><?= h($hiredservices->quantity) ?></td>
                <td><?= h($hiredservices->coin) ?></td>
                <td><?= h($hiredservices->amount) ?></td>
                <td><?= h($hiredservices->responsible_user) ?></td>
                <td><?= h($hiredservices->record_delete) ?></td>
                <td><?= h($hiredservices->created) ?></td>
                <td><?= h($hiredservices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Hiredservices', 'action' => 'view', $hiredservices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Hiredservices', 'action' => 'edit', $hiredservices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Hiredservices', 'action' => 'delete', $hiredservices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hiredservices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
