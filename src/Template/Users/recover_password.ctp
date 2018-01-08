<div class="row">
    <div class="col-md-6">
    	<div class="page-header">
			<h4>Por favor escriba su correo electrónico y seleccione su rol. Se le enviará un correo con su usuario y nueva contraseña</h4>
        </div>
	</div>
</div>
<div class="row">
    <div class="col-md-4">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
				<?php 
                    echo $this->Form->input('email', ['label' => 'Correo electrónico: *']);
					echo $this->Form->input('role', ['label' => 'Rol: *', 'options' => 
							[null => '',
							'Administrador del sistema' => 'Administrador del sistema',
							'Auditor interno' => 'Auditor interno',
							'Auditor externo' => 'Auditor externo',
							'Call center' => 'Call center',
							'Coordinador(a)' => 'Coordinador(a)',
							'Desarrollador del sistema' => 'Desarrollador del sistema',
							'Promotor(a)' => 'Promotor(a)',
							'Promotor(a) independiente' => 'Promotor(a) independiente',
							'Titular del sistema' => 'Titular del sistema']]);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Enviar correo'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
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