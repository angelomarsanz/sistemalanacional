<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>
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
			<input id="id-promoter" type="hidden" value=<?= $promoter->id ?>>
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
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $user->id, 'Users', 'indexPatientUser', $promoter->id], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
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