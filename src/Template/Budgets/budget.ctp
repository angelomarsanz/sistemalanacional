<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>
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
<div class="row">
    <div class="col-md-12">
		<input type="hidden" id="ambiente" value=<?= $system->logo ?>>
    	<div class="page-header">
    		<h2>Enviar presupuesto actualizado a paciente: <?= $user->full_name ?></h2>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<p><b>Presupuesto solicitado originalmente: </b><?= $previousSurgery ?></P>
	</div>
	<div class="col-md-6">
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<?php
			echo $this->Form->input('surgery', ['label' => 'Por favor seleccione el servicio médico: *', 'required' => 'true', 'options' => $services]);
		?>
		<p id="response-messages"></p>
	</div>
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
				<p>Budget / Presupuesto Nro. <spam id="number-budget"><?= $budget->number_budget ?> </spam></p>
				<p>Start Date / Fecha de emisión: <spam id="broadcast-date"><?= $budget->application_date->format('d-m-Y') ?></spam></p>
				<p>Expiration date / Fecha de vencimiento: <spam id="expiration-date"><?= $budget->expiration_date->format('d-m-Y') ?></spam></p>
				<p>Service requested / Servicio requerido: <spam id="surgery-required"><?= $budget->surgery ?></spam></p>
				<BR />
				<h5>--------------- DETAILS / DETALLES ---------------------------------</h5>
				<div id="itemes-surgery">
				<?= $itemes ?>
				</div>
				<BR />
				<?php if (strtoupper($budget->patient->country) == 'VENEZUELA'): ?>
					<h4>GRAND TOTAL / TOTAL GENERAL Bs.S <spam id="price"><?= number_format($budget->amount_budget, 2, ",", ".") ?></spam></h4>
				<?php else: ?>
					<h4>GRAND TOTAL / TOTAL GENERAL $ (USD) <spam id="price"><?= number_format($budget->amount_budget, 2, ".", ",") ?></spam></h4>			
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
<div class="row">
	<div class="col-md-4">
		<button id="aceptar" type="button" title="Enviar" class="glyphicon glyphicon-floppy-disk btn btn-success"></button>
		<?php if ($controller == 'Users' && $action == 'viewGlobal'): ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $user->id, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>
		<?php elseif ($controller == 'Budgets' && $action == 'mainBudget'): ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idBudget], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>				
		<?php else: ?>
			<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-remove btn btn-primary', 'title' => 'Cancelar']) ?>			
		<?php endif; ?>	
	</div>
</div>
<script>
	function getFormattedDate(date) 
	{
		dateTMP = new Date(date);
		
		year = dateTMP.getFullYear();

		month = (1 + dateTMP.getMonth()).toString();
		month = month.length > 1 ? month : '0' + month;

		day = dateTMP.getDate().toString();
		day = day.length > 1 ? day : '0' + day;
	  
		return day + '/' + month + '/' + year;
	}	
    $(document).ready(function()
    { 
        $(".decimal-2-places").numeric({ decimalPlaces: 2 });
		
		$('#aceptar').click(function(e)
		{
			e.preventDefault();
			if ($('#surgery').val() == 107)
			{
				alert('Por favor seleccione un servicio médico antes de enviar el presupuesto');
				$('#surgery').css('background-color', '#F5F5DC'); 
			}
			else
			{
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
			}
		});
        $('#surgery').change(function(e) 
        {
            e.preventDefault();
			
			if ($('#surgery').val() != 107)
			{					
				$.post('<?= Router::url(["controller" => "Services", "action" => "ajaxService"]); ?>', {"id" : $('#surgery').val()}, null, "json")				
                     
				.done(function(response) 
				{
					if (response.success) 
					{					
						serviceDescriptionP = response.data.serviceDescription;
						costBolivarsP = response.data.costBolivars;
						costDollarsP = response.data.costDollars;
						itemesP = response.data.itemes;

						$('#number-budget').html("No asignado aún").css('background-color', '#F5F5DC');
						$('#surgery-required').html(serviceDescriptionP).css('background-color', '#F5F5DC');
						$('#itemes-surgery').html(itemesP).css('background-color', '#F5F5DC');
						
						broadcastDate = getFormattedDate(response.data.dateBudget); 
						expirationDate = getFormattedDate(response.data.expirationDate); 
																	
						$('#broadcast-date').html(broadcastDate).css('background-color', '#F5F5DC');
						$('#expiration-date').html(expirationDate).css('background-color', '#F5F5DC');
											
						if ('<?= strtoupper($budget->patient->country) ?>' == 'VENEZUELA')
						{
							$("#price").html(costBolivarsP.toFixed(2).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1,$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".")).css('background-color', '#F5F5DC');
						}
						else
						{
							$("#price").html(costDollarsP.toFixed(2).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")).css('background-color', '#F5F5DC');
						}
					} 
					else 
					{
						$("#response-messages").html('El servicio requerido no fue encontrado');
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) 
				{
					$("#response-messages").html("Algo falló en la búsqueda del servicio: " + textStatus);
				});  
			}
		});
    });
</script>