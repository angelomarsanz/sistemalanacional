<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
    	    <p>
            <?php if (isset($controller)): ?>
    	        <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php else: ?>
        	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php endif; ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
    	    </p>
    	    <h2>Agregar servicio</h2>
        </div>
            <?= $this->Form->create($service) ?>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <?php
                            echo $this->Form->input('service_code', ['label' => 'Código del servicio: *']);
                            echo $this->Form->input('service_description', ['label' => 'Servicio médico: *']);
                        ?>    
                        
                        <label class="control-label" for="cost-bolivars">Precio en bolívares: </label>
                        <input  id='cost-bolivars' name='cost_bolivars' style='text-align: right;' class='alternative-decimal-separator form-control' step='any' value=<?= number_format(0, 2, ",", ".") ?>>
                        <br />
                        
                        <label class="control-label" for="cost-dollars">Precio en dólares: </label>
                        <input  id='cost-dollars' name='cost_dollars' style='text-align: right;' class='alternative-decimal-separator form-control' step='any' value=<?= number_format(0, 2, ",", ".") ?>>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                        <label for="comment">Ítemes del presupuesto</label>
                        <textarea class="form-control" rows="100" id='itemes' name='itemes'></textarea>
                    
                    </div>
                </div>
                <br />
                <br />
            </fieldset>
        <?= $this->Form->button(__('Guardar'), ['id' => 'guardar-servicio', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function() 
    {
    	$(".alternative-decimal-separator").numeric({ altDecimal: "," });
    });
</script>