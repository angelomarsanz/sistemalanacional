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
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h2>Reporte de presupuestos</h2>
			<h4>Por favor seleccione las columnas a imprimir</h4>
		</div>
		<?= $this->Form->create() ?>
		<fieldset>	
			<div id="columns-report" class="row">
				<div class="col-md-12">
					<h4>Datos de los presupuestos y agenda</h4>
					<div class="row">
						<div class="col-md-4">
							<p><input class="column-mark" type="checkbox" name="columnsReport[Users.full_name]"> Nombre del paciente</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Users.cell_phone]"> celular</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Users.email]"> Email</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Budgets.coin]"> Moneda</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Budgets.amount_budget]"> Monto del presupuesto</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Budgets.number_bill]"> Número de la factura</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Budgets.amount_bill]"> Monto de la factura</p>								
						</div>
						<div class="col-md-4">
							<p><input class="column-mark" type="checkbox" name="columnsReport[additional.namePromoter]"> Nombre del promotor</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[additional.cellPromoter]"> Celular</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[additional.emailPromoter]"> Email</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Diarys.short_description_activity]"> Actividad de la agenda</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[Diarys.activity_date]"> Fecha actividad</p>
							<p><input class="column-mark" type="checkbox" name="columnsReport[additional.statusActivity]"> Estatus de la actividad</p>
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
				<?= $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'mainBudget'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
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
    
	$('#marcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', true);
			$(this).prop('checked', true);
		});
	});
	
	$('#desmarcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', false);
			$(this).prop('checked', false);
		});
	});
	$('#generar-reporte').click(function()
	{			
		alert('Estimado usuario, este reporte demorará unos segundos. Por favor pulse ** Aceptar ** para continuar');
	});
	
});
</script> 