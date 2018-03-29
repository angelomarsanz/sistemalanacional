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
<?php if ($swImpresion == 0): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>Reporte de Comisiones</h2>
				<h4>Por favor seleccione las columnas a imprimir</h4>
			</div>
			<?= $this->Form->create() ?>
			<fieldset>	
				<div id="columns-report" class="row">
					<div class="col-md-12">
						<h4>Datos de la comisión</h4>
						<div class="row">
							<div class="col-md-4">
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.type_beneficiary]"> Tipo de beneficiario</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.amount]"> Monto</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.coin]"> Moneda</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.payment_method]"> Método de pago</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.account]"> Cuenta</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.account_type]"> Tipo de cuenta</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.bank]"> Banco</p>
							</div>
							<div class="col-md-4">
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.bank_address]"> Dirección del banco</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.swif_bank]"> Swif banco</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.aba_bank]"> Aba Banco</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.reference]"> Nro. de comprobante de pago</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.pay_day]"> Fecha del pago</p>
								<p><input class="column-mark" type="checkbox" name="columnsReport[Commissions.status_commission]"> Estatus de la comisión</p>								
							</div>
							<div class="col-md-4">							
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<br /> 					
				<div id="menu-menos" class="menumenos nover">
		<p>
		<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
		</p>
	</div>
	<div id="menu-mas" style="display:none;" class="menumas nover">
		<p>
			<?= $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'bill'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
			
			<button id="marcar-todos" class="glyphicon icon-checkbox-checked btn btn-danger" title="Marcar todos" style="padding: 8px 12px 10px 12px;"></button>

			<button id="desmarcar-todos" class="glyphicon icon-checkbox-unchecked btn btn-danger" title="Desmarcar todos" style="padding: 8px 12px 10px 12px;"></button>

			<?= $this->Form->button(__(''), ['id' => 'generar-reporte', 'title' => 'Generar reporte', 'class' => 'glyphicon glyphicon-th-list btn btn-danger']) ?>			
			<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
		</p>
	</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
