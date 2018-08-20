<div class="container">
    <div class="page-header">    
    </div>
    <div class="row">
        <p>Un paciente con el nombre de <?= $namePatient ?> y correo <?= $email ?> fue eliminado anteriormente de la base de datos.</p>
        <p>¿Desea restaurarlo?<?= $this->Html->link('Sí', ['controller' => 'Users', 'action' => 'restore', $id, 'Users', 'indexPatientUser'], ['class' => 'btn btn-sm btn-success', 'style' => 'margin: 10px;']) ?> <?= $this->Html->link('No', ['controller' => 'Users', 'action' => 'indexPatientUser'], ['class' => 'btn btn-sm btn-success', 'style' => 'margin: 10px 10px 10px 0px;']) ?></p>
    </div>
</div>