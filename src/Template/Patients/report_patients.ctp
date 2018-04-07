<style>
@media screen
{
    .volver 
    {
        display:scroll;
        position:fixed;
        top: 15%;
        left: 50px;
        opacity: 0.5;
    }
    .cerrar 
    {
        display:scroll;
        position:fixed;
        top: 15%;
        left: 95px;
        opacity: 0.5;
    }
    .menumenos
    {
        display:scroll;
        position:fixed;
        bottom: 5%;
        right: 1%;
        opacity: 0.5;
        text-align: right;
    }
    .menumas 
    {
        display:scroll;
        position:fixed;
        bottom: 5%;
        right: 1%;
        opacity: 0.5;
        text-align: right;
    }
    .noverScreen
    {
      display:none
    }
}
@media print 
{
    .nover 
    {
      display:none
    }
    .saltopagina
    {
        display:block; 
        page-break-before:always;
    }
}
</style>
<?php if ($swImpresion == 0): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>Reporte de pacientes</h2>
				<h4>Por favor seleccione las columnas a imprimir</h4>
			</div>
			<?= $this->Form->create() ?>
				<fieldset>	
					<div id="columns-report" class="row">
						<div class="col-md-12">
							<h4>Datos del paciente</h4>
							<div class="row">
								<div class="col-md-4">						
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.sex]"> Sexo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.birthdate]"> Fecha de nacimiento</p>
							
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.identidy_card]"> Cédula/pasaporte</p>

									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.cell_phone]"> Celular</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.landline]"> Teléfono fijo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.email]"> Email</p>

									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.country]"> País</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.province_state]"> Provincia o estado</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.city]"> ciudad</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.address]"> Dirección</p>									
									
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.profession]"> Profesión</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.work_phone]"> Teléfono trabajo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.workplace]"> Lugar de trabajo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.work_address]"> Dirección de trabajo</p>	

								</div>
								<div class="col-md-4">
									<h5>Persona de contacto en caso de emergencia:</h5>
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-11">											
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.full_name_emergency]"> Nombre</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.cell_phone_emergency]"> Celular</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.landline_emergency]"> Teléfono fijo</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.email_emergency]"> Email</p>
										</div>
									</div>
									<br />
									<h5>Datos del acompañante:</h5>
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-11">											
												<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.full_name_companion]"> Nombre</p>
												<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.cell_phone_companion]"> Celular</p>
										</div>
									</div>	
								</div>
								<div class="col-md-4">
									<h5>Datos del responsable del pago de la cirugía:</h5>
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-11">							
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.sponsor]"> Nombre</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.sponsor_type]"> Clasificación del responsable del pago</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.sponsor_identification]"> Cédula/Pasaporte/RIF/RUC</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.cell_phone_sponsor]"> Celular</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.landline_sponsor]"> Teléfono fijo</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.email_sponsor]"> Email</p>
											<p><input class="column-mark" type="checkbox" name="columnsReport[Patients.address_sponsor]"> Dirección</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<br /> 					
				<div id="menu-menos" class="menumenos nover">
					<p>
					<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
					</p>
				</div>
				<div id="menu-mas" style="display:none;" class="menumas nover">
					<p>
						<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'indexPatientUser'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
						<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
						
						<button id="marcar-todos" class="glyphicon icon-checkbox-checked btn btn-danger" title="Marcar todos" style="padding: 8px 12px 10px 12px;"></button>

						<button id="desmarcar-todos" class="glyphicon icon-checkbox-unchecked btn btn-danger" title="Desmarcar todos" style="padding: 8px 12px 10px 12px;"></button>

						<?= $this->Form->button(__(''), ['id' => 'generar-reporte', 'title' => 'Generar reporte', 'class' => 'glyphicon glyphicon-th-list btn btn-danger']) ?>			
						<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
					</p>
				</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