<?php else: ?>
	<?php $commissionsDolarPaid = 0; 
		$commissionsDolarUnpaid = 0; 
		$commissionsBolivarPaid = 0; 
		$commissionsBolivarUnpaid = 0; 
		foreach ($commissions as $commission): 
			if ($commission->coin == 'BOLIVAR'): 
				if ($commission->status_commission == 'PAGADA'):
					$commissionsBolivarPaid+= $commission->amount;
				else: 
					$commissionsBolivarUnpaid+= $commission->amount;
				endif; 
			else: 
				if ($commission->status_commission == 'PAGADA'): 
					$commissionsDolarPaid+= $commission->amount;
				else:
					$commissionsDolarUnpaid+= $commission->amount;
				endif;
			endif;
		endforeach ?>
	<br />
	<br />
	<div>
		<?php $accountRecords = 0; ?>
		<?php foreach ($commissions as $commission): ?>
			<?php if ($accountRecords == 0): ?>
				<?php $accountRecords++; ?>
				<table id="commissions" name="commissions" class="noverScreen table">
					<thead>
						<tr>
							<th></th>
							<th><b>Cirugías La Nacional, C.A.</b></th>
						</tr>
						<tr>
							<th></th>
							<th>Reporte de comisiones de promotores</th>
						</tr>
						<tr>
							<th></th>
							<th><?= 'Fecha: ' . $currentDate->format('d-m-Y') ?></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Resumen:</b></td>
						</tr>		
						<tr>
							<th></th>
							<th>Comisiones en bolívares pagadas:</th>
							<th><?= number_format(($commissionsBolivarPaid), 2, ",", ".") ?></th>
						</tr>
						<tr>
							<th></th>
							<th>Comisiones en bolívares no pagadas:</th>
							<th><?= number_format(($commissionsBolivarUnpaid), 2, ",", ".") ?></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Total comisiones en bolívares:</b></th>
							<th><b><?= number_format(($commissionsBolivarPaid + $commissionsBolivarUnpaid), 2, ",", ".") ?></b></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th>Comisiones en dólares pagadas:</th>
							<th><?= number_format(($commissionsDolarPaid), 2, ",", ".") ?></th>
						</tr>
						<tr>
							<th></th>
							<th>Comisiones en dólares no pagadas:</th>
							<th><?= number_format(($commissionsDolarUnpaid), 2, ",", ".") ?></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Total comisiones en dólares:</b></th>
							<th><b><?= number_format(($commissionsDolarPaid + $commissionsDolarUnpaid), 2, ",", ".") ?></b></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Detalle:</b></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th scope="col"><b>Nro.</b></th>
							<th scope="col"><b>Promotor</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.type_beneficiary'] ?>><b>Tipo de beneficiario</b></th>
							<th scope="col"><b>Cirugía</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.status_commission'] ?>><b>Estatus de la comisión</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.amount'] ?>><b>Monto</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.coin'] ?>><b>Moneda</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.payment_method'] ?>><b>Método de pago</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.account'] ?>><b>Cuenta</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.account_type'] ?>><b>Tipo de cuenta</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.bank'] ?>><b>Banco</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.bank_address'] ?>><b>Dirección del banco</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.swif_bank'] ?>><b>Swif del banco</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.aba_bank'] ?>><b>Aba del banco</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.reference'] ?>><b>Nro. del comprobante de pago</b></th>
							<th scope="col" class=<?= $arrayMark['Commissions.pay_day'] ?>><b>Fecha del pago</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $accountRecords ?></td>
							<td><?= $commission->user->full_name ?></td>                       
							<td class=<?= $arrayMark['Commissions.type_beneficiary'] ?>><?= $commission->type_beneficiary ?></td>
							<td><?= $commission->budget->number_budget . ' - ' . $commission->budget->surgery ?></td>
							<td class=<?= $arrayMark['Commissions.status_commission'] ?>><?= $commission->status_commission ?></td>
							<td class=<?= $arrayMark['Commissions.amount'] ?>><?= number_format(($commission->amount), 2, ",", ".") ?></td>
							<td class=<?= $arrayMark['Commissions.coin'] ?>><?= $commission->coin ?></td>
							<td class=<?= $arrayMark['Commissions.payment_method'] ?>><?= $commission->payment_method ?></td>
							<td class=<?= $arrayMark['Commissions.account'] ?>><?= $commission->account ?></td>
							<td class=<?= $arrayMark['Commissions.account_type'] ?>><?= $commission->account_type ?></td>
							<td class=<?= $arrayMark['Commissions.bank'] ?>><?= $commission->bank ?></td>
							<td class=<?= $arrayMark['Commissions.bank_address'] ?>><?= $commission->bank_address ?></td>
							<td class=<?= $arrayMark['Commissions.swif_bank'] ?>><?= $commission->swif_bank ?></td>
							<td class=<?= $arrayMark['Commissions.aba_bank'] ?>><?= $commission->aba_bank ?></td>
							<td class=<?= $arrayMark['Commissions.reference'] ?>><?= $commission->reference ?></td>
							<td class=<?= $arrayMark['Commissions.pay_day'] ?>><?= $commission->pay_day ?></td>
						</tr>
			<?php else: ?>
				<?php $accountRecords++; ?>
				<tr>
					<td><?= $accountRecords ?></td>
					<td><?= $commission->user->full_name ?></td>
					<td class=<?= $arrayMark['Commissions.type_beneficiary'] ?>><?= $commission->type_beneficiary ?></td>
					<td><?= $commission->budget->number_budget . ' - ' . $commission->budget->surgery ?></td>
					<td class=<?= $arrayMark['Commissions.status_commission'] ?>><?= $commission->status_commission ?></td>
					<td class=<?= $arrayMark['Commissions.amount'] ?>><?= number_format(($commission->amount), 2, ",", ".") ?></td>
					<td class=<?= $arrayMark['Commissions.coin'] ?>><?= $commission->coin ?></td>
					<td class=<?= $arrayMark['Commissions.payment_method'] ?>><?= $commission->payment_method ?></td>
					<td class=<?= $arrayMark['Commissions.account'] ?>><?= $commission->account ?></td>
					<td class=<?= $arrayMark['Commissions.account_type'] ?>><?= $commission->account_type ?></td>
					<td class=<?= $arrayMark['Commissions.bank'] ?>><?= $commission->bank ?></td>
					<td class=<?= $arrayMark['Commissions.bank_address'] ?>><?= $commission->bank_address ?></td>
					<td class=<?= $arrayMark['Commissions.swif_bank'] ?>><?= $commission->swif_bank ?></td>
					<td class=<?= $arrayMark['Commissions.aba_bank'] ?>><?= $commission->aba_bank ?></td>
					<td class=<?= $arrayMark['Commissions.reference'] ?>><?= $commission->reference ?></td>
					<td class=<?= $arrayMark['Commissions.pay_day'] ?>><?= $commission->pay_day ?></td>
				</tr>
			<?php endif; ?>
		<?php endforeach ?>
		</tbody>
		</table>
		<a href='#' id="excel" title="EXCEL" class='btn btn-success'>Descargar reporte en excel</a>
	</div>
	<div id="menu-menos" class="menumenos nover">
		<p>
		<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
		</p>
	</div>
	<div id="menu-mas" style="display:none;" class="menumas nover">
		<p>
			<a href="/sln/budgets/bill" id="volver" title="Volver" class='glyphicon glyphicon-chevron-left btn btn-danger'></a>
			<a href="/sln/users/wait" id="cerrar" title="Cerrar vista" class='glyphicon glyphicon-remove btn btn-danger'></a>
			<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
		</p>
	</div>
<?php endif; ?>
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
    
    $("#excel").click(function(){
        
        $("#commissions").table2excel({
    
            exclude: ".noExl",
        
            name: "report_commissions",
        
            filename: $('#commissions').attr('name') 
    
        });
    });
	
	$('#marcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', true);
		});
	});
	
	$('#desmarcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', false);
		});
	});
	
});
</script>