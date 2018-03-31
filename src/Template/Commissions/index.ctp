<?php
    use Cake\Routing\Router; 

	use Cake\I18n\Time;
	
	setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
	date_default_timezone_set('America/Caracas');
	
	$currentDate = time::now();
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
			<h4>Comisiones promotores</h4>
            <?php if (isset($budget)): ?>
                <h5>Correspondientes al presupuesto: <?= $budget->number_budget . ' - ' . $budget->surgery ?></h5>
            <?php endif; ?>
        </div>
		<div>
			<input type="hidden" id="id-budget" value=<?= $budget->id ?>>
			<table id="tabla-comisiones" class="table table-striped table-hover">
                <thead>
                    <tr>
						<th scope="col" style="width: 30%;">Nombre</th>
                        <th scope="col" style="width: 20%;">Tipo de beneficiario</th>
						<th scope="col" style="width: 15%;">Moneda</th>
						<th scope="col" style="width: 10%;">Monto</th>
						<th scope="col" style="width: 25%;" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach ($commissions as $commission): ?>						
						<tr>
							<td>$comission->user->full_name</td>
							<td>$comission->type_of_beneficiary</td>
							<td>$comission->coin</td>
							<td>$comission->amount</td>
							<td class="actions">
								<?= $this->Html->link(__(''), ['controller' => 'Commisions', 'action' => 'edit', $commission->id, 'Commissions', 'index'], ['class' => 'glyphicon glyphicon-usd btn btn-primary', 'title' => 'Registrar o modificar pago']) ?>
								<?= $this->Form->postLink(__(''), ['controller' => 'Commissions', 'action' => 'delete', $commission->id], ['class' => 'glyphicon glyphicon-usd btn btn-danger', 'title' => 'Eliminar pago'], ['confirm' => __('Está seguro de que desea eliminar esta comisión?']) ?>
							</td>
						</tr>
				</tbody>
			</table>
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
		<?php if (isset($controller) && isset($action)): ?>
			<?php if ($controller == 'Budgets' && $action == 'bill'): ?>
				<?php $budgetSurgery = $budget->number_budget . '-' . $budget->surgery; ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $budget->id, $budgetSurgery], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?php endif; ?>
		<?php else: ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
		<?php endif; ?>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
		<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
	</p>
</div>
<script>
$(document).ready(function(){ 
    $('#mas').on('click',function(e)
    {
		e.preventDefault();
        $('#menu-menos').hide();
        $('#menu-mas').show();
    });
    
    $('#menos').on('click',function(e)
    {
		e.preventDefault();
        $('#menu-mas').hide();
        $('#menu-menos').show();
    });	
});
</script>			