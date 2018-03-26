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
				<h2>Reporte de usuarios</h2>
				<h4>Por favor seleccione las columnas a imprimir</h4>
			</div>
			<?= $this->Form->create() ?>
				<fieldset>	
					<div id="columns-report" class="row">
						<div class="col-md-12">
							<h4>Datos de la comisión</h4>
							<div class="row">
								<div class="col-md-4">
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.sex]"> Sexo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.identidy_card]"> Cédula/pasaporte</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.rif]"> RIF</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.cell_phone]"> Celular</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.landline]"> Teléfono fijo</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Users.email]"> Email</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.address]"> Dirección de habitación</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.birthdate]"> Fecha de nacimiento</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.place_of_birth]"> Lugar de nacimiento</p>
								</div>
								<div class="col-md-4">
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.country_of_birth]"> País de nacimiento</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.degree_instruction]"> Grado de instrucción</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.payment_method]"> Método de pago</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.account_bank]"> Cuenta</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.account_type]"> Tipo de cuenta</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.bank]"> Banco</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.bank_address]"> Dirección</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.swif_bank]"> Swif banco</p>
									<p><input class="column-mark" type="checkbox" name="columnsReport[Employees.aba_bank]"> Aba banco</p>					
								</div>
								<div class="col-md-4">							
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
						<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'index'], ['id' => 'volver', 'class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
						<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['id' => 'cerrar', 'class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'cerrar vista']) ?>
						
						<button id="marcar-todos" class="glyphicon icon-checkbox-checked btn btn-danger" title="Marcar todos" style="padding: 8px 12px 10px 12px;"></button>

						<button id="desmarcar-todos" class="glyphicon icon-checkbox-unchecked btn btn-danger" title="Desmarcar todos" style="padding: 8px 12px 10px 12px;"></button>

						<?= $this->Form->button(__(''), ['id' => 'generar-reporte', 'class' => 'glyphicon glyphicon-th-list btn btn-danger']) ?>			
						<a href='#' id="menos" title="Menos opciones" class='glyphicon glyphicon-minus btn btn-danger'></a>
					</p>
				</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
<?php else: ?>
	<?php 
		$arrayUsers = []; 
		$accountRoles = 0;	
		foreach ($employeesUsers as $employeesUser): 
			if ($accountRoles == 0):
				$arrayUsers[$employeesUser->user->role] = 1;
				$accountRoles++;
			else:
				$swEncontrado = 0;
				foreach ($arrayUsers as $clave => $arrayUser):
					if ($clave == $employeesUser->user->role):
						$arrayUsers[$clave]++;
						$swEncontrado = 1;
						break;
					endif;
				endforeach;
				if ($swEncontrado == 0):
					$arrayUsers[$employeesUser->user->role] = 1;
					$accountRoles++;
				endif;
			endif;
		endforeach;
	?>
	<br />
	<br />
	<div>
		<?php $accountRecords = 0; ?>
		<?php foreach ($employeesUsers as $employeesUser): ?>
			<?php if ($accountRecords == 0): ?>
				<?php $accountRecords++; ?>
				<table id="employees-users" name="employees-users" class="table noverScreen">
					<thead>
						<tr>
							<th></th>
							<th><b>Cirugías La Nacional, C.A.</b></th>
						</tr>
						<tr>
							<th></th>
							<th>Reporte de usuarios</th>
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
						<?php foreach ($arrayUsers as $clave => $arrayUser): ?>								
							<tr>
								<th></th>
								<th><?= $clave . ': ' . $arrayUser ?></th>
							</tr>
						<?php endforeach; ?>
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
							<th scope="col"><b>Nombre</b></th>
							<th scope="col"><b>Usuario</b></th>
							<th scope="col"><b>Rol</b></th>
							<th scope="col" class=<?= $arrayMark['Users.sex'] ?>><b>Sexo</b></th>
							<th scope="col" class=<?= $arrayMark['Users.identidy_card'] ?>><b>Cédula/pasaporte</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.rif'] ?>><b>RIF</b></th>
							<th scope="col" class=<?= $arrayMark['Users.cell_phone'] ?>><b>Celular</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.landline'] ?>><b>Teléfono fijo</b></th>
							<th scope="col" class=<?= $arrayMark['Users.email'] ?>><b>Email</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.address'] ?>><b>Dirección de habitación</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.birthdate'] ?>><b>Fecha de nacimiento</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.place_of_birth'] ?>><b>Lugar de nacimiento</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.country_of_birth'] ?>><b>País de nacimiento</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.degree_instruction'] ?>><b>Grado de instrucción</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.payment_method'] ?>><b>Método de pago</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.account_bank'] ?>><b>Cuenta</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.account_type'] ?>><b>Tipo de cuenta</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.bank'] ?>><b></b>Banco</th>
							<th scope="col" class=<?= $arrayMark['Employees.bank_address'] ?>><b>Dirección del banco</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.swif_bank'] ?>><b>Swif banco</b></th>
							<th scope="col" class=<?= $arrayMark['Employees.aba_bank'] ?>><b>Aba banco</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $accountRecords ?></td>
							<td><?= $employeesUser->user->full_name ?></td>
							<td><?= $employeesUser->user->username ?></td>
							<td><?= $employeesUser->user->role ?></td>
							<td class=<?= $arrayMark['Users.sex'] ?>><?= $employeesUser->user->sex ?></td>
							<td class=<?= $arrayMark['Users.identidy_card'] ?>><?= $employeesUser->user->type_of_identification .'-' . $employeesUser->user->identidy_card ?></td>
							<td class=<?= $arrayMark['Employees.rif'] ?>><?= $employeesUser->rif ?></td>
							<td class=<?= $arrayMark['Users.cell_phone'] ?>><?= $employeesUser->user->cell_phone ?></td>
							<td class=<?= $arrayMark['Employees.landline'] ?>><?= $employeesUser->landline ?></td>
							<td class=<?= $arrayMark['Users.email'] ?>><?= $employeesUser->user->email ?></td>
							<td class=<?= $arrayMark['Employees.address'] ?>><?= $employeesUser->address ?></td>
							<?php if (isset($employeesUser->birthdate)): ?>
								<td class=<?= $arrayMark['Employees.birthdate'] ?>><?= $employeesUser->birthdate->format('d-m-Y') ?></td>
							<?php else: ?>
								<td class=<?= $arrayMark['Employees.birthdate'] ?>></td>
							<?php endif; ?>
							<td class=<?= $arrayMark['Employees.place_of_birth'] ?>><?= $employeesUser->place_of_birth ?></td>
							<td class=<?= $arrayMark['Employees.country_of_birth'] ?>><?= $employeesUser->country_of_birth ?></td>
							<td class=<?= $arrayMark['Employees.degree_instruction'] ?>><?= $employeesUser->degree_instruction ?></td>
							<td class=<?= $arrayMark['Employees.payment_method'] ?>><?= $employeesUser->payment_method ?></td>
							<td class=<?= $arrayMark['Employees.account_bank'] ?>><?= $employeesUser->account_bank ?></td>
							<td class=<?= $arrayMark['Employees.account_type'] ?>><?= $employeesUser->account_type ?></td>
							<td class=<?= $arrayMark['Employees.bank'] ?>><?= $employeesUser->bank ?></td>
							<td class=<?= $arrayMark['Employees.bank_address'] ?>><?= $employeesUser->bank_address ?></td>
							<td class=<?= $arrayMark['Employees.swif_bank'] ?>><?= $employeesUser->swif_bank ?></td>
							<td class=<?= $arrayMark['Employees.aba_bank'] ?>><?= $employeesUser->aba_bank ?></td>							
						</tr>
			<?php else: ?>
				<?php $accountRecords++; ?>
				<tr>
					<td><?= $accountRecords ?></td>
					<td><?= $employeesUser->user->full_name ?></td>
					<td><?= $employeesUser->user->username ?></td>
					<td><?= $employeesUser->user->role ?></td>
					<td class=<?= $arrayMark['Users.sex'] ?>><?= $employeesUser->user->sex ?></td>
					<td class=<?= $arrayMark['Users.identidy_card'] ?>><?= $employeesUser->user->type_of_identification .'-' . $employeesUser->user->identidy_card ?></td>
					<td class=<?= $arrayMark['Employees.rif'] ?>><?= $employeesUser->rif ?></td>
					<td class=<?= $arrayMark['Users.cell_phone'] ?>><?= $employeesUser->user->cell_phone ?></td>
					<td class=<?= $arrayMark['Employees.landline'] ?>><?= $employeesUser->landline ?></td>
					<td class=<?= $arrayMark['Users.email'] ?>><?= $employeesUser->user->email ?></td>
					<td class=<?= $arrayMark['Employees.address'] ?>><?= $employeesUser->address ?></td>
					<?php if (isset($employeesUser->birthdate)): ?>
						<td class=<?= $arrayMark['Employees.birthdate'] ?>><?= $employeesUser->birthdate->format('d-m-Y') ?></td>
					<?php else: ?>
						<td class=<?= $arrayMark['Employees.birthdate'] ?>></td>
					<?php endif; ?>
					<td class=<?= $arrayMark['Employees.place_of_birth'] ?>><?= $employeesUser->place_of_birth ?></td>
					<td class=<?= $arrayMark['Employees.country_of_birth'] ?>><?= $employeesUser->country_of_birth ?></td>
					<td class=<?= $arrayMark['Employees.degree_instruction'] ?>><?= $employeesUser->degree_instruction ?></td>
					<td class=<?= $arrayMark['Employees.payment_method'] ?>><?= $employeesUser->payment_method ?></td>
					<td class=<?= $arrayMark['Employees.account_bank'] ?>><?= $employeesUser->account_bank ?></td>
					<td class=<?= $arrayMark['Employees.account_type'] ?>><?= $employeesUser->account_type ?></td>
					<td class=<?= $arrayMark['Employees.bank'] ?>><?= $employeesUser->bank ?></td>
					<td class=<?= $arrayMark['Employees.bank_address'] ?>><?= $employeesUser->bank_address ?></td>
					<td class=<?= $arrayMark['Employees.swif_bank'] ?>><?= $employeesUser->swif_bank ?></td>
					<td class=<?= $arrayMark['Employees.aba_bank'] ?>><?= $employeesUser->aba_bank ?></td>							
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
			<a href="/sln/users/index" id="volver" title="Volver" class='glyphicon glyphicon-chevron-left btn btn-danger'></a>
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
        
        $("#employees-users").table2excel({
    
            exclude: ".noExl",
        
            name: "employees_users",
        
            filename: $('#employees-users').attr('name') 
    
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