<div class="container">
    <div class="page-header">    
        <?php if($origin == null): ?>
 	        <p><?= $this->Html->link(__('Volver'), ['controller' => 'Patients', 'action' => 'index'], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php elseif ($origin == 'indexBasic'): ?>
            <p><?= $this->Html->link(__('Volver'), ['controller' => 'Patients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php endif; ?>
        <h1>Paciente:&nbsp;<?= h($patient->full_name) ?></h1>
    </div>
    <div class="row">
        <div class="col col-sm-4">
            <?= $this->Html->image('../files/users/profile_photo/' . $user->profile_photo_dir . '/'. $user->profile_photo, ['class' => 'img-thumbnail img-responsive']) ?>
        </div>
        <div class="col col-sm-8">    
            <br />
                <b>Sexo:</b>&nbsp;<?= h($patient->sex) ?>
            <br />
            <br />
                <b>Nro. de identificación:</b>&nbsp;<?= $patient->type_of_identification . '-' . $patient->identidy_card ?>
            <br />
            <br />
                <b>Fecha de nacimiento:</b>&nbsp;<?= h($patient->birthdate) ?>
            <br />
            <br />
                <b>Celular:</b>&nbsp;<?= h($patient->cell_phone) ?>
            <br />
            <br />
                <b>Email:</b>&nbsp;<?= h($patient->email) ?>
            <br />            
            <br />
                <b>País donde reside:</b>&nbsp;<?= h($patient->country) ?>
            <br />            
            <br />
                <b>Estado o provincia:</b>&nbsp;<?= h($patient->province_state) ?>
            <br />            
            <br />
                <b>Ciudad:</b>&nbsp;<?= h($patient->city) ?>
            <br />            
            <br />
                <b>Dirección de habitación:</b>&nbsp;<?= h($patient->address) ?>
            <br />            
            <br />
                <b>Estatus agenda del paciente:</b>&nbsp;<?= h($patient->status_diary_patient) ?>
            <br />            
            <br />         
                <b>Estatus historia clínica del paciente:</b>&nbsp;<?= h($patient->status_history_patient) ?>
            <br />            
            <br />         
                <h3>Datos laborales:</h3>
                <hr size="3" />
                <b>Profesión:</b>&nbsp;<?= h($patient->profession) ?>
            <br />
            <br />
                <b>Empresa o institución donde trabaja:</b>&nbsp;<?= h($patient->workplace) ?>
            <br />
            <br />
                <b>Puesto que ocupa:</b>&nbsp;<?= h($patient->work_address) ?>
            <br />
            <br />
                <b>Teléfono:</b>&nbsp;<?= h($patient->work_phone) ?>
            <br />
            <br />
                <b>Dirección de la empresa o institución:</b>&nbsp;<?= h($patient->work_address) ?>
            <br />
            <br />
                <h3>Datos bancarios:</h3>
                <hr size="3" />
                <b>Número de cuenta bancaria:</b>&nbsp;<?= h($patient->account_number) ?>
            <br />            
            <br />
                <b>Banco:&nbsp;</b><?= h($patient->bank) ?>
            <br />            
            <br />
                <b>Dirección del banco:</b>&nbsp;<?= h($patient->bank_address) ?>
            <br />            
            <br />
                <b>Swift:</b>&nbsp;<?= h($patient->swift_bank) ?>
            <br />            
            <br />
                <b>ABA:</b>&nbsp;<?= h($patient->aba_bank) ?>
            <br />            
            <br />         
                <h3>Datos de la persona de contacto en caso de emergencia:</h3>
                <hr size="3" />
                <b>Nombre:</b>&nbsp;<?= $patient->first_name_emergency . ' ' . $patient->surname_emergency ?>
            <br />
            <br />
                <b>Nro. de identificación:</b>&nbsp;<?= $patient->type_of_identification_emergency . '-' . $patient->identidy_card_emergency ?>
            <br />
            <br />
                <b>Dirección:</b>&nbsp;<?= $patient->address_emergency ?>
            <br />
            <br />
                <b>Email:</b>&nbsp;<?= $patient->email_emergency ?>
            <br />
            <br />
                <b>Teléfono fijo:</b>&nbsp;<?= $patient->landline_emergency ?>
            <br />
            <br />
                <b>Celular:</b>&nbsp;<?= $patient->cell_phone_emergency ?>
            <br />
            <br />
                <h3>Datos del acompañante:</h3>
                <hr size="3" />
                <b>Nombre:</b>&nbsp;<?= $patient->first_name_companion . ' ' . $patient->surname_companion ?>
            <br />
            <br />
                <b>Nro. de identificación:</b>&nbsp;<?= $patient->type_of_identification_companion . '-' . $patient->identidy_card_companion ?>
            <br />
            <br />
                <b>Dirección:</b>&nbsp;<?= $patient->address_companion ?>
            <br />
            <br />
                <b>Email:</b>&nbsp;<?= $patient->email_companion ?>
            <br />
            <br />
                <b>Teléfono fijo:</b>&nbsp;<?= $patient->landline_companion ?>
            <br />
            <br />
                <b>Celular:</b>&nbsp;<?= $patient->cell_phone_companion ?>
            <br />
            <br />
                <h3>Datos del responsable del pago:</h3>
                <hr size="3" />
                <b>¿El paciente paga la cirugía con recursos propios?</b>&nbsp;<?= $patient->payment_own_resources ? __('Sí') : __('No'); ?>
            <br />
            <br />
                <b>Nombre o razón social del responsable del pago:</b>&nbsp;<?= $patient->sponsor ?>
            <br />
            <br />
                <b>Clasificación del responsable del pago:</b>&nbsp;<?= $patient->sponsor_type ?>
            <br />
            <br />
                <b>Nro. de identificación:</b>&nbsp;<?= $patient->sponsor_identification ?>
            <br />
            <br />
                <b>Dirección:</b>&nbsp;<?= $patient->address_sponsor ?>
            <br />
            <br />
                <b>Email:</b>&nbsp;<?= $patient->email_sponsor ?>
            <br />
            <br />
                <b>Teléfono fijo:</b>&nbsp;<?= $patient->landline_sponsor ?>
            <br />
            <br />
                <b>Celular:</b>&nbsp;<?= $patient->cell_phone_sponsor ?>
            <br />
            <br />
        </div>
    </div>
</div>