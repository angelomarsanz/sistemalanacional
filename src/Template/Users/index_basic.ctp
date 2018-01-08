<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    	    <p><?= $this->Html->link(__('Nuevo paciente'), ['controller' => 'Users', 'action' => 'addBasic', 'indexBasic'], ['class' => 'btn btn-sm btn-default']) ?></p>
     	    <h2>Listado general de pacientes</h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('full_name', ['Nombre del paciente']) ?></th>
                        <th scope="col"><?= $this->Paginator->sort('username', ['Usuario']) ?></th>
                        <th scope="col" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= h($user->full_name) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('Ver', ['action' => 'viewBasic', $user->id, 'Users', 'indexBasic'], ['class' => 'btn btn-sm btn-info']) ?>
                            <?= $this->Html->link(__('Completar datos'), ['controller' => 'Users', 'action' => 'editBasic', $user->id, 'indexBasic'], ['class' => 'btn btn-sm btn-primary']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['action' => 'deleteBasic', $user->id, 'indexBasic' ], ['confirm' => __('Está seguro de que desea eliminar el paciente?'), 'class' => 'btn btn-sm btn-danger']) ?>
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