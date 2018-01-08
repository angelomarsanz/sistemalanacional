<?php
    use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
     	    <h2>Listado de pacientes</h2>
            <p><?= $this->Html->link(__('Agregar nuevo paciente'), ['controller' => 'Patients', 'action' => 'addBasic'], ['class' => 'btn btn-sm btn-default']) ?></p>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('full_name', ['Nombre']) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('patologia', ['Patología']) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status_diary_patient', ['Estatus del cliente']) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('event_date', ['Desde el']) ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= h($patient->full_name) ?></td>
                        <td><?= h($patient->patologia) ?></td>
                        <td><?= h($patient->status_diary_patient) ?></td>
                        <td><?= h($patient->date_status_diary->i18nFormat('dd-MM-yyyy, HH:mm')) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('Ver', ['action' => 'viewBasic', $patient->id, 'indexBasic'], ['class' => 'btn btn-sm btn-info']) ?>
                            <?= $this->Html->link(__('Completar datos'), ['action' => 'completedData', $patient->id], ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= $this->Html->link(__('Agenda'), ['controller' => 'Diarypatients', 'action' => 'index', $patient->id], ['class' => 'btn btn-sm btn-primary']) ?>
<!--
                            <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $patient->id], ['confirm' => __('Está seguro de que desea eliminar el paciente?'), 'class' => 'btn btn-sm btn-danger']) ?>
-->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>