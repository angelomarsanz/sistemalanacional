<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
 	        <p><?= $this->Html->link(__('Volver'), ['controller' => 'Patients', 'action' => 'index'], ['class' => 'btn btn-sm btn-default']) ?></p>
    		<h2>Registrar datos del paciente:</h2>
        </div>
            <?= $this->Form->create($patient, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('user_id', ['label' => 'Usuario: *'], ['options' => $users]);
                    echo $this->Form->input('first_name', ['label' => 'Primer nombre: *']);
                    echo $this->Form->input('second_name', ['label' => 'Segundo nombre:']);
                    echo $this->Form->input('surname', ['label' => 'Primer apellido: *']);
                    echo $this->Form->input('second_surname', ['label' => 'Segundo apellido:']);
                    echo $this->Form->input('sex', ['options' => [null => ' ', 'Masculino' => 'Masculino', 'Femenino' => 'Femenino'], 'label' => 'Sexo: *']);
                    echo $this->Form->input('birthdate', ['label' => 'Fecha de nacimiento: *']);
                    echo $this->Form->input('type_of_identification', 
                        ['options' => 
                        [null => ' ',
                        'V' => 'Cédula venezolano',
                        'E' => 'Cédula extranjero',
                        'P' => 'Pasaporte'],
                        'label' => 'Tipo de documento de identificación: *']);
                    echo $this->Form->input('identidy_card', ['label' => 'Cédula: *']);
                    echo $this->Form->input('cell_phone', ['label' => 'Número de teléfono celular: *']);
                    echo $this->Form->input('landline', ['label' => 'Teléfono fijo: *']);
                    echo $this->Form->input('email', ['label' => 'Correo electrónico: *']);
                    echo $this->Form->input('country', ['label' => 'País donde reside: *']);
                    echo $this->Form->input('province_state', ['label' => 'Provincia o estado: *']);
                    echo $this->Form->input('city', ['label' => 'Ciudad: *']);
                    echo $this->Form->input('address', ['label' => 'Dirección de habitación: *']); ?>
                    <h3>Datos laborales: </h3>
                    <hr size="3" />
                <?php
                    echo $this->Form->input('profession', ['label' => 'Profesión: *']);
                    echo $this->Form->input('workplace', ['label' => 'Empresa o institución donde trabaja: ']);
                    echo $this->Form->input('professional_position', ['label' => 'Puesto que ocupa: ']);
                    echo $this->Form->input('work_phone', ['label' => 'Teléfono del trabajo: ']);
                    echo $this->Form->input('work_address', ['label' => 'Dirección del lugar donde trabaja: ']); ?>
                    <h3>Datos bancarios: </h3>
                    <hr size="3" />
                <?php
                    echo $this->Form->input('account_number', ['label' => 'Número de cuenta: *']);
                    echo $this->Form->input('bank', ['label' => 'Banco: *']);
                    echo $this->Form->input('bank_address', ['label' => 'Dirección del banco: *']);
                    echo $this->Form->input('swift_bank', ['label' => 'Swift: *']);
                    echo $this->Form->input('aba_bank', ['label' => 'ABA *']); ?>
                    <h3>Datos del sistema multinivel: </h3>
                    <hr size="3" />
                <?php    
                    echo $this->Form->input('supervisor_id', ['label' => 'Supervisor: *', 'options' => $supervisors]);
                    echo $this->Form->input('promoter_id', ['label' => 'Promotor: *', 'options' => $promoters]);
                    echo $this->Form->input('vendor_id', ['label' => 'Vendedor: *', 'options' => $vendors]);
                    echo $this->Form->input('another_half_capture', ['label' => 'Otro medio de captación del paciente:']); ?>
                    <h3>Datos de la persona de contacto en caso de emergencia: </h3>
                    <hr size="3" />
                <?php    
                    echo $this->Form->input('first_name_emergency', ['label' => 'Primer nombre: ']);
                    echo $this->Form->input('second_name_emergency', ['label' => 'Segundo nombre: ']);
                    echo $this->Form->input('surname_emergency', ['label' => 'Primer apellido: ']);
                    echo $this->Form->input('second_surname_emergency', ['label' => 'Segundo apellido: ']);
                    echo $this->Form->input('type_of_identification_emergency', 
                        ['options' => 
                        [null => ' ',
                        'V' => 'Cédula venezolano',
                        'E' => 'Cédula extranjero',
                        'P' => 'Pasaporte'],
                        'label' => 'Tipo de documento de identificación: ']);
                    echo $this->Form->input('identidy_card_emergency', ['label' => 'Cédula: ']);
                    echo $this->Form->input('address_emergency', ['label' => 'Dirección de habitación: ']);
                    echo $this->Form->input('email_emergency', ['label' => 'email: ']);
                    echo $this->Form->input('landline_emergency', ['label' => 'Teléfono fijo: ']);
                    echo $this->Form->input('cell_phone_emergency', ['label' => 'Celular: ']); ?>
                    <h3>Datos del acompañante: </h3>
                    <hr size="3" />
                <?php 
                    echo $this->Form->input('first_name_companion', ['label' => 'Primer nombre: ']);
                    echo $this->Form->input('second_name_companion', ['label' => 'Segundo nombre: ']);
                    echo $this->Form->input('surname_companion', ['label' => 'Primer apellido: ']);
                    echo $this->Form->input('second_surname_companion', ['label' => 'Segundo apellido: ']);
                    echo $this->Form->input('type_of_identification_companion', 
                        ['options' => 
                        [null => ' ',
                        'V' => 'Cédula venezolano',
                        'E' => 'Cédula extranjero',
                        'P' => 'Pasaporte'],
                        'label' => 'Tipo de documento de identificación: ']);
                    echo $this->Form->input('identidy_card_companion', ['label' => 'Cédula: ']);
                    echo $this->Form->input('address_companion', ['label' => 'Dirección de habitación: ']);
                    echo $this->Form->input('email_companion', ['label' => 'email: ']);
                    echo $this->Form->input('landline_companion', ['label' => 'Teléfono fijo: ']);
                    echo $this->Form->input('cell_phone_companion', ['label' => 'Celular: ']); ?>
                    <h3>Datos de la persona o institución responsable del pago de la cirugía: </h3>
                    <hr size="3" />
                <?php
                    echo $this->Form->input('payment_own_resources', ['label' => '¿La cirugía la paga el paciente con recursos propios?:']);
                    echo $this->Form->input('sponsor', ['label' => 'Nombre o razón social del responsable del pago: ']);
                    echo $this->Form->input('sponsor_type', 
                        ['options' => 
                        [null => ' ',
                        'Persona natural' => 'Persona natural',
                        'Aseguradora' => 'Aseguradora',
                        'Otro tipo de empresa o institución' => 'Otro tipo de empresa o institución'],
                        'label' => 'Clasificación del responsable del pago: ']);
                    echo $this->Form->input('sponsor_identification', ['label' => 'Cédula o RIF o RUC:']);
                    echo $this->Form->input('address_sponsor', ['label' => 'Dirección: ']);
                    echo $this->Form->input('email_sponsor', ['label' => 'email: ']);
                    echo $this->Form->input('landline_sponsor', ['label' => 'Teléfono fijo: ']);
                    echo $this->Form->input('cell_phone_sponsor', ['label' => 'Celular: ']);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Guardar'), ['id' => 'save-supervisor', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>