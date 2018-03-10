<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>
<div class="row">
    <div class="col-md-4">
    	<div class="page-header">
            <p><?= $this->Html->link(__('Volver'), ['controller' => $controller, 'action' => $action], ['class' => 'btn btn-sm btn-default']) ?></p>
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
			<?php
				echo $this->Form->input('surgery', ['label' => 'Servicio médico: *', 'required' => 'true', 'options' => $services]);
			?>
		</div>
    </div>
</div>
<script>
    $(document).ready(function()
    { 
        $(".decimal-2-places").numeric({ decimalPlaces: 2 });
		
		$('#surgery').change(function(e)
		{
			e.preventDefault();
			$.redirect('/sln/budgets/addBudget', { idUser : $('#id-user').val(), idPatient : $('#id-patient').val(), service : $('#surgery').val(), 
				firstName : $('#first-name').val(), surname : $('#surname').val(), identificationPatient : $('#identification-patient').val(), cellPatient : $('#cell-patient').val(),
				emailPatient : $('#email-patient').val(), addressPatient : $('#address-patient').val(), countryPatient : $('#country-patient').val(),   
				surnamePromoter : $('#surname-promoter').val(), namePromoter : $('#name-promoter').val(), cellPromoter : $('#cell-promoter').val(), emailPromoter : $('#email-promoter').val(),
				coin : $('#coin').val(), controller : $('#controller').val(), action : $('#action').val() }); 
		});		
    });
</script>