<div class="container">
    <div class="page-header">    
        <?php if ($controller == null): ?>
     	    <p><?= $this->Html->link(__('Volver'), ['controller' => 'Users', 'action' => 'home'], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php else: ?> 
 	       <p><?= $this->Html->link(__('Volver'), ['controller' => $controller, 'action' => $action, $idUser], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php endif; ?>
        <h1>Paciente:&nbsp;<?= h($user->full_name) ?></h1>
    </div>
    <div class="row">
        <div class="col col-sm-4">
            <?= $this->Html->image('../files/users/profile_photo/' . $user->profile_photo_dir . '/'. $user->profile_photo, ['url' => ['controller' => 'users', 'action' => 'view', $current_user['id']], 'class' => 'img-thumbnail img-responsive']) ?>
        </div>
        <div class="col col-sm-8">    
            <br />
                <b>Usuario:</b>&nbsp;<?= h($user->username) ?>
            <br />
            <br />
                <b>Sexo:</b>&nbsp;<?= h($user->sex) ?>
            <br />
            <br />
        
            <?php if ($user->patients): ?>
            
                    <b>Fecha de nacimiento:</b>&nbsp;<?= h($user->patients[0]['birthdate']->format('d-m-Y')) ?>
                <br />            
                <br />
                    <b>País donde reside:</b>&nbsp;<?= h($user->patients[0]['country']) ?>
                <br />            
                <br />
                    <b>Estado o provincia:</b>&nbsp;<?= h($user->patients[0]['province_state']) ?>
                <br />            
                <br />
                    <b>Ciudad:</b>&nbsp;<?= h($user->patients[0]['city']) ?>
                <br />            
                <br />
                    <b>Dirección de habitación:</b>&nbsp;<?= h($user->patients[0]['address']) ?>
                <br />            
                <br />
                    <b>Número de teléfono fijo:</b>&nbsp;<?= h($user->patients[0]['landline']) ?>
                <br />            
                <br />
            
            <?php endif; ?>
            
                <b>Número de teléfono celular:</b>&nbsp;<?= h($user->cell_phone) ?>
            <br />
            <br />   
                <b>Email:</b>&nbsp;<?= h($user->email) ?>
            <br />
            <br />

            <?php if ($user->patients): ?>

                    <h3>Datos laborales:</h3>
                    <hr size="3" />
                    <b>Profesión:</b>&nbsp;<?= h($user->patients[0]['profession']) ?>
                <br />
                <br />
                    <b>Empresa o institución donde trabaja:</b>&nbsp;<?= h($user->patients[0]['workplace']) ?>
                <br />
                <br />
                    <b>Teléfono:</b>&nbsp;<?= h($user->patients[0]['work_phone']) ?>
                <br />
                <br />
                    <b>Dirección de la empresa o institución:</b>&nbsp;<?= h($user->patients[0]['work_address']) ?>
                <br />
                <br />
                    <h3>Datos bancarios:</h3>
                    <hr size="3" />
                    <b>Número de cuenta bancaria:</b>&nbsp;<?= h($user->patients[0]['account_number']) ?>
                <br />            
                <br />
                    <b>Banco:&nbsp;</b><?= h($user->patients[0]['bank']) ?>
                <br />            
                <br />
                    <b>Dirección del banco:</b>&nbsp;<?= h($user->patients[0]['bank_address']) ?>
                <br />            
                <br />
                    <b>Swift:</b>&nbsp;<?= h($user->patients[0]['swift_bank']) ?>
                <br />            
                <br />
                    <b>ABA:</b>&nbsp;<?= h($user->patients[0]['aba_bank']) ?>
                <br />            
                <br />         
                    <h3>Datos de la persona de contacto en caso de emergencia:</h3>
                    <hr size="3" />
                    <b>Nombre:</b>&nbsp;<?= $user->patients[0]['first_name_emergency'] . ' ' . $user->patients[0]['surname_emergency'] ?>
                <br />
                <br />
                    <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['type_of_identification_emergency'] . '-' . $user->patients[0]['identidy_card_emergency'] ?>
                <br />
                <br />
                    <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_emergency'] ?>
                <br />
                <br />
                    <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_emergency'] ?>
                <br />
                <br />
                    <h3>Datos del acompañante:</h3>
                    <hr size="3" />
                    <b>Nombre:</b>&nbsp;<?= $user->patients[0]['first_name_companion'] . ' ' . $user->patients[0]['surname_companion'] ?>
                <br />
                <br />
                    <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['type_of_identification_companion'] . '-' . $user->patients[0]['identidy_card_companion'] ?>
                <br />
                <br />
                    <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_companion'] ?>
                <br />
                <br />
                    <b>Email:</b>&nbsp;<?= $user->patients[0]['email_companion'] ?>
                <br />
                <br />
                    <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_companion'] ?>
                <br />
                <br />
                    <b>Celular:</b>&nbsp;<?= $user->patients[0]['cell_phone_companion'] ?>
                <br />
                <br />
                    <h3>Datos del responsable del pago:</h3>
                    <hr size="3" />
                    <b>Nombre o razón social del responsable del pago:</b>&nbsp;<?= $user->patients[0]['sponsor'] ?>
                <br />
                <br />
                    <b>Clasificación del responsable del pago:</b>&nbsp;<?= $user->patients[0]['sponsor_type'] ?>
                <br />
                <br />
                    <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['sponsor_identification'] ?>
                <br />
                <br />
                    <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_sponsor'] ?>
                <br />
                <br />
                    <b>Email:</b>&nbsp;<?= $user->patients[0]['email_sponsor'] ?>
                <br />
                <br />
                    <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_sponsor'] ?>
                <br />
                <br />
                    <b>Celular:</b>&nbsp;<?= $user->patients[0]['cell_phone_sponsor'] ?>
                <br />
                <br />

            <?php endif; ?>

         </div>
    </div>
</div>