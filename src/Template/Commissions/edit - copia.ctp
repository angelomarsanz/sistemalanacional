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
			<input type="hidden" id="id-budget" value=<?= $budget->id ?>>
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
					<?php if (isset($cPromoter)): ?>
						<tr id="promotor">
					<?php else: ?>
						<tr id="promotor" style="display: none;">	
					<?php endif; ?>
							<td>Promotor</td>
							<td><?= $promoterUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cPromoter->amount), 2, ",", ".") ?></td>
							<td><?= $cPromoter->coin ?></td>
							<td class="actions">
								<button id="pagar-a-promotor" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<?php if ($cPromoter->status_commission == 'PAGADA'): ?>
									<input type="hidden" id="id-commission-promoter" value=<?= $cPromoter->id ?>>
									<button id="eliminar-pago-promotor" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
								<?php else: ?>
									<button id="eliminar-pago-promotor" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago" disabled="true"></button>
								<?php endif; ?>
							</td>
						</tr>
					<?php if (isset($cFather)): ?>
						<tr id="promotor-padre">
					<?php else: ?>
						<tr id="promotor-padre" style="display: none;">	
					<?php endif; ?>
							<td>Promotor-padre</td>
							<td><?= $fatherUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cFather->amount), 2, ",", ".") ?></td>
							<td><?= $cFather->coin ?></td>
							<td class="actions">
								<button id="pagar-a-padre" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<?php if ($cFather->status_commission == 'PAGADA'): ?>
									<input type="hidden" id="id-commission-father" value=<?= $cFather->id ?>>
									<button id="eliminar-pago-padre" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
								<?php else: ?>
									<button id="eliminar-pago-padre" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago" disabled="true"></button>
								<?php endif; ?>
							</td>
						</tr>
					<?php if (isset($cGrandfather)): ?>
						<tr id="promotor-abuelo">
					<?php else: ?>
						<tr id="promotor-abuelo" style="display: none;">	
					<?php endif; ?>
							<td>Promotor-abuelo</td>
							<td><?= $grandfatherUser->user->full_name ?></td>
							<td style="text-align: right;"><?= number_format(($cGrandfather->amount), 2, ",", ".") ?></td>
							<td><?= $cGrandfather->coin ?></td>
							<td class="actions">
								<button id="pagar-a-abuelo" class="glyphicon glyphicon-usd btn btn-primary" title="Registrar o modificar pago"></button>
								<?php if ($cGrandfather->status_commission == 'PAGADA'): ?>
									<input type="hidden" id="id-commission-grandfather" value=<?= $cGrandfather->id ?>>
									<button id="eliminar-pago-abuelo" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago"></button>
								<?php else: ?>
									<button id="eliminar-pago-abuelo" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar pago" disabled="true"></button>
								<?php endif; ?>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="cargar-modificar-promotor" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor: ' . $promoterUser->user->full_name ?></b></p>
		<p><b><?= 'Nro. de identificación: ' . $promoterUser->user->type_of_identification . '-' . $promoterUser->user->identidy_card ?></b></p>
		<?= $this->Form->create($cPromoter, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto:', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda:', 'disabled' => true]);
					echo $this->Form->input('account_type', ['label' => 'Tipo de cuenta:', 'value' => $promoterUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal:', 'value' => $promoterUser->account_bank]);
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $promoterUser->bank]);
					echo $this->Form->input('bank_address', ['label' => 'Dirección del banco:', 'value' => $promoterUser->bank_address]);
				?>
				</div>
				<div class="col-md-6">
				<?php	
					echo $this->Form->input('swif_bank', ['label' => 'Swif del banco:', 'value' => $promoterUser->swif_bank]);				
					echo $this->Form->input('aba_bank', ['label' => 'Aba del banco:', 'value' => $promoterUser->aba_bank]);
					echo $this->Form->input('payment_method', ['label' => 'Método de pago:*', 'required' => true, 'value' => null, 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante:*', 'value' => null, 'required' => true]);
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-promoter', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-promotor" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
		<?= $this->Form->end() ?>
	</div>
</div>	

<div id="cargar-modificar-padre" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor-padre: ' . $fatherUser->user->full_name ?></b></p>
		<p><b><?= 'Nro. de identificación: ' . $fatherUser->user->type_of_identification . '-' . $fatherUser->user->identidy_card ?></b></p>
		<?= $this->Form->create($cFather, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto:', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda:', 'disabled' => true]);
					echo $this->Form->input('account_type', ['label' => 'Tipo de cuenta:', 'value' => $fatherUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal:', 'value' => $fatherUser->account_bank]);
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $fatherUser->bank]);
					echo $this->Form->input('bank_address', ['label' => 'Dirección del banco:', 'value' => $fatherUser->bank_address]);
				?>
				</div>
				<div class="col-md-6">
				<?php
					echo $this->Form->input('swif_bank', ['label' => 'Swif del banco:', 'value' => $fatherUser->swif_bank]);
					echo $this->Form->input('aba_bank', ['label' => 'Aba del banco:', 'value' => $fatherUser->aba_bank]);
					echo $this->Form->input('payment_method', ['label' => 'Método de pago:*', 'required' => true, 'value' => '', 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante:*', 'value' => '', 'required' => true]);
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-father', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-padre" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
		<?= $this->Form->end() ?>
	</div>
</div>
<div id="cargar-modificar-abuelo" class="row" style="display:none">
	<div class="col-md-9">
		<p><b><?= 'Registrar el pago del promotor-abuelo: ' . $grandfatherUser->user->full_name ?></b></p>
		<p><b><?= 'Nro. de identificación: ' . $grandfatherUser->user->type_of_identification . '-' . $grandfatherUser->user->identidy_card ?></b></p>
		<?= $this->Form->create($cGrandfather, ['type' => 'file']) ?>
			<fieldset>
				<div class="row">
				<div class="col-md-6">
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('amount', ['label' => 'Monto:', 'disabled' => true]);
					echo $this->Form->input('coin', ['label' => 'Moneda:', 'disabled' => true]);
					echo $this->Form->input('account_type', ['label' => 'Tipo de cuenta:', 'value' => $grandfatherUser->account_type, 'options' => 
						[null => '',
						'Ahorros' => 'Ahorros',
						'Corriente' => 'Corriente',
						'paypal' => 'Paypal',
						'Otro tipo de cuenta' => 'Otro tipo de cuenta']]);
					echo $this->Form->input('account', ['label' => 'Cuenta o Paypal:', 'value' => $grandfatherUser->account_bank]);
					echo $this->Form->input('bank', ['label' => 'Banco:', 'value' => $grandfatherUser->bank]);
					echo $this->Form->input('bank_address', ['label' => 'Dirección del banco:', 'value' => $grandfatherUser->bank_address]);
				?>
				</div>
				<div class="col-md-6">
				<?php
					echo $this->Form->input('swif_bank', ['label' => 'Swif del banco:', 'value' => $grandfatherUser->swif_bank]);
					echo $this->Form->input('aba_bank', ['label' => 'Aba del banco:', 'value' => $grandfatherUser->aba_bank]);
					echo $this->Form->input('payment_method', ['label' => 'Método de pago:*', 'required' => true, 'value' => '', 'options' => 
						[null => '',
						'Transferencia' => 'Transferencia',
						'Paypal' => 'Paypal',
						'Otro método de pago' => 'Otro método de pago']]);					
					echo $this->Form->input('reference', ['label' => 'Nro. de comprobante:*', 'value' => '', 'required' => true]);
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
					echo $this->Form->input('voucher', array('type' => 'file', 'label' => 'Comprobante de pago:'));
				?>
				</div>
				</div>
			</fieldset>
			<?= $this->Form->button(__(''), ['id' => 'save-grandfather', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
			<button id="cancelar-abuelo" class="glyphicon glyphicon-remove btn" title="Cancelar"></button>
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
    $('#pagar-a-promotor').on('click',function(e){
		e.preventDefault();
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-promotor').toggle('slow');
    });
    $('#cancelar-promotor').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-promotor').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
    $('#pagar-a-padre').on('click',function(e){
		e.preventDefault();
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-padre').toggle('slow');
    });
    $('#cancelar-padre').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-padre').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
    $('#pagar-a-abuelo').on('click',function(e){
		e.preventDefault();
		$('#tabla-comisiones').slideUp();
		$('#cargar-modificar-abuelo').toggle('slow');
    });
    $('#cancelar-abuelo').on('click',function(e){
		e.preventDefault();
		$('#cargar-modificar-abuelo').slideUp();
		$('#tabla-comisiones').toggle('slow');
    });
    $('#eliminar-pago-promotor').on('click',function(e){
		e.preventDefault();
		var r= confirm('¿Está seguro de que desea eliminar este pago?');
		if (r == false)
		{
			return false;
		}
        $.redirect('/sln/commissions/edit', { id : $('#id-commission-promoter').val(), idBudget : $('#id-budget').val(), swDelete : 1, }); 
    });
    $('#eliminar-pago-padre').on('click',function(e){
		e.preventDefault();
		var r= confirm('¿Está seguro de que desea eliminar este pago?');
		if (r == false)
		{
			return false;
		}
        $.redirect('/sln/commissions/edit', { id : $('#id-commission-father').val(), idBudget : $('#id-budget').val(), swDelete : 1, }); 
    });
    $('#eliminar-pago-abuelo').on('click',function(e){
		e.preventDefault();
		var r= confirm('¿Está seguro de que desea eliminar este pago?');
		if (r == false)
		{
			return false;
		}
        $.redirect('/sln/commissions/edit', { id : $('#id-commission-grandfather').val(), swDelete : 1, }); 
    });
});
</script>			