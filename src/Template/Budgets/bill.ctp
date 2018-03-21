<?php
    use Cake\Routing\Router; 
?>
<style>
@media screen
{
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
</style>
<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    	    <?= $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'bill'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
			<h2>Pagos</h2>
            <?php if (isset($surgery)): ?>
                <h3>Presupuesto <?= $budget->number_budget . ' ' . $surgery ?></h3>
				<h4>Paciente: <?= $budgetQuery->patient->user->full_name ?></h4>
            <?php endif; ?>
        </div>
        <?php if (isset($budget)): ?>
			<?php 	
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
			<button id="ver-cargar-factura" class="glyphicon glyphicon-open btn btn-primary" title="Cargar factura"></button>
			<button id="ver-modificar-factura" class="glyphicon glyphicon-edit btn btn-primary" title="Modificar factura"></button>
			<button id="eliminar-factura" class="glyphicon glyphicon-trash btn btn-primary" title="Eliminar factura"></button>
			<br />
			<br />
		<?php endif; ?>		
	</div>
</div>
<div id="cargar-factura" class="row" style="display:none">
    <div class="col-md-4">
		<h4>Cargar factura</h4>
        <?php if (isset($budget)): ?>
            <?= $this->Form->create($budget, ['type' => 'file']) ?>
                <fieldset>
                    <?php
                        echo $this->Form->input('id', ['label' => 'id: *']);
                        echo $this->Form->input('date_bill', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha de la factura: *']);
                        echo $this->Form->input('number_bill', ['type' => 'number', 'required' => 'true', 'label' => 'Número de la factura: *']);
                        echo $this->Form->input('amount_bill', ['class' => 'decimal-2-places', 'required' => 'true', 'label' => 'Monto de la factura: *']);
						echo $this->Form->input('coin_bill', ['label' => 'Moneda en que se emitió la factura: *', 'required' => 'true', 'options' => 
                        [null => " ",
                         'BOLIVAR' => 'BOLIVAR',
                         'DOLAR' => 'DOLAR']]);
                        echo $this->Form->input('bill', array('type' => 'file', 'label' => 'Factura:'));
						echo $this->Form->input('extra_column1', ['type' => 'hidden', 'id' => 'promoter', 'value' => $promoter->id]);
						echo $this->Form->input('surgery', ['type' => 'hidden']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
            <?= $this->Form->end() ?>
        <?php endif; ?>
    </div>
</div>
<div id="modificar-factura" class="row" style="display:none">
    <div class="col-md-4">
		<h4>Modificar factura</h4>
        <?php if (isset($budget)): ?>
            <?= $this->Form->create($budget, ['type' => 'file']) ?>
                <fieldset>
                    <?php
                        echo $this->Form->input('id', ['label' => 'id: *']);
                        echo $this->Form->input('date_bill', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha de la factura: *']);
                        echo $this->Form->input('number_bill', ['type' => 'number', 'required' => 'true', 'label' => 'Número de la factura: *']);
                        echo $this->Form->input('amount_bill', ['class' => 'decimal-2-places', 'required' => 'true', 'label' => 'Monto de la factura: *']);
						echo $this->Form->input('coin_bill', ['label' => 'Moneda en que se emitió la factura: *', 'required' => 'true', 'options' => 
                        [null => " ",
                         'BOLIVAR' => 'BOLIVAR',
                         'DOLAR' => 'DOLAR']]);
                        echo $this->Form->input('bill', array('type' => 'file', 'label' => 'Factura:'));
						echo $this->Form->input('extra_column1', ['type' => 'hidden', 'class' => 'promoter', 'value' => $promoter->id]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
            <?= $this->Form->end() ?>
        <?php endif; ?>
    </div>
</div>
<script>
function log(id, surgery) 
{
    $.redirect('/sln/budgets/bill', { idBudget : id, surgery : surgery }); 
}
$(document).ready(function()
{ 
    $(".decimal-2-places").numeric({ decimalPlaces: 2 });
    $('#number-budget').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Budgets", "action" => "findBudget")); ?>',
        minLength: 3,             
        select: function( event, ui ) {
            log(ui.item.id, ui.item.value);
          }
    });
	
    $('#ver-cargar-factura').on('click',function(){
		$('#modificar-factura').slideUp();
        $('#cargar-factura').toggle('slow');
    });

    $('#ver-modificar-factura').on('click',function(){
		$('#cargar-factura').slideUp();
        $('#modificar-factura').toggle('slow');
    });
	
    $('#eliminar-factura').on('click',function(e){
	
		e.preventDefault();
	
		alert('Eliminar promotor Nro. ' + $('#promoter').val());
		$.redirect('/sln/budgets/bill', { idBudget : $('#id').val(), surgery : $('#surgery').val(), swDelete : 1, promoter : $('#promoter').val() }); 
    });
});
</script>