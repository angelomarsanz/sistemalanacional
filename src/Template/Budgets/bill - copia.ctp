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
			<h2>Facturación</h2>
            <?php if (isset($surgery)): ?>
                <h5>Correspondiente al presupuesto: <?= $surgery ?></h5>
				<h5>Paciente: <?= $budgetQuery->patient->user->full_name ?></h5>
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
						echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto']);
						else:    
						$txt = ".txt";   
						$pos = strpos($budget->initial_budget, $txt);
						if ($pos):
							$file = fopen('../sln/webroot/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, "r") or exit("Unable to open file!");
							//Output a line of the file until the end is reached
							while(!feof($file))
							{
							echo fgets($file). "<br />";
							}
							fclose($file);
						
//							echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'glyphicon glyphicon-th-list btn btn-primary', 'title' => 'Ver presupuesto']);
						else:      
							echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
								$budget->id, 
								$budgetQuery->patient->user->full_name,
								$promoter->full_name, 
								$promoter->cell_phone, 
								$promoter->email, 'Budgets', 'bill'], ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto']);
					   endif;
					endif;
				endif;
			?>
			<br />
			<br />
		<?php endif; ?>		
	</div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php if (isset($budget)): ?>
            <?= $this->Form->create($budget, ['type' => 'file']) ?>
                <fieldset>
                    <?php
                        echo $this->Form->input('id', ['label' => 'id: *']);
                        echo $this->Form->input('date_bill', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha de la factura: *']);
                        echo $this->Form->input('number_bill', ['type' => 'number', 'required' => 'true', 'label' => 'Número de la factura: *']);
                        echo $this->Form->input('amount_bill', ['class' => 'decimal-2-places', 'required' => 'true', 'label' => 'Monto de la factura: *']);

                        echo $this->Form->input('bill', array('type' => 'file', 'label' => 'Factura:', 'required' => 'true'));
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

});
</script>