<?php else: ?>
	<?php 
		$venezuela = 0; 
		$otherCountry = 0;	
		foreach ($patientsUsers as $patientsUser): 
			$countryTrim = trim($patientsUser->country);            
			$country = strtoupper($countryTrim);
			if ($country == 'VENEZUELA'):
				$venezuela++;
			else:
				$otherCountry++;
			endif;
		endforeach;
	?>
	<br />
	<br />
	<div>
		<?php $accountRecords = 0; ?>
		<?php foreach ($patientsUsers as $patientsUser): ?>
			<?php if ($accountRecords == 0): ?>
				<?php $accountRecords++; ?>
				<table id="patients-users" name="patients-users" class="table noverScreen">
					<thead>
						<tr>
							<th></th>
							<th><b>Cirugías La Nacional, C.A.</b></th>
						</tr>
						<tr>
							<th></th>
							<th>Reporte de pacientes</th>
						</tr>
						<tr>
							<th></th>
							<th><?= 'Fecha: ' . $currentDate->format('d-m-Y') ?></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Resumen:</b></th>
						</tr>		
						<tr>
							<th></th>
							<th><?= 'Pacientes de venezuela: ' . $venezuela ?></th>
						</tr>
						<tr>
							<th></th>
							<th><?= 'Pacientes de otros países: ' . $otherCountry ?></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th></th>
							<th><b>Detalle:</b></th>
						</tr>
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th scope="col"><b>Nro.</b></th>
							<?php if ($role == 'Desarrollador del sistema'): ?>
								<th scope="col"><b>id</b></th>
							<?php endif; ?>
							<th scope="col"><b>Nombre</b></th>
							<th scope="col"><b>Usuario</b></th>
							<th scope="col" class=<?= $arrayMark['Users.sex'] ?>><b>Sexo</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.birthdate'] ?>><b>Fecha de nacimiento</b></th>
							<th scope="col" class=<?= $arrayMark['Users.identidy_card'] ?>><b>Cédula/pasaporte</b></th>
							<th scope="col" class=<?= $arrayMark['Users.cell_phone'] ?>><b>Celular</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.landline'] ?>><b>Teléfono fijo</b></th>
							<th scope="col" class=<?= $arrayMark['Users.email'] ?>><b>Email</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.country'] ?>><b>País</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.province_state'] ?>><b>Provincia o estado</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.city'] ?>><b>Ciudad</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.address'] ?>><b>Dirección</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.profession'] ?>><b>Profesión</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.work_phone'] ?>><b>Teléfono trabajo</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.workplace'] ?>><b>Lugar de trabajo</b></th>						
							<th scope="col" class=<?= $arrayMark['Patients.work_address'] ?>><b>Dirección de trabajo</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.full_name_emergency'] ?>><b>Nombre contacto caso emergencia</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.cell_phone_emergency'] ?>><b>Teléfono (emergencia)</b></th>							
							<th scope="col" class=<?= $arrayMark['Patients.landline_emergency'] ?>><b>Teléfono fijo (emergencia)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.email_emergency'] ?>><b>Email contacto (emergencia)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.full_name_companion'] ?>><b>Nombre del acompañante</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.cell_phone_companion'] ?>><b>Teléfono acompañante</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.sponsor'] ?>><b>Nombre responsable pago cirugía</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.sponsor_type'] ?>><b>Clasificación del responsable del pago</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.sponsor_identification'] ?>><b>Identificación (responsable)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.cell_phone_sponsor'] ?>><b>Celular (responsable)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.landline_sponsor'] ?>><b>Teléfono fijo (responsable)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.email_sponsor'] ?>><b>Email (responsable)</b></th>
							<th scope="col" class=<?= $arrayMark['Patients.address_sponsor'] ?>><b>Dirección (responsable)</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $accountRecords ?></td>
							<?php if ($role == 'Desarrollador del sistema'): ?>
								<td><?= $patientsUser->user->id ?></td>
							<?php endif; ?>
							<td><?= $patientsUser->user->full_name ?></td>
							<td><?= $patientsUser->user->username ?></td>
							<td class=<?= $arrayMark['Users.sex'] ?>><?= $patientsUser->user->sex ?></td>
							<?php if (isset($patientsUser->birthdate)): ?>
								<td class=<?= $arrayMark['Patients.birthdate'] ?>><?= $patientsUser->birthdate->format('d-m-Y') ?></td>
							<?php else: ?>
								<td class=<?= $arrayMark['Patients.birthdate'] ?>></td>
							<?php endif; ?>
							<td class=<?= $arrayMark['Users.identidy_card'] ?>><?= $patientsUser->user->type_of_identification . '-' . $patientsUser->user->identidy_card ?></td>
							<td class=<?= $arrayMark['Users.cell_phone'] ?>><?= $patientsUser->user->cell_phone ?></td>
							<td class=<?= $arrayMark['Patients.landline'] ?>><?= $patientsUser->landline ?></td>
							<td class=<?= $arrayMark['Users.email'] ?>><?= $patientsUser->user->email ?></td>
							<td class=<?= $arrayMark['Patients.country'] ?>><?= $patientsUser->country ?></td>
							<td class=<?= $arrayMark['Patients.province_state'] ?>><?= $patientsUser->province_state ?></td>
							<td class=<?= $arrayMark['Patients.city'] ?>><?= $patientsUser->city ?></td>
							<td class=<?= $arrayMark['Patients.address'] ?>><?= $patientsUser->address ?></td>
							<td class=<?= $arrayMark['Patients.profession'] ?>><?= $patientsUser->profession ?></td>
							<td class=<?= $arrayMark['Patients.work_phone'] ?>><?= $patientsUser->work_phone ?></td>
							<td class=<?= $arrayMark['Patients.workplace'] ?>><?= $patientsUser->workplace ?></td>
							<td class=<?= $arrayMark['Patients.work_address'] ?>><?= $patientsUser->address ?></td>
							<td class=<?= $arrayMark['Patients.full_name_emergency'] ?>><?= $patientsUser->surname_emergency . ' ' . $patientsUser->first_name_emergency ?></td>
							<td class=<?= $arrayMark['Patients.cell_phone_emergency'] ?>><?= $patientsUser->cell_phone_emergency ?></td>
							<td class=<?= $arrayMark['Patients.landline_emergency'] ?>><?= $patientsUser->landline_emergency ?></td>
							<td class=<?= $arrayMark['Patients.email_emergency'] ?>><?= $patientsUser->email_emergency ?></td>
							<td class=<?= $arrayMark['Patients.full_name_companion'] ?>><?= $patientsUser->surname_companion . ' ' . $patientsUser->first_name_companion ?></td>
							<td class=<?= $arrayMark['Patients.cell_phone_companion'] ?>><?= $patientsUser->cell_phone_companion ?></td>					
							<td class=<?= $arrayMark['Patients.sponsor'] ?>><?= $patientsUser->sponsor ?></td>
							<td class=<?= $arrayMark['Patients.sponsor_type'] ?>><?= $patientsUser->sponsor_type ?></td>
							<td class=<?= $arrayMark['Patients.sponsor_identification'] ?>><?= $patientsUser->sponsor_identification ?></td>							
							<td class=<?= $arrayMark['Patients.cell_phone_sponsor'] ?>><?= $patientsUser->cell_phone_sponsor ?></td>
							<td class=<?= $arrayMark['Patients.landline_sponsor'] ?>><?= $patientsUser->landline_sponsor ?></td>
							<td class=<?= $arrayMark['Patients.email_sponsor'] ?>><?= $patientsUser->email_sponsor ?></td>
							<td class=<?= $arrayMark['Patients.address_sponsor'] ?>><?= $patientsUser->address_sponsor ?></td>
						</tr>
			<?php else: ?>
				<?php $accountRecords++; ?>
				<tr>
					<td><?= $accountRecords ?></td>
					<?php if ($role == 'Desarrollador del sistema'): ?>
						<td><?= $patientsUser->user->id ?></td>
					<?php endif; ?>
					<td><?= $patientsUser->user->full_name ?></td>
					<td><?= $patientsUser->user->username ?></td>
					<td class=<?= $arrayMark['Users.sex'] ?>><?= $patientsUser->user->sex ?></td>
					<?php if (isset($patientsUser->birthdate)): ?>
						<td class=<?= $arrayMark['Patients.birthdate'] ?>><?= $patientsUser->birthdate->format('d-m-Y') ?></td>
					<?php else: ?>
						<td class=<?= $arrayMark['Patients.birthdate'] ?>></td>
					<?php endif; ?>
					<td class=<?= $arrayMark['Users.identidy_card'] ?>><?= $patientsUser->user->type_of_identification . '-' . $patientsUser->user->identidy_card ?></td>
					<td class=<?= $arrayMark['Users.cell_phone'] ?>><?= $patientsUser->user->cell_phone ?></td>
					<td class=<?= $arrayMark['Patients.landline'] ?>><?= $patientsUser->landline ?></td>
					<td class=<?= $arrayMark['Users.email'] ?>><?= $patientsUser->user->email ?></td>
					<td class=<?= $arrayMark['Patients.country'] ?>><?= $patientsUser->country ?></td>
					<td class=<?= $arrayMark['Patients.province_state'] ?>><?= $patientsUser->province_state ?></td>
					<td class=<?= $arrayMark['Patients.city'] ?>><?= $patientsUser->city ?></td>
					<td class=<?= $arrayMark['Patients.address'] ?>><?= $patientsUser->address ?></td>
					<td class=<?= $arrayMark['Patients.profession'] ?>><?= $patientsUser->profession ?></td>
					<td class=<?= $arrayMark['Patients.work_phone'] ?>><?= $patientsUser->work_phone ?></td>
					<td class=<?= $arrayMark['Patients.workplace'] ?>><?= $patientsUser->workplace ?></td>
					<td class=<?= $arrayMark['Patients.work_address'] ?>><?= $patientsUser->address ?></td>
					<td class=<?= $arrayMark['Patients.full_name_emergency'] ?>><?= $patientsUser->surname_emergency . ' ' . $patientsUser->first_name_emergency ?></td>
					<td class=<?= $arrayMark['Patients.cell_phone_emergency'] ?>><?= $patientsUser->cell_phone_emergency ?></td>
					<td class=<?= $arrayMark['Patients.landline_emergency'] ?>><?= $patientsUser->landline_emergency ?></td>
					<td class=<?= $arrayMark['Patients.email_emergency'] ?>><?= $patientsUser->email_emergency ?></td>
					<td class=<?= $arrayMark['Patients.full_name_companion'] ?>><?= $patientsUser->surname_companion . ' ' . $patientsUser->first_name_companion ?></td>
					<td class=<?= $arrayMark['Patients.cell_phone_companion'] ?>><?= $patientsUser->cell_phone_companion ?></td>					
					<td class=<?= $arrayMark['Patients.sponsor'] ?>><?= $patientsUser->sponsor ?></td>
					<td class=<?= $arrayMark['Patients.sponsor_type'] ?>><?= $patientsUser->sponsor_type ?></td>
					<td class=<?= $arrayMark['Patients.sponsor_identification'] ?>><?= $patientsUser->sponsor_identification ?></td>							
					<td class=<?= $arrayMark['Patients.cell_phone_sponsor'] ?>><?= $patientsUser->cell_phone_sponsor ?></td>
					<td class=<?= $arrayMark['Patients.landline_sponsor'] ?>><?= $patientsUser->landline_sponsor ?></td>
					<td class=<?= $arrayMark['Patients.email_sponsor'] ?>><?= $patientsUser->email_sponsor ?></td>
					<td class=<?= $arrayMark['Patients.address_sponsor'] ?>><?= $patientsUser->address_sponsor ?></td>							
				</tr>
			<?php endif; ?>
		<?php endforeach ?>
		</tbody>
		</table>
		<a href='#' id="excel" title="EXCEL" class='btn btn-success'>Descargar reporte en excel</a>
	</div>
	<div id="menu-menos" class="menumenos nover">
		<p>
		<a href="#" id="mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
		</p>
	</div>
	<div id="menu-mas" style="display:none;" class="menumas nover">
		<p>
			<a href="/sln/users/indexPatientUser" id="volver" title="Volver" class='glyphicon glyphicon-chevron-left btn btn-danger'></a>
			<a href="/sln/users/wait" id="cerrar" title="Cerrar vista" class='glyphicon glyphicon-remove btn btn-danger'></a>
			<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
		</p>
	</div>
<?php endif; ?>
<script>
$(document).ready(function(){ 
    $('#mas').on('click',function()
    {
        $('#menu-menos').hide();
        $('#menu-mas').show();
    });
    
    $('#menos').on('click',function()
    {
        $('#menu-mas').hide();
        $('#menu-menos').show();
    });
    
    $("#excel").click(function(){
        
        $("#patients-users").table2excel({
    
            exclude: ".noExl",
        
            name: "patients_users",
        
            filename: $('#patients-users').attr('name') 
    
        });
    });
	
	$('#marcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', true);
		});
	});
	
	$('#desmarcar-todos').click(function(e)
	{			
		e.preventDefault();
		
		$(".column-mark").each(function (index) 
		{ 
			$(this).attr('checked', false);
		});
	});
	
});
</script>