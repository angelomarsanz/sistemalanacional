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
    <div class="col-md-8">
		<input type="hidden" id="ambiente" value=<?= $system->logo ?>>
    	<div class="page-header">
    	    <p>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'addBasic', 'Users', 'indexPatientUser'], ['class' => 'glyphicon glyphicon-plus btn btn-sm btn-default', 'title' => 'Agregar paciente', 'style' => 'color: #9494b8']) ?>
    	    </p>
    	    <?php if ($current_user['role'] != 'Call center' && $current_user['role'] != 'Promotor(a)' && $current_user['role'] != 'Promotor(a) independiente'): ?>
                <div class="row">
                    <div class="col col-sm-5">
            	        <p><input type="text" id="promoter" class="form-control" placeholder="Buscar promotor..." title="Escriba el primer apellido del promotor"/></p>
                    </div>
                </div>
            <?php endif; ?>
    	</div>
		<?php if ($users == null): ?>
			<h2><?= $promoter ?></h2>
			<h4>No tiene pacientes asociados</h4>
		<?php else: ?>
			<h3>Pacientes asociados a:</h3>
			<h3><?= $promoter ?></h3>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">Nombre del paciente</th>
							<th scope="col" class="actions"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?= h($user->full_name) ?></td>
							<td class="actions">
								<?= $this->Html->link('', ['controller' => 'Users', 'action' => 'viewGlobal', $user->id, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-eye-open btn btn-sm btn-info', 'title' => 'Ver']) ?>
								<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'editBasic', $user->id, 'Users', 'indexPatientUser', $idPromoter, $promoter], ['class' => 'glyphicon glyphicon-edit btn btn-sm btn-primary', 'title' => 'Modificar']) ?>
								<?= $this->Form->postLink(__(''), ['action' => 'deleteBasic', $user->id, 'Users', 'indexPatientUser' ], ['confirm' => __('Está seguro de que desea eliminar el paciente?'), 'class' => 'glyphicon glyphicon-trash btn btn-sm btn-danger', 'title' => 'Eliminar']) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?> 
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
		<?= $this->Html->link(__(''), ['controller' => 'Patients', 'action' => 'reportPatients'], ['id' => 'report-patients', 'class' => 'glyphicon glyphicon-th-list btn btn-danger', 'title' => 'Reporte de pacientes']) ?>		
	
		<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
	</p>
</div>

<script>
    function log(id, promoter) 
    {
		if ($('#ambiente').val() == 'Producción')
		{
			$.redirect('/sln/users/indexPatientUser', { id : id, controller : 'Users', action : 'wait', name : promoter, }); 
		}
		else
		{
			$.redirect('/dsln/users/indexPatientUser', { id : id, controller : 'Users', action : 'wait', name : promoter, });
		}
    }
    function logPatient(id) 
    {
		if ($('#ambiente').val() == 'Producción')
		{
			$.redirect('/sln/users/viewGlobal', { id : id, controller : 'Users', action : 'indexPatientUser' }); 
		}
		else
		{
			$.redirect('/dsln/users/viewGlobal', { id : id, controller : 'Users', action : 'indexPatientUser' }); 
		}
    }
    $(document).ready(function(){ 
        $('#promoter').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPromoter")); ?>',
            minLength: 3,             
            select: function( event, ui ) {
                log(ui.item.id, ui.item.value);
              }
        });
        $('#patient').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPatient")); ?>',
            minLength: 3,             
            select: function( event, ui ) {
                logPatient(ui.item.id);
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