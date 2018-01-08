<?php
    use Cake\Routing\Router; 
?>
<style>
    .ui-autocomplete 
    {
        z-index: 2000;
    }
</style>
<div class="row">
    <div class="col-md-9">
    	<div class="page-header">
    	    <p>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait', 'indexPatientUser'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'add', 'Users', 'index'], ['class' => 'glyphicon glyphicon-plus btn btn-sm btn-default', 'title' => 'Agregar usuario', 'style' => 'color: #9494b8']) ?>
    	    </p>
     	    <h2>Usuarios del sistema</h2>
    	</div>
        	<div class="table-responsive">
        		<table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('full_name', ['Nombre']) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('rol', ['Rol']) ?></th>
                            <th scope="col"><?= $this->Paginator->sort('username', ['Usuario']) ?></th>
                            <th scope="col" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php if ($current_user['role'] == 'Promotor(a)' || $current_user['role'] == 'Promotor(a) independiente'): ?> 
                                <?php if ($user->parent_user == $current_user['id']): ?>
                                    <tr>
                                        <td><?= h($user->full_name) ?></td>
                                        <td><?= h($user->role) ?></td>
                                        <td><?= h($user->username) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link('', ['controller' => 'Users', 'action' => 'view', $user->id, 'Users', 'index'], ['class' => 'glyphicon glyphicon-eye-open btn btn-sm btn-info', 'title' => 'Ver']) ?>
                                            <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'edit', $user->id, 'Users', 'index'], ['class' => 'glyphicon glyphicon-edit btn btn-sm btn-primary', 'title' => 'Modificar']) ?>
                                            <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id, 'Users', 'index'], ['confirm' => __('Está seguro de que desea eliminar el usuario?'), 'class' => 'glyphicon glyphicon-trash btn btn-sm btn-danger', 'title' => 'Eliminar']) ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php else: ?> 
                                <tr>
                                    <td><?= h($user->full_name) ?></td>
                                    <td><?= h($user->role) ?></td>
                                    <td><?= h($user->username) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link('', ['controller' => 'Users', 'action' => 'view', $user->id, 'Users', 'index'], ['class' => 'glyphicon glyphicon-eye-open btn btn-sm btn-info', 'title' => 'Ver']) ?>
                                        <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'edit', $user->id, 'Users', 'index'], ['class' => 'glyphicon glyphicon-edit btn btn-sm btn-primary', 'title' => 'Modificar']) ?>
                                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id, 'Users', 'index'], ['confirm' => __('Está seguro de que desea eliminar el usuario?'), 'class' => 'glyphicon glyphicon-trash btn btn-sm btn-danger', 'title' => 'Eliminar']) ?>
                                    </td>
                                </tr>
                            <?php endif; ?>                       
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
<script>
    function log(id) 
    {
        $.redirect('/users/view', { id : id, controller : 'Users', action : 'index' }); 
    }
    $(document).ready(function(){ 
        $('#user').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findUser")); ?>',
            minLength: 3,             
            select: function( event, ui ) {
                log(ui.item.id);
              }
        });
    });
</script>