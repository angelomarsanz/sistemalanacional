<div class="container">
    <div class="page-header">    
        <?php if ($origin == null): ?>
     	    <p><?= $this->Html->link(__('Volver'), ['controller' => 'Users', 'action' => 'home'], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php else: ?> 
 	       <p><?= $this->Html->link(__('Volver'), ['controller' => 'Diarypatients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php endif; ?>
        <h2>Presupuesto enviado al paciente: <?= $namePatient ?></h2>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <?php if ($budget->initial_budget == null): ?>
                <p style="color: red;"><b>*** Aún no se ha enviado el presupuesto al paciente ***</b></p>
            <?php else: ?>
                <?= $this->Html->image('../files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'img-thumbnail img-responsive']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>