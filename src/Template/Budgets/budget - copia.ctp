<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>
<div class="container">
    <div class="page-header">    
        <h2>Presupuesto enviado al paciente: <?= $user->surname . ' ' . $user->first_name ?></h2>
    </div>
    <div class="row">
        <div class="col col-sm-12">
			<?php if ($budget->initial_budget == null): ?>
				<?php if (substr($budget->number_budget, 0, 3) == 'APP'): ?>			
					<h3>Cirugías La Nacional, C.A.</h3>
					<p>Rif: J-40024519-2</p>
					<p>Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
					<p>+58-0241-835-2284</p>
					<br />
					<h5>---------------- CLIENT DATA / DATOS DEL CLIENTE -----------------</h5>
					<p>Name / Nombre / Razón social: <?= $user->surname . ' ' . $user->first_name ?></p>
					<?php if ($promoter->surname . ' ' . $promoter->first_name != 'Sitio  Web '): ?>
						<p>Promoter assigned / Promotor asignado: <?= $promoter->surname . ' ' . $promoter->first_name ?></p>
						<p>Promoter phone / Teléfono promotor: <?= $promoter->cell_phone ?></p>
						<p>Promoter email / Correo del promotor: <?= $promoter->email ?></p>
					<?php endif; ?>			
					<p>Phone / Teléfono: <?= $budget->patient->user->cell_phone ?></p>
					<p>Address / Dirección: <?= $budget->patient->address ?></p>
					<p>Country / país: <?= $budget->patient->country ?></p>
					<br />
					<h5>--------------- BUDGET / PRESUPUESTO ------------------------------</h5>
					<p>Budget / Presupuesto Nro. <?= $budget->number_budget ?> </p>
					<p>Start Date / Fecha de emisión: <?= $budget->application_date->format('d-m-Y') ?></p>
					<p>Expiration date / Fecha de vencimiento: <?= $budget->expiration_date->format('d-m-Y') ?></p>
					<p>Service requested / Servicio requerido: <?= $budget->surgery ?></p>
					<BR />
					<h5>--------------- DETAILS / DETALLES ---------------------------------</h5>
					<?= $itemes ?>
					<BR />
					<?php if (strtoupper($budget->patient->country) == 'VENEZUELA'): ?>
						<h4>GRAND TOTAL / TOTAL GENERAL Bs. <?= number_format($budget->amount_budget, 2, ",", ".") ?></h4>
					<?php else: ?>
						<h4>GRAND TOTAL / TOTAL GENERAL $ (USD) <?= number_format($budget->amount_budget, 2, ".", ",") ?></h4>			
					<?php endif; ?>
					<br />
					<p>Al aprobar el presente presupuesto y completar el proceso de compra y pago
					del mismo, usted confirma que leyó y aceptó los Términos y Condiciones de 
					nuestros servicios</p>				
					<br />
				<?php else: ?>
					<p style="color: red;"><b>*** Aún no se ha enviado el presupuesto al paciente ***</b></p>
				<?php endif; ?>
			<?php else: ?>
				<?= $this->Html->image('/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'img-thumbnail img-responsive']) ?>
			<?php endif; ?>
		</div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
		<input type="hidden" id="ambiente" value=<?= $system->logo ?>>
    	<div class="page-header">
    		<h2>Enviar presupuesto actualizado</h2>
        </div>
		<div>
			<input id="id-user" type="hidden" value=<?= $user->id ?>>
			<input id="first-name" type="hidden" value=<?= $user->first_name ?>>
			<input id="surname" type="hidden" value=<?= $user->surname ?>>
			<input id="identification-patient" type="hidden" value=<?= $user->type_of_identification . '-' . $user->identidy_card ?>>
			<input id="cell-patient" type="hidden" value=<?= $user->cell_phone ?>>
			<input id="address-patient" type="hidden" value=<?= $patient->address ?>>
			<input id="country-patient" type="hidden" value=<?= $patient->country ?>>
			<input id="email-patient" type="hidden" value=<?= $user->email ?>>
			<input id="id-patient" type="hidden" value=<?= $patient->id ?>>
			<input id="surname-promoter" type="hidden" value=<?= $promoter->surname ?>>
			<input id="name-promoter" type="hidden" value=<?= $promoter->first_name ?>>
			<input id="cell-promoter" type="hidden" value=<?= $promoter->cell_phone ?>>
			<input id="email-promoter" type="hidden" value=<?= $promoter->email ?>>
			<?php if (strtoupper($patient->country) == 'VENEZUELA'): ?>
				<input id="coin" type="hidden" value="BOLIVAR">
			<?php else: ?>
				<input id="coin" type="hidden" value="DOLLAR">
			<?php endif; ?>
			<input id="controller" type="hidden" value=<?= $controller ?>>
			<input id="action" type="hidden" value=<?= $action ?>>
			<input id="id-budget" type="hidden" value=<?= $idBudget ?>>
			<input id="id-promoter" type="hidden" value=<?= $idPromoter ?>>
			<p><b>Paciente:</b></p>
			<p><?= $user->full_name ?></p>
			<p><b>Presupuesto solicitado originalmente:</b></P>
			<p><?= $previousSurgery ?></p>
			<br />
			<?php
				echo $this->Form->input('surgery', ['label' => 'Por favor seleccione el servicio médico: *', 'required' => 'true', 'options' => $services]);
			?>
			<button id="aceptar" type="button" title="Guardar" class="glyphicon glyphicon-floppy-disk btn btn-success"></button>
			<?php if ($controller == 'Users' && $action == 'viewGlobal'): ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $user->id, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
			<?php elseif ($controller == 'Budgets' && $action == 'mainBudget'): ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idBudget], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>				
			<?php else: ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>			
			<?php endif; ?>	
		</div>
    </div>
