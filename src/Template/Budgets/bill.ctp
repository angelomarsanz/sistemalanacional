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

<script>
function log(id, budgetSurgery) 
{
	if ($('#ambiente').val() == 'Producción')
	{
		$.redirect('/sln/budgets/bill', { idBudget : id, budgetSurgery : budgetSurgery });
	}
	else
	{
		$.redirect('/dsln/budgets/bill', { idBudget : id, budgetSurgery : budgetSurgery });
	}
}

function mostrarMas()
{
    $('#menu-menos').toggle();
    $('#menu-mas').toggle();
}

function mostrarMenos()
{
	$('#menu-mas').toggle();
	$('#menu-menos').toggle();
}

$(document).ready(function()
{ 
    $(".decimal-2-places").numeric({ decimalPlaces: 2 });
    $('#number-budget-search').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Budgets", "action" => "findBudget")); ?>',
        minLength: 5,             
        select: function( event, ui ) {
            log(ui.item.id, ui.item.value);
          }
    });
	
    $('#ver-cargar-modificar-factura').on('click',function(){
        $('#cargar-modificar-factura').toggle('slow');
    });
	
    $('#eliminar-factura').on('click',function(e){
	
		e.preventDefault();
	
		var r= confirm('¿Está seguro de que desea eliminar esta factura?');
		if (r == false)
		{
			return false;
		}
	
		budgetSurgery = $('#number-budget').val() + ' - ' + $('#surgery').val();

		if ($('#ambiente').val() == 'Producción')
		{
			$.redirect('/sln/budgets/bill', { idBudget : $('#id').val(), budgetSurgery : budgetSurgery, swDelete : 1, promoter : $('#extra-column1').val() }); 
		}
		else
		{
			$.redirect('/dsln/budgets/bill', { idBudget : $('#id').val(), budgetSurgery : budgetSurgery, swDelete : 1, promoter : $('#extra-column1').val() });		
		}
	});
});
</script>

<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
			<input type="hidden" id="ambiente" value=<?= $system->logo ?>>
			<h3>Comisiones</h3>
            <?php if (isset($budgetSurgery)): ?>
                <h4>Presupuesto: <?= $budgetSurgery ?></h4>
				<h5>Paciente: <?= $budgetQuery->patient->user->full_name ?></h5>
            <?php endif; ?>
        </div>
        <?php if (isset($budget)):	
			if ($budget->initial_budget == null):
				echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
					$budget->id, 
					$budgetQuery->patient->user->full_name,
					$promoter->full_name, 
					$promoter->cell_phone, 
					$promoter->email, 'Budgets', 'bill'], ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto']);
			else: 
				$pdf = ".pdf";
				$pos = strpos($budget->initial_budget, $pdf);
				if ($pos):
					echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto', 'target' => '_blank']);
				else:    
					$txt = ".txt";   
					$pos = strpos($budget->initial_budget, $txt);
					if ($pos):
						echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto', 'target' => '_blank']);
					else:      
						echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
							$budget->id, 
							$budgetQuery->patient->user->full_name,
							$promoter->full_name, 
							$promoter->cell_phone, 
							$promoter->email, 'Budgets', 'bill'], ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto']);
				   endif;
				endif;
			endif;
		?>		
			<button id="ver-cargar-modificar-factura" class="glyphicon glyphicon-open btn btn-primary" title="Cargar o modificar la factura"></button>
			<button id="eliminar-factura" class="glyphicon glyphicon-trash btn btn-danger" title="Eliminar factura"></button>
			<?= $this->Html->link(__(''), ['controller' => 'Commissions', 'action' => 'index', $budget->id, 'Budgets', 'bill'], ['id' => 'pagar-comisiones', 'class' => 'glyphicon glyphicon-usd btn btn-primary', 'title' => 'Pagar comisiones']) ?>	
			
			<br />
			<br />
			<div id="cargar-modificar-factura" class="row" style="display:none">
				<div class="col-md-4">
					<?php if (isset($budget)): ?>
						<?= $this->Form->create($budget, ['type' => 'file']) ?>
							<fieldset>
								<?php
									echo $this->Form->input('id', ['label' => 'id: *']);
									echo $this->Form->input('surgery', ['type' => 'hidden']);
									echo $this->Form->input('number_budget', ['type' => 'hidden']);
									echo $this->Form->input('date_bill', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha de la factura: *']);
									echo $this->Form->input('number_bill', ['required' => 'true', 'label' => 'Número de la factura: *']);
									echo $this->Form->input('coin', ['disabled' => 'true', 'label' => 'Moneda:']);
									echo $this->Form->input('amount_bill', ['class' => 'decimal-2-places', 'required' => 'true', 'label' => 'Monto de la factura: *']);
									echo $this->Form->input('bill', array('type' => 'file', 'label' => 'Factura:'));
									echo $this->Form->input('extra_column1', ['type' => 'hidden', 'value' => $promoter->id]);
								?>
							</fieldset>
							<?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
						<?= $this->Form->end() ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>		
	</div>
</div>
<div id="menu-menos" class="menumenos nover">
	<p>
		<button type="button" id="mas" title="Más opciones" class="glyphicon glyphicon-plus btn btn-danger" onclick="mostrarMas()"></button>
	</p>
</div>
<div id="menu-mas" style="display:none;" class="menumas nover">
	<p>
		<?= $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'bill'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Commissions', 'action' => 'reportCommissions'], ['id' => 'report-commissions', 'class' => 'glyphicon glyphicon-th-list btn btn-danger', 'title' => 'Reporte de comisiones']) ?>	
		<?= $this->Html->link(__(''), ['controller' => 'Parameters', 'action' => 'edit', 2, 'Budgets', 'bill'], ['id' => 'report-commissions', 'class' => 'glyphicon icon-ISLR btn btn-danger', 'title' => 'Porcentaje comisiones', 'style' => 'padding: 8px 12px 10px 12px;']) ?>			
	
		<button type="button" id="menos" title="Menos opciones" class="glyphicon glyphicon-minus btn btn-danger" onclick="mostrarMenos()"></button>
	</p>
</div>