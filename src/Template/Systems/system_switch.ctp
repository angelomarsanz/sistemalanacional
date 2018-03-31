<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
    		<h2>Interruptores sistema</h2>
        </div>
        <?= $this->Form->create($system) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('system_switch', ['label' => 'Activo']);
					echo $this->Form->input('ambient', ['label' => 'Ambiente', 'options' => 
						[null => '',
						'Desarrollo' => 'Desarrollo',
						'Producción' => 'Producción']]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>