<?php
    use Cake\Routing\Router; 
?>
<style>
    .ui-autocomplete 
    {
        z-index: 2000;
    }
</style>
<div class="container">
    <div class="page-header">    
 	    <p>
            <?php if (isset($controller)): ?>
    	        <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php else: ?>
        	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php endif; ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
        </p>
        <h1>Usuario:&nbsp;<?= h($user->username) ?></h1>
    </div>
    <div class="row">
        <div class="col col-sm-4">
            <?= $this->Html->image('../files/users/profile_photo/' . $user->profile_photo_dir . '/'. $user->profile_photo, ['url' => ['controller' => 'users', 'action' => 'view', $current_user['id']], 'class' => 'img-thumbnail img-responsive']) ?>
        </div>
        <div class="col col-sm-8">    
            <br />
                <b>Rol:</b>&nbsp;<?= h($user->role) ?>
            <br />
            <br />
                <b>Nombre del usuario:</b>&nbsp;<?= h($user->full_name) ?>
            <br />
            <br />
                <b>Sexo:</b>&nbsp;<?= h($user->sex) ?>
            <br />
            <br />

            <?php if ($user->employees): ?>
                    <b>Nacionalidad:&nbsp;</b><?= h($user->employees[0]['nationality']) ?>
                <br />
                <br />
                    <b>Identificación:&nbsp;</b><?= h($user->employees[0]['type_of_identification'] . '-' . $user->employees[0]['identity_card']) ?>
                <br />
                <br />
                    <b>País de nacimiento:&nbsp;</b><?= h($user->employees[0]['country_of_birth']) ?>
                <br />
                <br />
                    <b>Lugar de nacimiento:&nbsp;</b><?= h($user->employees[0]['place_of_birth']) ?>
                <br />
                <br />
                    <b>Fecha de nacimiento:&nbsp;</b><?= h($user->employees[0]['birthdate']->format('d-m-Y')) ?>
                <br />
                <br />
                    <b>Número de teléfono fijo:&nbsp;</b><?= h($user->employees[0]['landline']) ?>
                <br />
                <br />
            <?php endif; ?>     
           
                <b>Número de teléfono celular:</b>&nbsp;<?= h($user->cell_phone) ?>
            <br />
            <br />   
                <b>Email:</b>&nbsp;<?= h($user->email) ?>
            <br />
            <br />
        
            <?php if ($user->multilevels): ?>
                    <b>Profesión:</b>&nbsp;<?= h($user->multilevels[0]['profession']) ?>
                <br />
                <br />
                    <b>País donde reside:</b>&nbsp;<?= h($user->multilevels[0]['country']) ?>
                <br />            
                <br />
                    <b>Estado o provincia:</b>&nbsp;<?= h($user->multilevels[0]['province_state']) ?>
                <br />            
                <br />
                    <b>Ciudad:</b>&nbsp;<?= h($user->multilevels[0]['city']) ?>
                <br />            
                <br />
                    <b>Dirección de habitación:</b>&nbsp;<?= h($user->multilevels[0]['address']) ?>
                <br />            
                <br />
                    <b>¿Está activo como promotor(a) independiente?:</b>&nbsp;<?= $user->multilevels[0]['active'] ? __('Sí') : __('No está activo desde el: ' . $user->multilevels[0]['deactivation_date']->format('d-m-Y')); ?>
                <br />            
                <br />
                    <b>Número de cuenta bancaria:</b>&nbsp;<?= h($user->multilevels[0]['account_number']) ?>
                <br />            
                <br />
                    <b>Banco:&nbsp;</b><?= h($user->multilevels[0]['bank']) ?>
                <br />            
                <br />
                    <b>Dirección del banco:</b>&nbsp;<?= h($user->multilevels[0]['bank_address']) ?>
                <br />            
                <br />
                    <b>Swift:</b>&nbsp;<?= h($user->multilevels[0]['swift_bank']) ?>
                <br />            
                <br />
                    <b>ABA:</b>&nbsp;<?= h($user->multilevels[0]['aba_bank']) ?>
                <br />            
                <br />   

            <?php endif; ?>

            <?php if ($user->employees): ?>
                    <b>Dirección de habitación:&nbsp;</b><?= h($user->employees[0]['address']) ?>
                <br />
                <br />
                    <b>Grado de instrucción:&nbsp;</b><?= h($user->employees[0]['degree_instruction']) ?>
                <br />
                <br />
                   <b>Banco:&nbsp;</b><?= h($user->employees[0]['bank']) ?>
                <br />
                <br />
                   <b>Tipo de cuenta:&nbsp;</b><?= h($user->employees[0]['account_type']) ?>
                <br />
                <br />
                   <b>Número de cuenta:&nbsp;</b><?= h($user->employees[0]['account_bank']) ?>
                <br />
                <br />
            <?php endif; ?>
         </div>
    </div>
    <div class="related">
        <h4><?= __('Pacientes relacionados') ?></h4>
        <?php if (!empty($query)): ?>
            <div class="row">
                <div class="col col-sm-4">
                	<div class="table-responsive">
                		<table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('full_name', ['Nombre']) ?></th>
                                    <th scope="col" class="actions"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $querys): ?>
                                <tr>
                                    <td><?= h($querys->full_name) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link('Ver', ['controller' => 'Users', 'action' => 'viewGlobal', $querys->id, 'Users', 'view', $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    function log(id) 
    {
        $.redirect('/users/view', { id : id, controller : 'Users', action : 'index' }); 
    }
    $(document).ready(function(){ 
        $('#user').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findUser")); ?>',
            minLength: 3,             
            select: function( event, ui ) {
                log(ui.item.id);
              }
        });
    });
</script>