</div>
<script>
    $(document).ready(function()
    { 
        $(".decimal-2-places").numeric({ decimalPlaces: 2 });
		
		$('#aceptar').click(function(e)
		{
			e.preventDefault();
			
			if ($('#ambiente').val() == 'Producción')
			{
				$.redirect('/sln/budgets/addBudget', { idUser : $('#id-user').val(), idPatient : $('#id-patient').val(), service : $('#surgery').val(), 
					firstName : $('#first-name').val(), surname : $('#surname').val(), identificationPatient : $('#identification-patient').val(), cellPatient : $('#cell-patient').val(),
					emailPatient : $('#email-patient').val(), addressPatient : $('#address-patient').val(), countryPatient : $('#country-patient').val(),   
					surnamePromoter : $('#surname-promoter').val(), namePromoter : $('#name-promoter').val(), cellPromoter : $('#cell-promoter').val(), emailPromoter : $('#email-promoter').val(),
					coin : $('#coin').val(), controller : $('#controller').val(), action : $('#action').val(), idPromoter : $('#id-promoter').val(), idBudget : $('#id-budget').val() });
			}
			else
			{
				$.redirect('/dsln/budgets/addBudget', { idUser : $('#id-user').val(), idPatient : $('#id-patient').val(), service : $('#surgery').val(), 
					firstName : $('#first-name').val(), surname : $('#surname').val(), identificationPatient : $('#identification-patient').val(), cellPatient : $('#cell-patient').val(),
					emailPatient : $('#email-patient').val(), addressPatient : $('#address-patient').val(), countryPatient : $('#country-patient').val(),   
					surnamePromoter : $('#surname-promoter').val(), namePromoter : $('#name-promoter').val(), cellPromoter : $('#cell-promoter').val(), emailPromoter : $('#email-promoter').val(),
					coin : $('#coin').val(), controller : $('#controller').val(), action : $('#action').val(), idPromoter : $('#id-promoter').val(), idBudget : $('#id-budget').val() });			
			}
		});		
    });
</script>