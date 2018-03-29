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
			<h4>Registrar pagos</h4>
            <?php if (isset($budget)): ?>
                <h5>Correspondientes al presupuesto: <?= $budget->number_budget . ' - ' . $budget->surgery ?></h5>
            <?php endif; ?>
        </div>
		<div>
			<table id="tabla-comisiones" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">Tipo de beneficiario</th>
						<th scope="col" style="width: 30%;">Nombre</th>
						<th scope="col" style="width: 10%;">Monto</th>
						<th scope="col" style="width: 15%;">Moneda</th>
						<th scope="col" style="width: 25%;" class="actions"></th>
                    </tr>
                </thead>
                <tbody>
					<tr id="promotor">
						<?php if (isset($cPromoter)): ?>
					
							<td>Promotor</td>
							<td><?= $promoterUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cPromoter->amount), 2, ",", ".") ?></td>
							<td><?= $cPromoter->coin ?></td>
							<td class="actions">
								<button id="pagar-a-promotor" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<button id="eliminar-pago" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
							</td>
						<?php else: ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						<?php endif; ?>
					</tr>
					<tr id="promotor-padre">
						<?php if (isset($cFather)): ?>
							<td>Promotor-padre</td>
							<td><?= $fatherUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cFather->amount), 2, ",", ".") ?></td>
							<td><?= $cFather->coin ?></td>
							<td class="actions">
								<button id="pagar-a-padre" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<button id="eliminar-pago" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
							</td>
						<?php else: ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						<?php endif; ?>
					</tr>
					<tr id="promotor-abuelo">
						<?php if (isset($cGrandfather)): ?>
							<td>Promotor-abuelo</td>
							<td><?= $grandfatherUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cGrandfather->amount), 2, ",", ".") ?></td>
							<td><?= $cGrandfather->coin ?></td>
							<td class="actions">
								<button id="pagar-a-abuelo" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<button id="eliminar-pago" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
							</td>
						<?php else: ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						<?php endif; ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="cargar-modificar-promotor" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor: ' . $promoterUser->user->full_name ?></b></p>
		<?= $this->Form->create($cPromoter, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda', 'disabled' => true]);
					
					echo $this->Form->input('payment_method', ['label' => 'Método de pago: *', 'value' => $promoterUser->payment_method, 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal: *', 'value' => $promoterUser->account_bank]);
				?>
				</div>
				<div class="col-md-6">
				<?php
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $promoterUser->bank]);
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante: *', 'value' => null, 'required' => true]);
					echo $this->Form->input('pay_day', ['label' => 'Fecha en que se realizó el pago: ', 
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
					echo $this->Form->input('account_type', ['type' => 'hidden', 'label' => 'Tipo de cuenta: *', 'value' => $promoterUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('bank_address', ['type' => 'hidden', 'label' => 'Dirección del banco: *', 'value' => $promoterUser->bank_address]);
					echo $this->Form->input('swif_bank', ['type' => 'hidden', 'label' => 'Swif del banco: *', 'value' => $promoterUser->swif_bank]);
					echo $this->Form->input('aba_bank', ['type' => 'hidden', 'label' => 'Aba del banco: *', 'value' => $promoterUser->aba_bank]);
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-user', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-promotor" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
		<?= $this->Form->end() ?>
	</div>
</div>	
<div id="cargar-modificar-padre" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor-padre: ' . $fatherUser->user->full_name ?></b></p>
		<?= $this->Form->create($cFather, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda', 'disabled' => true]);
					
					echo $this->Form->input('payment_method', ['label' => 'Método de pago: *', 'value' => $fatherUser->payment_method, 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal: *', 'value' => $fatherUser->account_bank]);
				?>
				</div>
				<div class="col-md-6">
				<?php
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $fatherUser->bank]);
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante: *', 'required' => true]);
					echo $this->Form->input('pay_day', ['label' => 'Fecha en que se realizó el pago: ', 
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
					echo $this->Form->input('account_type', ['type' => 'hidden', 'label' => 'Tipo de cuenta: *', 'value' => $fatherUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('bank_address', ['type' => 'hidden', 'label' => 'Dirección del banco: *', 'value' => $fatherUser->bank_address]);
					echo $this->Form->input('swif_bank', ['type' => 'hidden', 'label' => 'Swif del banco: *', 'value' => $fatherUser->swif_bank]);
					echo $this->Form->input('aba_bank', ['type' => 'hidden', 'label' => 'Aba del banco: *', 'value' => $fatherUser->aba_bank]);
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-user', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-padre" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
		<?= $this->Form->end() ?>
	</div>
</div>
<div id="cargar-modificar-abuelo" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor-abuelo: ' . $grandfatherUser->user->full_name ?></b></p>
		<?= $this->Form->create($cGrandfather, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda', 'disabled' => true]);
					
					echo $this->Form->input('payment_method', ['label' => 'Método de pago: *', 'value' => $grandfatherUser->payment_method, 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal: *', 'value' => $grandfatherUser->account_bank]);
				?>
				</div>
				<div class="col-md-6">
				<?php
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $grandfatherUser->bank]);
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante: *', 'required' => true]);
					echo $this->Form->input('pay_day', ['label' => 'Fecha en que se realizó el pago: ', 
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
					echo $this->Form->input('account_type', ['type' => 'hidden', 'label' => 'Tipo de cuenta: *', 'value' => $grandfatherUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('bank_address', ['type' => 'hidden', 'label' => 'Dirección del banco: *', 'value' => $grandfatherUser->bank_address]);
					echo $this->Form->input('swif_bank', ['type' => 'hidden', 'label' => 'Swif del banco: *', 'value' => $grandfatherUser->swif_bank]);
					echo $this->Form->input('aba_bank', ['type' => 'hidden', 'label' => 'Aba del banco: *', 'value' => $grandfatherUser->aba_bank]);
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-user', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-padre" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
		<?= $this->Form->end() ?>
	</div>
</div>		
<div id="menu-menos" class="menumenos nover">
	<p>
	<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
	</p>
</div>
<div id="menu-mas" style="display:none;" class="menumas nover">
	<p>
		<?php $budgetSurgery = $budget->number_budget . '-' . $budget->surgery; ?>
		<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $budget->id, $budgetSurgery], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
		<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
	</p>
</div>
<script>
$(document).ready(function(){ 
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
    $('#pagar-a-promotor').on('click',function(){
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-promotor').toggle('slow');
    });
    $('#cancelar-promotor').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-promotor').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
    $('#pagar-a-padre').on('click',function(){
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-padre').toggle('slow');
    });
    $('#cancelar-padre').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-padre').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
    $('#pagar-a-abuelo').on('click',function(){
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-abuelo').toggle('slow');
    });
    $('#cancelar-abuelo').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-abuelo').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
});
</script>			