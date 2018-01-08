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
<div class='container'>
    <div class="row">
        <div class="col-md-10">

        	<div class="page-header">
                <h2>Presupuestos de Servicios Médicos</h2>
            </div>

        	<div>
                <?= $this->Form->create() ?>
                    <fieldset>
                    	<div class="table-responsive">
                    		<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Nro.</th>
                                        <th scope="col">Servicio&nbsp;médico</th>
                                        <th scope="col">Precio&nbsp;en&nbsp;bolívares</th>
                                        <th scope="col">Precio&nbsp;en&nbsp;dólares</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $accountArray = 0;
                                        $accountService = 1;
                                        foreach ($services as $service): 
                                    ?>
                                        <tr>
                                            <td><input type="hidden" name="service[<?= $accountArray ?>][id]" value=<?=$service->id ?>></td>
                                            
                                            <td><?= $this->Html->link(__(''), ['controller' => 'Services', 'action' => 'edit', $service->id, 'Services', 'index'], ['id' => 'modificar-servicio', 'class' => 'glyphicon glyphicon-edit btn btn-default', 'title' => 'Modificar servicio', 'style' => 'color: #9494b8; padding: 4px 6px;']) ?></td>

                                            <td><?= $accountService ?></td>
                                            
                                            <td><?= $service->service_description ?></td>
                                            
                                            <td><input style='text-align: right;' class='alternative-decimal-separator form-control' name="service[<?= $accountArray ?>][cost_bolivars]" title='Precio en bolívares' step='any' value=<?= number_format($service->cost_bolivars, 2, ",", ".") ?>></td>
                                            
                                            <td><input style='text-align: right;' class='alternative-decimal-separator form-control' name="service[<?= $accountArray ?>][cost_dollars]" title='Precio en dólares' step='any' value=<?= number_format($service->cost_dollars, 2, ",", ".") ?>></td>

                                        </tr>
                                    <?php 
                                        $accountArray++; 
                                        $accountService++;
                                        endforeach; ?>
                                </tbody>
                            </table>
                            <?= $this->Html->link(__(''), ['controller' => 'Services', 'action' => 'add', 'Services', 'index'], ['id' => 'agregar-servicio', 'class' => 'glyphicon glyphicon-th-list btn btn-default', 'title' => 'Agregar servicio', 'style' => 'color: #9494b8;']) ?>
                            <br />
                            <br />
                        </div>
                    </fieldset>   
                    <?= $this->Form->button(__('Guardar'), ['class' =>'btn btn-success noverScreen']) ?> 
                <?= $this->Form->end() ?>
            </div>
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
        <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
        <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
        <?= $this->Html->link(__(''), ['controller' => 'Services', 'action' => 'specialIndex'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-th-list btn btn-danger', 'title' => 'Servicios inactivos o eliminados']) ?>
        <a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
    </p>
</div>
<script>
// Variables

// Funciones

function log(id) 
{
    $.redirect('/services/view', { id : id, controller : 'Services', action : 'index' }); 
}

// Documento

$(document).ready(function()
{ 
	$(".alternative-decimal-separator").numeric({ altDecimal: "," });

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

    $('#service').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Services", "action" => "findService")); ?>',
        minLength: 3,             
        select: function( event, ui ) {
            log(ui.item.id);
          }
    });

});
</script>
