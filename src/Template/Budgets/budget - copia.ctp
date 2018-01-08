<div class="row">
    <div class="col-md-4">
    	<div class="page-header">
            <p><?= $this->Html->link(__('Volver'), ['controller' => 'Diarypatients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>
    		<h2>Enviar presupuesto de: <?= $budget->surgery ?>:</h2>
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
			<input id="name-promoter" type="hidden" value=<?= $promoter->surname . ' ' . $promoter->first_name ?>>
			<input id="cell-promoter" type="hidden" value=<?= $promoter->cell_phone ?>>
			<input id="email-promoter" type="hidden" value=<?= $promoter->email ?>>
			<input id="controller" type="hidden" value=<?= $controller ?>>
			<input id="action" type="hidden" value=<?= $action ?>>
			<?php
				echo $this->Form->input('surgery', ['label' => 'Servicio médico: *', 'required' => 'true', 'placeholder' => 'Escriba el servicio médico']);
				echo $this->Form->input('coin', 
					['label' => 'Moneda en que se emitirá el presupuesto: ', 'required' => 'true', 'options' => 
					[null => ' ',
					'BOLIVAR' => 'BOLIVAR',
					'DOLLAR' => 'DOLLAR']]);
			?>
		</div>
    </div>
</div>
<script>
    function surgery(id) 
    {
		idService = id;
	}
    $(document).ready(function()
    { 
        $(".decimal-2-places").numeric({ decimalPlaces: 2 });
		
		$('#surgery').autocomplete(
		{
			source:'<?php echo Router::url(array("controller" => "Services", "action" => "findServiceCost")); ?>',
			minLength: 3,             
			select: function( event, ui ) {
				surgery(ui.item.id);
			  }
		});
	
		$('#coin').change(function(e)
		{
			e.preventDefault();
			if (idService == 0)
			{
				alert('Debe especificar el servicio para el presupuesto');
				$('#surgery').css('background-color', '#FFE4C4');
				$('#surgery').focus();
			}
			else
			{
				$.redirect('/sln/budgets/addBudget', { idUser : $('#id-user').val(), idPatient : $('#id-patient').val(), idService : idService, service : $('#surgery').val(), 
					firstName : $('#first-name').val(), surname : $('#surname').val(), identificationPatient : $('#identification-patient').val(), cellPatient : $('#cell-patient').val(),
					emailPatient : $('#email-patient').val(), addressPatient : $('#address-patient').val(), countryPatient : $('#country-patient').val(),   
					namePromoter : $('#name-promoter').val(), cellPromoter : $('#cell-promoter').val(), emailPromoter : $('#email-promoter').val(),
					coin : $('#name-promoter').val(), controller : $('#controller').val(), action : $('#action').val() }); 
			}
		});		
    });
</script>