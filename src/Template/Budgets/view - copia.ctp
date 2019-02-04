<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>

<style>
@media screen
{
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
    .botonMenu
    {
        margin-bottom: 5 px;
    }
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
</style>


<div class="container">
    <div class="page-header">    

        <h2>Presupuesto enviado al paciente: <?= $namePatient ?></h2>
    </div>
    <div class="row">
        <div class="col col-sm-12">
			<?php if ($budget->initial_budget == null): ?>
				<?php if (substr($budget->number_budget, 0, 3) == 'APP'): ?>			
					<h3>Cirugías La Nacional, C.A.</h3>
					<p>Rif: J-40024519-2</p>
					<p>Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
					<p>+58-0241-835-2284</p>
					<br />
					<h5>---------------- CLIENT DATA / DATOS DEL CLIENTE -----------------</h5>
					<p>Name / Nombre / Razón social: <?= $namePatient ?></p>
					<?php if ($namePromoter != 'Sitio  Web '): ?>
						<p>Promoter assigned / Promotor asignado: <?= $namePromoter ?></p>
						<p>Promoter phone / Teléfono promotor: <?= $cellPromoter ?></p>
						<p>Promoter email / Correo del promotor: <?= $emailPromoter ?></p>
					<?php endif; ?>			
					<p>Phone / Teléfono: <?= $budget->patient->user->cell_phone ?></p>
					<p>Address / Dirección: <?= $budget->patient->address ?></p>
					<p>Country / país: <?= $budget->patient->country ?></p>
					<br />
					<h5>--------------- BUDGET / PRESUPUESTO ------------------------------</h5>
					<p>Budget / Presupuesto Nro. <?= $budget->number_budget ?> </p>
					<p>Start Date / Fecha de emisión: <?= $budget->application_date->format('d-m-Y') ?></p>
					<p>Expiration date / Fecha de vencimiento: <?= $budget->expiration_date->format('d-m-Y') ?></p>
					<p>Service requested / Servicio requerido: <?= $budget->surgery ?></p>
					<BR />
					<h5>--------------- DETAILS / DETALLES ---------------------------------</h5>
					<?= $itemes ?>
					<BR />
					<?php if (strtoupper($budget->patient->country) == 'VENEZUELA'): ?>
						<h4>GRAND TOTAL / TOTAL GENERAL Bs. <?= number_format($budget->amount_budget, 2, ",", ".") ?></h4>
					<?php else: ?>
						<h4>GRAND TOTAL / TOTAL GENERAL $ (USD) <?= number_format($budget->amount_budget, 2, ".", ",") ?></h4>			
					<?php endif; ?>
					<br />
					<p>Al aprobar el presente presupuesto y completar el proceso de compra y pago
					del mismo, usted confirma que leyó y aceptó los Términos y Condiciones de 
					nuestros servicios</p>				
					<br />
				<?php else: ?>
					<p style="color: red;"><b>*** Aún no se ha enviado el presupuesto al paciente ***</b></p>
				<?php endif; ?>
			<?php else: ?>
				<?= $this->Html->image('/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'img-thumbnail img-responsive']) ?>
			<?php endif; ?>
		</div>
    </div>
</div>
<div id="menu-menos-budget" class="menumenos">
	<p>
	<a href="#" id="menu-mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
	</p>
</div>
<div id="menu-mas-budget" style="display:none;" class="menumas">
	<p>
		<?php if ($controller == null): ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar']) ?>
		<?php elseif ($controller == 'Users' && $action == 'viewGlobal'): ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idUser, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar']) ?>
		<?php elseif ($controller == 'Budgets' && $action == 'bill'): ?>
			<?php $budgetSurgery = $budget->number_budget . ' - ' . $budget->surgery; ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $budget->id, $budgetSurgery], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar']) ?>
		<?php elseif ($controller == 'Budgets' && $action == 'mainBudget'): ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'budget', $idUser, $budget->patient->id, $idPromoter, 'Budgets', 'mainBudget', $budget->id, $budget->surgery], ['class' => 'glyphicon glyphicon-edit btn btn-danger', 'title' => 'Modificar presupuesto']) ?> 
			<?= $this->Form->postLink(__(''), ['controller' => 'Budgets', 'action' => 'delete', $budget->id, 'Budgets', 'mainBudget'], ['confirm' => __('Está seguro de que desea eliminar el presupuesto?'), 'class' => 'glyphicon glyphicon-trash btn btn-danger', 'title' => 'Eliminar']) ?>
			<?php else: ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger']) ?>
		<?php endif; ?>
		<a href="#" id="menu-menos" title="Cerrar opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
	</p>
</div>
<script>
$(document).ready(function(){ 
    $('#menu-mas').on('click',function()
    {
        $('#menu-menos-budget').hide();
        $('#menu-mas-budget').show();
    });
    $('#menu-menos').on('click',function()
    {
        $('#menu-mas-budget').hide();
        $('#menu-menos-budget').show();
    });
});
</script>