<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>

<style>
@media screen
{
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
    .botonMenu
    {
        margin-bottom: 5 px;
    }
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
</style>

<div class="container">
	<input type="hidden" id="ambiente" value=<?= $system->logo ?>>
    <div class="page-header">  
    </div>
    <div class="row">
    </div>
    <div id="menu-menos-budget" class="menumenos">
        <p>
        <a href="#" id="menu-mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
        </p>
    </div>
    <div id="menu-mas-budget" style="display:none;" class="menumas">
        <p>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
		<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar']) ?>
        <a href="#" id="menu-menos" title="Cerrar opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
        </p>
    </div>
</div>
<script>
function log(id, budgetSurgery) 
{
	if ($('#ambiente').val() == 'Producción')
	{
		$.redirect('/sln/budgets/mainBudget', { idBudget : id });
	}
	else
	{
		$.redirect('/dsln/budgets/mainBudget', { idBudget : id });
	}
}
$(document).ready(function(){ 
    $('#menu-mas').on('click',function()
    {
        $('#menu-menos-budget').hide();
        $('#menu-mas-budget').show();
    });
    $('#menu-menos').on('click',function()
    {
        $('#menu-mas-budget').hide();
        $('#menu-menos-budget').show();
    });
    $('#number-budget-search').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Budgets", "action" => "findBudget")); ?>',
        minLength: 5,             
        select: function( event, ui ) {
            log(ui.item.id, ui.item.value);
          }
    });
});
</script>