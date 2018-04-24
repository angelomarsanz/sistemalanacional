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

<script>
    $(document).ready(function()
    { 
    	$(".alternative-decimal-separator").numeric({ altDecimal: "," });
	});
</script>
<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
			<h4>Modificar porcentajes de comisiones</h4>
        </div>
		<div>
			<?= $this->Form->create($parameter) ?>
				<fieldset>
					<h5><b>En dólares:</b></h5>
					<div id="dolares" class="row">
						<div class="col-md-2">
							<label for="dollar-promoter-percentage">% Promotor</label>
							<input name="dollar_promoter_percentage" id="dollar-promoter-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->dollar_promoter_percentage, 2, ",", ".") ?>>
						</div>
						<div class="col-md-2">
							<label for="dollar-father-percentage">% Promotor-padre</label>
							<input name="dollar_father_percentage" id="dollar-father-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->dollar_father_percentage, 2, ",", ".") ?>>
						</div>
						<div class="col-md-2">
							<label for="dollar-grandfather-percentage">% Promotor-abuelo</label>
							<input name="dollar_grandfather_percentage" id="dollar-grandfather-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->dollar_grandfather_percentage, 2, ",", ".") ?>>
						</div>							
					</div>
					<h5><b>En bolívares:</b></h5>
					<div id="dolares" class="row">
						<div class="col-md-2">
							<label for="bolivar-promoter-percentage">% Promotor</label>
							<input name="bolivar_promoter_percentage" id="bolivar-promoter-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->bolivar_promoter_percentage, 2, ",", ".") ?>>
						</div>
						<div class="col-md-2">
							<label for="bolivar-father-percentage">% Promotor-padre</label>
							<input name="bolivar_father_percentage" id="bolivar-father-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->bolivar_father_percentage, 2, ",", ".") ?>>
						</div>
						<div class="col-md-2">
							<label for="bolivar-grandfather-percentage">% Promotor-abuelo</label>
							<input name="bolivar_grandfather_percentage" id="bolivar-grandfather-percentage" class="alternative-decimal-separator form-control" value=<?= number_format($parameter->bolivar_grandfather_percentage, 2, ",", ".") ?>>
						</div>	
					</div>						
				</fieldset>
				<br />
				<?= $this->Form->button(__(''), ['id' => 'save-promoter', 'class' =>'glyphicon glyphicon-floppy-disk btn btn-success', 'title' => 'Guardar']) ?>
				<?php if (isset($controller) && isset($action)): ?>
					<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
				<?php else: ?>
					<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
				<?php endif; ?>
			<?= $this->Form->end() ?>
		</div>	
	</div>
</div>