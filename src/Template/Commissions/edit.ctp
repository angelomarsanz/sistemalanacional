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
    <div class="col-md-10">
    	<div class="page-header">
			<h4>Registrar pagos</h4>
            <h5><?= 'Presupuesto: ' . $commission->budget->number_budget . ' - ' . $commission->budget->surgery ?></h5>
			<h5><?= 'Promotor: ' . $commission->user->full_name ?></h5>
			<h5><?= 'Nro. de identificación: ' . $commission->user->type_of_identification . '-' . $commission->user->identidy_card ?></h5>
        </div>
		<div id="cargar-modificar-promotor" class="row">
			<div class="col-md-10">
				<?= $this->Form->create($commission, ['type' => 'file']) ?>
					<fieldset>
						<div class="row">
						<div class="col-md-6">
						<?php
							echo $this->Form->input('id');
							echo $this->Form->input('coin', ['label' => 'Moneda:', 'disabled' => true]);
							echo $this->Form->input('amount', ['label' => 'Monto:', 'disabled' => true]);
							echo $this->Form->input('payment_method', ['label' => 'Método de pago:*', 'required' => true, 'options' => 
								[null => '',
								'Paypal' => 'Paypal',
								'Transferencia' => 'Transferencia',
								'Otro método de pago' => 'Otro método de pago']]);
							echo $this->Form->input('reference', ['label' => 'Nro. de comprobante:*', 'required' => true]);
							echo $this->Form->input('pay_day', ['label' => 'Fecha en que se realizó el pago:*', 
							'type' => 'date',
							'value' => $currentDate,
							'monthNames' =>
							['01' => 'Enero',
							'02' => 'Febrero',
							'03' => 'Marzo',
							'04' => 'Abril',
							'05' => 'Mayo',
							'06' => 'Junio',
							'07' => 'Julio',
							'08' => 'Agosto',
							'09' => 'Septiembre',
							'10' => 'Octubre',
							'11' => 'Noviembre',
							'12' => 'Diciembre'],
							'templates' => ['dateWidget' => '<ul class="list-inline"><li class="day">Día{{day}}</li><li class="month">Mes{{month}}</li><li class="year">Año{{year}}</li></ul>']]);
							echo $this->Form->input('account', ['label' => 'Cuenta o Paypal:', 'value' => $commission->user->employees[0]['account_bank']]);
						?>
						</div>
						<div class="col-md-6">
						<?php	
							echo $this->Form->input('account_type', ['label' => 'Tipo de cuenta:', 'value' => $commission->user->employees[0]['account_type'], 'options' => 
								[null => '',
								'Ahorros' => 'Ahorros',
								'Corriente' => 'Corriente',
								'paypal' => 'Paypal',
								'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
							echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $commission->user->employees[0]['bank']]);
							echo $this->Form->input('bank_address', ['label' => 'Dirección del banco:', 'value' => $commission->user->employees[0]['bank_address']]);
							echo $this->Form->input('swif_bank', ['label' => 'Swif del banco:', 'value' => $commission->user->employees[0]['swif_bank']]);				
							echo $this->Form->input('aba_bank', ['label' => 'Aba del banco:', 'value' => $commission->user->employees[0]['aba_bank']]);
							echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
						?>
						</div>
						</div>
					</fieldset>
					<?= $this->Form->button(__(''), ['id' => 'save-promoter', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
					<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $commission->budget_id, 'Budgets', 'bill'], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
					<?= $this->Form->end() ?>
			</div>
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
			<?php if ($controller == 'Commissions' && $action == 'index'): ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $commission->budget_id, 'Budgets', 'bill'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
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