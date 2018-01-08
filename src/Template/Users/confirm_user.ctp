<div class="container">
    <div class="page-header">    
    </div>
    <div class="row">
        <p>El usuario <?= $nameUser ?> fue eliminado anteriormente de la base de datos.</p>
        <p>¿Desea restaurarlo?<?= $this->Html->link('Sí', ['controller' => 'Users', 'action' => 'restoreUser', $id, 'Users', 'index'], ['class' => 'btn btn-sm btn-success', 'style' => 'margin: 10px;']) ?> <?= $this->Html->link('No', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-sm btn-success', 'style' => 'margin: 10px 10px 10px 0px;']) ?></p>
    </div>
</div>