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
    <div class="page-header">  
        <h1>Servicio:&nbsp;<?= h($service->service_description) ?></h1>
        <input id="id-service" type="hidden" value=<?= $service->id ?>>
    </div>
    <div class="row">
        <div class="col col-sm-8">    
            <br />
                <b>Código:</b>&nbsp;<?= h($service->service_code) ?>
            <br />
            <br />   
                <b>Descripción:</b>&nbsp;<?= h($service->service_description) ?>
            <br />
            <br />
                <b>Estatus:</b>&nbsp;<?= h($service->registration_status) ?>
            <br />
            <br />
                <b>Precio en bolívares:</b>&nbsp;<?= number_format($service->cost_bolivars, 2, ",", ".") ?>
            <br />
            <br />
                <b>Precio en dólares:</b>&nbsp;<?= number_format($service->cost_dollars, 2, ",", ".") ?>
            <br />
            <br />
        </div>
    </div>
</div>
<div class="menumenos nover menu-menos">
    <p>
    <a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
    </p>
</div>
<div style="display:none;" class="menumas nover menu-mas">
    <p>
        <?php if (isset($controller)): ?>
	        <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
        <?php else: ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
        <?php endif; ?>
	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar vista']) ?>
        <?= $this->Html->link(__(''), ['controller' => 'Services', 'action' => 'edit', $service->id, 'Services', 'index'], ['id' => 'modificar-servicio', 'class' => 'glyphicon glyphicon-edit btn btn-danger', 'title' => 'Modificar servicio']) ?>
        <a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
    </p>
</div>
<script>
$(document).ready(function(){ 
    $('#mas').on('click',function()
    {
        $('.menu-menos').hide();
        $('.menu-mas').show();
    });
    
    $('#menos').on('click',function()
    {
        $('.menu-mas').hide();
        $('.menu-menos').show();
    });

});
</script>