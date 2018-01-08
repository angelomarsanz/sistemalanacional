<div class="container">
    <div class="page-header">    
    </div>
    <div class="row">
        <p>El paciente <? $namePatient ?> fue eliminado anteriormente de la base de datos. ¿Desea restaurarlo?</p>
        <p>
            <?= $this->Html->link('Sí', ['controller' => 'Users', 'action' => 'restorePatient'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= $this->Html->link('No', ['controller' => 'Users', 'action' => 'indexBasic'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>
</div>