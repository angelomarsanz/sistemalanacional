<div class="row">
    <div class="col-md-4">
    	<div class="page-header">
            <p><?= $this->Html->link(__('Volver'), ['controller' => 'Diarypatients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>
    		<h2>Enviar presupuesto de: <?= $budget->surgery ?>:</h2>
        </div>
            <?= $this->Form->create($budget, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('date_budget', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha del presupuesto: *']);
                    echo $this->Form->input('number_budget', ['type' => 'number', 'required' => 'true', 'label' => 'Número del presupuesto: *']);
                    echo $this->Form->input('amount_budget', ['class' => 'decimal-2-places', 'required' => 'true', 'label' => 'Monto del presupuesto: *']);

                    echo $this->Form->input('initial_budget', array('type' => 'file', 'label' => 'Presupuesto:'));
                ?>
            </fieldset>
        <?= $this->Form->button(__('Enviar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function()
    { 
        $(".decimal-2-places").numeric({ decimalPlaces: 2 });
    });
</script>