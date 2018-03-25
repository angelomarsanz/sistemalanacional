<?php
    use Cake\Routing\Router; 
?>
<style>
@media screen
{
    .volver 
    {
        display:scroll;
        position:fixed;
        top: 15%;
        left: 50px;
        opacity: 0.5;
    }
    .cerrar 
    {
        display:scroll;
        position:fixed;
        top: 15%;
        left: 95px;
        opacity: 0.5;
    }
    .menumenos
    {
        display:scroll;
        position:fixed;
        bottom: 5%;
        right: 1%;
        opacity: 0.5;
        text-align: right;
    }
    .menumas 
    {
        display:scroll;
        position:fixed;
        bottom: 5%;
        right: 1%;
        opacity: 0.5;
        text-align: right;
    }
    .noverScreen
    {
      display:none
    }
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
@media print 
{
    .nover 
    {
      display:none
    }
    .saltopagina
    {
        display:block; 
        page-break-before:always;
    }
}
</style>

<div class="row">
    <div class="col-md-9">
    	<div class="page-header">
    	    <p>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'add', 'Users', 'index'], ['class' => 'glyphicon glyphicon-plus btn btn-sm btn-default', 'title' => 'Agregar usuario', 'style' => 'color: #9494b8']) ?>
    	    </p>
     	    <h2>Usuarios del sistema</h2>
    	</div>
        	<div class="table-responsive">
        		<table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 25%;">Nombre</th>
                            <th scope="col" style="width: 25%;">Rol</th>
                            <th scope="col" style="width: 25%;">Usuario</th>
                            <th scope="col" style="width: 25%;" class="actions"></th>
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
<div id="menu-menos" class="menumenos nover">
	<p>
	<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
	</p>
</div>
<div id="menu-mas" style="display:none;" class="menumas nover">
	<p>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Employees', 'action' => 'reportEmployees'], ['id' => 'report-commissions', 'class' => 'glyphicon glyphicon-th-list btn btn-danger', 'title' => 'Reporte de comisiones']) ?>		
	
		<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
	</p>
</div>
<script>
    function log(id) 
    {
        $.redirect('/sln/users/view', { id : id, controller : 'Users', action : 'index' }); 
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
		$('#mas').on('click',function()
		{
			$('#menu-menos').hide();
			$('#menu-mas').show();
		});
		
		$('#menos').on('click',function()
		{
			$('#menu-mas').hide();
			$('#menu-menos').show();
		});
    });
</script>