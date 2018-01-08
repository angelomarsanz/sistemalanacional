<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
     	    <p>
            <?php if (isset($action)): ?>
				<?php if ($action == 'indexPatientUser'): ?>
					<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idPromoter, 'Users', 'wait', $promoter], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>				
				<?php elseif ($action == 'viewGlobal'): ?>
					<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $user->id, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
				<?php endif; ?>
			<?php else: ?>
        	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'indexPatientUser'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php endif; ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
            </p>
    		<h2>Modificar los datos del paciente:</h2>
        </div>
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('id', ['label' => 'id']); 
                    echo $this->Form->input('type_of_identification', ['label' => 'Tipo de documento de identificación: *', 'options' => 
                        [null => " ",
                         'V' => 'Cédula venezolano',
                         'E' => 'Cédula extranjero',
                         'P' => 'Pasaporte'],
                         ]);
                    echo $this->Form->input('identidy_card', ['label' => 'Por favor escriba el número de cédula de identidad (sin puntos): *', 'class' => 'integer']);                    
                    echo $this->Form->input('role', ['label' => 'Rol: *', 'options' => 
                    ['Paciente' => 'Paciente']]);
                    echo $this->Form->input('first_name', ['label' => 'Primer nombre: *']);
                    echo $this->Form->input('second_name', ['label' => 'Segundo nombre:']);
                    echo $this->Form->input('surname', ['label' => 'Primer apellido: *']);
                    echo $this->Form->input('second_surname', ['label' => 'Segundo apellido:']);
                    echo $this->Form->input('sex', ['options' => [null => ' ', 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], 'label' => 'Sexo: *']);
                    echo $this->Form->input('email', ['label' => 'Correo electrónico: *']);
                    echo $this->Form->input('cell_phone', ['label' => 'Número de teléfono celular:']);
                    echo $this->Form->input('profile_photo', array('type' => 'file', 'label' => 'Foto de perfil:'));
                ?>
            </fieldset>
        <?= $this->Form->button(__('Siguiente'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function() 
    {
    	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });

        $('#save-user').click(function(e) 
        {
            $('#email').val($('#email').val().toLowerCase());
        });
    });
</script>