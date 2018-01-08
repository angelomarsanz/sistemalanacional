<?php
    use Cake\I18n\Time;
?>
<meta http-equiv="refresh" content="5">
<div class="container">
    <h2>Usuario(a): <?= $this->Html->link($current_user['surname'] . ' ' . $current_user['first_name'], ['controller' => 'Users', 'action' => 'view', $current_user['id']]) ?> ! </h2>

    <?php
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        date_default_timezone_set('America/Caracas');
        $currentDate = Time::now();
    ?>
    
    <h3>Verificando el servidor: <?= $currentDate->format('d-m-y H:i:s') ?> </h3>
    <div class="row">
        <div class="col col-sm-4">
            <?php if($current_user['profile_photo'] != '' && $current_user['role'] != ' ' && $current_user['role'] != null): ?>
                <?= $this->Html->image('../files/users/profile_photo/' . $current_user['profile_photo_dir'] . '/'. $current_user['profile_photo'], ['url' => ['controller' => 'users', 'action' => 'view', $current_user['id']], 'class' => 'img-thumbnail img-responsive']) ?>
            <?php endif; ?>
    	</div>
    </div>
</div>