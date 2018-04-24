<?php
<<<<<<< HEAD
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
=======
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $parameter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="parameters form large-9 medium-8 columns content">
    <?= $this->Form->create($parameter) ?>
    <fieldset>
        <legend><?= __('Edit Parameter') ?></legend>
        <?php
            echo $this->Form->input('ambient');
            echo $this->Form->input('dollar_promoter_percentage');
            echo $this->Form->input('dollar_father_percentage');
            echo $this->Form->input('dollar_grandfather_percentage');
            echo $this->Form->input('bolivar_promoter_percentage');
            echo $this->Form->input('bolivar_father_percentage');
            echo $this->Form->input('bolivar_grandfather_percentage');
            echo $this->Form->input('extra_column1');
            echo $this->Form->input('extra_column2');
            echo $this->Form->input('extra_column3');
            echo $this->Form->input('extra_column4');
            echo $this->Form->input('extra_column5');
            echo $this->Form->input('extra_column6');
            echo $this->Form->input('extra_column7');
            echo $this->Form->input('extra_column8');
            echo $this->Form->input('extra_column9');
            echo $this->Form->input('extra_column10');
            echo $this->Form->input('extra_column11');
            echo $this->Form->input('extra_column12');
            echo $this->Form->input('extra_column13');
            echo $this->Form->input('extra_column14');
            echo $this->Form->input('extra_column15');
            echo $this->Form->input('extra_column16');
            echo $this->Form->input('extra_column17');
            echo $this->Form->input('extra_column18');
            echo $this->Form->input('extra_column19');
            echo $this->Form->input('extra_column20');
            echo $this->Form->input('registration_status');
            echo $this->Form->input('reason_status');
            echo $this->Form->input('date_status', ['empty' => true]);
            echo $this->Form->input('responsible_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
>>>>>>> origin/master
