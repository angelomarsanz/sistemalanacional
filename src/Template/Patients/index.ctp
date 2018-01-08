<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
     	    <h2>Listado de pacientes</h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('full_name', ['Nombre']) ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= h($patient->full_name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('Ver', ['action' => 'view', $patient->id], ['class' => 'btn btn-sm btn-info']) ?>
                            <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $patient->id], ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $patient->id], ['confirm' => __('Está seguro de que desea eliminar el paciente?'), 'class' => 'btn btn-sm btn-danger']) ?>
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