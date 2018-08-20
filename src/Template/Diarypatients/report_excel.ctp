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
<input type="hidden" id="ambiente" value=<?= $system->ambient ?>>
<br />
<br />
<div>
	<?php $accountRecords = 1; ?>
	<?php foreach ($diary as $diarys): ?>
		<?php if ($accountRecords == 1): ?>

			<table id="budgets" name="budgets" class="table noverScreen">
				<thead>
					<tr>
						<th></th>
						<th><b>Cirugías La Nacional, C.A.</b></th>
					</tr>
					<tr>
						<th></th>
						<th>Reporte de presupuestos</th>
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
						<th>Presupuestos facturados:</th>
						<th><?= $counter['billedBudgets'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th>Presupuestos vigentes:</th>
						<th><?= $counter['currentBudgets'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th>Presupuestos vencidos:</th>
						<th><?= $counter['overdueBudgets'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th>Presupuestos no enviados:</th>
						<th><?= $counter['notSend'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Actividades pendientes de la agenda:</th>
						<th><?= $counter['pendingActivities'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th>Actividades atrasadas de la agenda:</th>
						<th><?= $counter['delayedActivities'] ?></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Presupuestos en bolívares</th>
						<th><?= $counter['bolivaresBudget'] ?></th>
					</tr>						
					<tr>
						<th></th>
						<th>Monto presupuestos en bolívares></th>
						<th><?= number_format($counter['AmountBolivares'], 2, ",", ".") ?></th>
					</tr>
					<tr>
						<th></th>
						<th>Presupuestos en dólares</th>
						<th><?= $counter['dollarsBudget'] ?></th>
					</tr>						
					<tr>
						<th></th>
						<th>Monto presupuestos en bolívares></th>
						<th><?= number_format($counter['AmountDollars'], 2, ",", ".") ?></th>
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
						<th scope="col" class=<?= $arrayMark['Users.full_name'] ?>><b>Nombre del paciente</b></th>
						<th scope="col"><b>Cirugía</b></th>							
						<th scope="col" class=<?= $arrayMark['Users.cell_phone'] ?>><b>Celular</b></th>
						<th scope="col" class=<?= $arrayMark['Users.email'] ?>><b>Email</b></th>
						<th scope="col"><b>Estatus del presupuesto</b></th>
						<th scope="col"><b>Fecha de solicitud</b></th>							
						<th scope="col"><b>Nro. presupuesto</b></th>
						<th scope="col" class=<?= $arrayMark['Budgets.coin'] ?>><b>Moneda</b></th>
						<th scope="col" class=<?= $arrayMark['Budgets.amount_budget'] ?>><b>Monto presupuesto</b></th>
						<th scope="col" class=<?= $arrayMark['Budgets.number_bill'] ?>><b>Nro. Factura</b></th>
						<th scope="col" class=<?= $arrayMark['Budgets.amount_bill'] ?>><b>Monto factura</b></th>
						<th scope="col" class=<?= $arrayMark['additional.namePromoter'] ?>><b>Promotor responsable</b></th>
						<th scope="col" class=<?= $arrayMark['additional.cellPromoter'] ?>><b>Celular</b></th>
						<th scope="col" class=<?= $arrayMark['additional.emailPromoter'] ?>><b>Email</b></th>
						<th scope="col" class=<?= $arrayMark['Diarys.short_description_activity'] ?>><b>Actividad de la agenda</b></th>
						<th scope="col" class=<?= $arrayMark['Diarys.activity_date'] ?>><b>Fecha actividad</b></th>
						<th scope="col" class=<?= $arrayMark['additional.statusActivity'] ?>><b>Estatus</b></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td scope="col"><?= $accountRecords ?></td>
						<td scope="col" class=<?= $arrayMark['Users.full_name'] ?>><?= $diarys->budget->patient->user->full_name ?></td>
						<td scope="col"><?= $diarys->budget->surgery ?></td>
						<td scope="col" class=<?= $arrayMark['Users.cell_phone'] ?>><?= $diarys->budget->patient->user->cell_phone ?></td>
						<td scope="col" class=<?= $arrayMark['Users.email'] ?>><?= $diarys->budget->patient->user->email?></td>							
						<td scope="col"><?= $additional[$diarys->id]['budgetStatus'] ?></td>
						<td scope="col"><?= $diarys->budget->application_date->format('d-m-Y') ?></td>							
						<td scope="col"><?= $diarys->budget->number_budget ?></td>
						<td scope="col" class=<?= $arrayMark['Budgets.coin'] ?>><?= $diarys->budget->coin ?></td>
						<td scope="col" class=<?= $arrayMark['Budgets.amount_budget'] ?>><?= number_format($diarys->budget->amount_budget, 2, ",", ".") ?></td>
						<td scope="col" class=<?= $arrayMark['Budgets.number_bill'] ?>><?= $diarys->budget->number_bill ?></td>
						<td scope="col" class=<?= $arrayMark['Budgets.amount_bill'] ?>><?= number_format($diarys->budget->amount_bill, 2, ",", ".") ?></td>
						<td scope="col" class=<?= $arrayMark['additional.namePromoter'] ?>><?= $additional[$diarys->id]['namePromoter'] ?></td>
						<td scope="col" class=<?= $arrayMark['additional.cellPromoter'] ?>><?= $additional[$diarys->id]['cellPromoter'] ?></td>
						<td scope="col" class=<?= $arrayMark['additional.emailPromoter'] ?>><?= $additional[$diarys->id]['emailPromoter'] ?></td>
						<td scope="col" class=<?= $arrayMark['Diarys.short_description_activity'] ?>><?= $diarys->short_description_activity ?></td>
						<td scope="col" class=<?= $arrayMark['Diarys.activity_date'] ?>><?= $diarys->activity_date ?></td>
						<td scope="col" class=<?= $arrayMark['additional.statusActivity'] ?>><?= $additional[$diarys->id]['statusActivity'] ?></td>
					</tr>
		<?php else: ?>
			<tr>
				<td scope="col"><?= $accountRecords ?></td>
				<td scope="col" class=<?= $arrayMark['Users.full_name'] ?>><?= $diarys->budget->patient->user->full_name ?></td>
				<td scope="col"><?= $diarys->budget->surgery ?></td>
				<td scope="col" class=<?= $arrayMark['Users.cell_phone'] ?>><?= $diarys->budget->patient->user->cell_phone ?></td>
				<td scope="col" class=<?= $arrayMark['Users.email'] ?>><?= $diarys->budget->patient->user->email?></td>							
				<td scope="col"><?= $additional[$diarys->id]['budgetStatus'] ?></td>
				<td scope="col"><?= $diarys->budget->application_date->format('d-m-Y') ?></td>							
				<td scope="col"><?= $diarys->budget->number_budget ?></td>
				<td scope="col" class=<?= $arrayMark['Budgets.coin'] ?>><?= $diarys->budget->coin ?></td>
				<td scope="col" class=<?= $arrayMark['Budgets.amount_budget'] ?>><?= number_format($diarys->budget->amount_budget, 2, ",", ".") ?></td>
				<td scope="col" class=<?= $arrayMark['Budgets.number_bill'] ?>><?= $diarys->budget->number_bill ?></td>
				<td scope="col" class=<?= $arrayMark['Budgets.amount_bill'] ?>><?= number_format($diarys->budget->amount_bill, 2, ",", ".") ?></td>
				<td scope="col" class=<?= $arrayMark['additional.namePromoter'] ?>><?= $additional[$diarys->id]['namePromoter'] ?></td>
				<td scope="col" class=<?= $arrayMark['additional.cellPromoter'] ?>><?= $additional[$diarys->id]['cellPromoter'] ?></td>
				<td scope="col" class=<?= $arrayMark['additional.emailPromoter'] ?>><?= $additional[$diarys->id]['emailPromoter'] ?></td>
				<td scope="col" class=<?= $arrayMark['Diarys.short_description_activity'] ?>><?= $diarys->short_description_activity ?></td>
				<td scope="col" class=<?= $arrayMark['Diarys.activity_date'] ?>><?= $diarys->activity_date ?></td>
				<td scope="col" class=<?= $arrayMark['additional.statusActivity'] ?>><?= $additional[$diarys->id]['statusActivity'] ?></td>
			</tr>
		<?php endif; ?>
		<?php $accountRecords++; ?>
	<?php endforeach ?>
	</tbody>
	</table>
	<a href='#' id="excel" title="EXCEL" class='btn btn-success'>Descargar reporte en excel</a>
</div>
<div id="menu-menos" class="menumenos nover">
	<p>
	<a href="#" id="mas" title="Menos opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
	</p>
</div>
<div id="menu-mas" style="display:none;" class="menumas nover">
	<p>
		<?php if ($system->ambient == 'Producción'): ?>
			<a href="/sln/budgets/mainBudget" id="volver" title="Volver" class='glyphicon glyphicon-chevron-left btn btn-danger'></a>
			<a href="/sln/users/wait" id="cerrar" title="Cerrar vista" class='glyphicon glyphicon-remove btn btn-danger'></a>
		<?php else: ?>
			<a href="/dsln/budgets/mainBudget" id="volver" title="Volver" class='glyphicon glyphicon-chevron-left btn btn-danger'></a>
			<a href="/dsln/users/wait" id="cerrar" title="Cerrar vista" class='glyphicon glyphicon-remove btn btn-danger'></a>
		<?php endif; ?>
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
    
    $("#excel").click(function(){
        
        $("#budgets").table2excel({
    
            exclude: ".noExl",
        
            name: "report_budgets",
        
            filename: $('#budgets').attr('name') 
    
        });
    });
	
});
</script> 