<style>
@media screen
{
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
    .botonMenu
    {
        margin-bottom: 5 px;
    }
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
</style>

<script>
function mostrarMas()
{
	$('#menu-menos-opciones').toggle();
	$('#menu-mas-opciones').toggle();        
}

function mostrarMenos()
{
	$('#menu-mas-opciones').toggle();
	$('#menu-menos-opciones').toggle();
}
</script>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
 	    <p>
			<?= $this->Html->link(__(''), ['controller' => 'Patients', 'action' => 'edit', $patient->id, $controller, $action,  $idUser, $idPromoter, $promoter], ['class' => 'glyphicon glyphicon-repeat btn btn-sm btn-default', 'title' => 'Recargar página', 'style' => 'color: #9494b8']) ?>
        </p>
		<h2>Por favor actualice estos otros datos:</h2>
        </div>
            <?= $this->Form->create($patient, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('birthdate', ['label' => 'Fecha de nacimiento: *']);
                    echo $this->Form->input('landline', ['label' => 'Teléfono fijo: *']);
                    echo $this->Form->input('country', ['label' => 'País donde reside: *', 'options' => 
                    [null =>'',
                    'Afganistán' => 'Afganistán',
                    'Albania' => ' Albania',
                    'Alemania' => 'Alemania',
                    'Andorra' => 'Andorra',
                    'Angola' => 'Angola',
                    'Antigua y Barbuda' => 'Antigua y Barbuda',
                    'Arabia Saudita' => 'Arabia Saudita',
                    'Argelia' => 'Argelia',
                    'Argentina' => 'Argentina',
                    'Armenia' => 'Armenia',
                    'Australia' => 'Australia',
                    'Austria' => 'Austria',
                    'Azerbaiyán' => 'Azerbaiyán',
                    'Bahamas' => 'Bahamas',
                    'Bangladés' => 'Bangladés',
                    'Barbados' => 'Barbados',
                    'Baréin' => 'Baréin',
                    'Bélgica' => 'Bélgica',   
                    'Belice' => 'Belice',
                    'Benín' => 'Benín',
                    'Bielorrusia' => 'Bielorrusia',
                    'Birmania' => 'Birmania',
                    'Bolivia' => 'Bolivia',
                    'Bosnia-Herzegovina' => 'Bosnia-Herzegovina',
                    'Botsuana' => 'Botsuana',
                    'Brasil' => 'Brasil',
                    'Brunéi' => 'Brunéi',
                    'Bulgaria' => 'Bulgaria',
                    'Burkina Faso' => 'Burkina Faso',
                    'Burundi' => 'Burundi',
                    'Bután' => 'Bután',
                    'Cabo Verde' => 'Cabo Verde',
                    'Camboya' => 'Camboya',
                    'Camerún' => 'Camerún',
                    'Canadá' => 'Canadá',
                    'Catar' => 'Catar',
                    'Chad' => 'Chad',
                    'Chile' => 'Chile',
                    'China' => 'China',
                    'Chipre' => 'Chipre',
                    'Colombia' => 'Colombia',
                    'Comoras' => 'Comoras',
                    'Congo' => 'Congo',
                    'Corea del Norte' => 'Corea del Norte',
                    'Corea del Sur' => 'Corea del Sur',
                    'Costa de Marfil' => 'Costa de Marfil',
                    'Costa Rica' => 'Costa Rica',
                    'Croacia' => 'Croacia',
                    'Cuba' => 'Cuba',
                    'Dinamarca' => 'Dinamarca',
                    'Dominica' => 'Dominica',
                    'Ecuador' => 'Ecuador',
                    'Egipto' => 'Egipto',
                    'El Salvador' => 'El Salvador',
                    'Emiratos Árabes Unidos' => 'Emiratos Árabes Unidos',
                    'Eritrea' => 'Eritrea',
                    'Eslovaquia' => 'Eslovaquia',
                    'Eslovenia' => 'Eslovenia',
                    'España' => 'España',
                    'Estados Unidos' => 'Estados Unidos',
                    'Estonia' => 'Estonia',
                    'Etiopía' => 'Etiopía',
                    'Filipinas' => 'Filipinas',
                    'Finlandia' => 'Finlandia',
                    'Fiyi' => 'Fiyi',
                    'Francia' => 'Francia',
                    'Gabón' => 'Gabón',
                    'Gambia' => 'Gambia',
                    'Georgia' => 'Georgia',
                    'Ghana' => 'Ghana',
                    'Granada' => 'Granada',
                    'Grecia' => 'Grecia',
                    'Guatemala' => 'Guatemala',
                    'Guinea' => 'Guinea',
                    'Guinea Ecuatorial' => 'Guinea Ecuatorial',
                    'Guinea-Bisáu' => 'Guinea-Bisáu',
                    'Guyana' => 'Guyana',
                    'Haití' => 'Haití',
                    'Honduras' => 'Honduras',
                    'Hungría' => 'Hungría',
                    'India' => 'India',
                    'Indonesia' => 'Indonesia',
                    'Irak' => 'Irak',
                    'Irán' => 'Irán',
                    'Irlanda' => 'Irlanda',
                    'Islandia' => 'Islandia',
                    'Islas Marshall' => 'Islas Marshall',
                    'Islas Salomón' => 'Islas Salomón',
                    'Israel' => 'Israel',
                    'Italia' => 'Italia',
                    'Jamaica' => 'Jamaica',
                    'Japón' => 'Japón',
                    'Jordania' => 'Jordania',
                    'Kazajistán' => 'Kazajistán',
                    'Kenia' => 'Kenia',
                    'Kirguistán' => 'Kirguistán',
                    'Kiribati' => 'Kiribati',
                    'Kosovo' => 'Kosovo',
                    'Kuwait' => 'Kuwait',
                    'Laos' => 'Laos',
                    'Lesoto' => 'Lesoto',
                    'Letonia' => 'Letonia',
                    'Líbano' => 'Líbano',
                    'Liberia' => 'Liberia',
                    'Libia' => 'Libia',
                    'Liechtenstein' => 'Liechtenstein',
                    'Lituania' => 'Lituania',
                    'Luxemburgo' => 'Luxemburgo',
                    'Macedonia' => 'Macedonia',
                    'Madagascar' => 'Madagascar',
                    'Malasia' => 'Malasia',
                    'Malaui' => 'Malaui',
                    'Maldivas' => 'Maldivas',
                    'Malí' => 'Malí',
                    'Malta' => 'Malta',
                    'Marruecos' => 'Marruecos',
                    'Mauricio' => 'Mauricio',
                    'Mauritania' => 'Mauritania',
                    'México' => 'México',
                    'Micronesia' => 'Micronesia',
                    'Moldavia' => 'Moldavia',
                    'Mónaco' => 'Mónaco',
                    'Mongolia' => 'Mongolia',
                    'Montenegro' => 'Montenegro',
                    'Mozambique' => 'Mozambique',
                    'Namibia' => 'Namibia',
                    'Nauru' => 'Nauru',
                    'Nepal' => 'Nepal',
                    'Nicaragua' => 'Nicaragua',
                    'Níger' => 'Níger',
                    'Nigeria' => 'Nigeria',
                    'Noruega' => 'Noruega',
                    'Nueva Zelanda' => 'Nueva Zelanda',
                    'Omán' => 'Omán',
                    'Países Bajos' => 'Países Bajos',
                    'Pakistán' => 'Pakistán',
                    'Palaos' => 'Palaos',
                    'Palestina' => 'Palestina',
                    'Panamá' => 'Panamá',
                    'Papúa Nueva Guinea' => 'Papúa Nueva Guinea',
                    'Paraguay' => 'Paraguay',
                    'Perú' => 'Perú',
                    'Polonia' => 'Polonia',
                    'Portugal' => 'Portugal',
                    'Reino Unido' => 'Reino Unido',
                    'República Centroafricana' => 'República Centroafricana',
                    'República Checa' => 'República Checa',
                    'República Democrática del Congo' => 'República Democrática del Congo',
                    'República Dominicana' => 'República Dominicana',
                    'Ruanda' => 'Ruanda',
                    'Rumania' => 'Rumania',
                    'Rusia' => 'Rusia',
                    'Samoa' => 'Samoa',
                    'San Cristóbal y Nieves' => 'San Cristóbal y Nieves',
                    'San Marino' => 'San Marino',
                    'San Vicente y las Granadinas' => 'San Vicente y las Granadinas',
                    'Santa Lucía' => 'Santa Lucía',
                    'Santo Tomé y Príncipe' => 'Santo Tomé y Príncipe',
                    'Senegal' => 'Senegal',
                    'Serbia' => 'Serbia',
                    'Seychelles' => 'Seychelles',
                    'Sierra Leona' => 'Sierra Leona',
                    'Singapur' => 'Singapur',
                    'Siria' => 'Siria',
                    'Somalia' => 'Somalia',
                    'Sri Lanka' => 'Sri Lanka',
                    'Suazilandia' => 'Suazilandia',
                    'Sudáfrica' => 'Sudáfrica',
                    'Sudán' => 'Sudán',
                    'Sudán del Sur' => 'Sudán del Sur',
                    'Suecia' => 'Suecia',
                    'Suiza' => 'Suiza',
                    'Surinam' => 'Surinam',
                    'Tailandia' => 'Tailandia',
                    'Taiwán' => 'Taiwán',
                    'Tanzania' => 'Tanzania',
                    'Tayikistán' => 'Tayikistán',
                    'Timor Oriental' => 'Timor Oriental',
                    'Togo' => 'Togo',
                    'Tonga' => 'Tonga',
                    'Trinidad y Tobago' => 'Trinidad y Tobago',
                    'Túnez' => 'Túnez',
                    'Turkmenistán' => 'Turkmenistán',
                    'Turquía' => 'Turquía',
                    'Tuvalu' => 'Tuvalu',
                    'Ucrania' => 'Ucrania',
                    'Uganda' => 'Uganda',
                    'Uruguay' => 'Uruguay',
                    'Uzbekistán' => 'Uzbekistán',
                    'Vanuatu' => 'Vanuatu',
                    'Vaticano' => 'Vaticano',
                    'Venezuela' => 'Venezuela',
                    'Vietnam' => 'Vietnam',
                    'Yemen' => 'Yemen',
                    'Yibuti' => 'Yibuti',
                    'Zambia' => 'Zambia',
                    'Zimbabue' => 'Zimbabue']]);
                    echo $this->Form->input('province_state', ['label' => 'Estado o provincia: *']);
                    echo $this->Form->input('city', ['label' => 'Ciudad: *']);
                    echo $this->Form->input('address', ['label' => 'Dirección completa (urbanización o barrio, calle o avenida, Nro. de casa, edificio, piso, Nro. de apartamento, sector y punto de referencia): *']); ?>
                    <h3>Datos laborales: </h3>
                    <hr size="3" />
                <?php
                    echo $this->Form->input('profession', ['label' => 'Profesión: *']);
                    echo $this->Form->input('workplace', ['label' => 'Empresa o institución donde trabaja: ']);
                    echo $this->Form->input('work_phone', ['label' => 'Teléfono del trabajo: ']);
                    echo $this->Form->input('work_address', ['label' => 'Dirección completa del lugar de trabajo (sector o urbanización, calle o avenida, edificio, galpón o casa, piso, Nro. de oficina o apartamento y punto de referencia): *']); ?>
                    <h3>Datos de la persona de contacto en caso de emergencia: </h3>
                    <hr size="3" />
                <?php    
                    echo $this->Form->input('first_name_emergency', ['label' => 'Nombre: ']);
                    echo $this->Form->input('surname_emergency', ['label' => 'Apellido: ']);
                    echo $this->Form->input('cell_phone_emergency', ['label' => 'Celular: ']);
                    echo $this->Form->input('landline_emergency', ['label' => 'Teléfono fijo: ']);
					echo $this->Form->input('email_emergency', ['label' => 'email: ']);
				?>
                    <h3>Datos del acompañante: </h3>
                    <hr size="3" />
                <?php 
                    echo $this->Form->input('first_name_companion', ['label' => 'Nombre: ']);
                    echo $this->Form->input('surname_companion', ['label' => 'Apellido: ']);
					echo $this->Form->input('cell_phone_companion', ['label' => 'Celular: ']);
				?>
                    <h3>Datos de la persona o institución responsable del pago de la cirugía: </h3>
                    <hr size="3" />
                <?php
                    echo $this->Form->input('sponsor_type', 
                        ['label' => '¿Quién financiará la cirugía?: ', 'options' => 
                        [null => ' ',
                        'Recursos propios del paciente' => 'Recursos propios del paciente',
                        'Familiar o amigo' => 'Familiar o amigo',
                        'Aseguradora' => 'Aseguradora',
                        'Otro tipo de empresa o institución' => 'Otro tipo de empresa o institución']]);                
                    echo $this->Form->input('sponsor', ['label' => 'Nombre o razón social del responsable del pago: ']);
                    echo $this->Form->input('sponsor_identification', ['label' => 'Cédula o RIF o RUC:']);
                    echo $this->Form->input('address_sponsor', ['label' => 'Dirección completa (sector, urbanización o barrio, calle o avenida, edificio, galpón o Nro. de casa, piso, Nro. de apartamento u oficina y punto de referencia): *']);
                    echo $this->Form->input('email_sponsor', ['label' => 'email: ']);
                    echo $this->Form->input('landline_sponsor', ['label' => 'Teléfono fijo: ']);
                    echo $this->Form->input('cell_phone_sponsor', ['label' => 'Celular: ']);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Siguiente'), ['class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<div id="menu-menos-opciones" class="menumenos">
	<p>
		<button type="button" id="menu-mas" title="Más opciones" class="glyphicon glyphicon-plus btn btn-danger" onclick="mostrarMas()"></button>
	</p>
</div>
<div id="menu-mas-opciones" style="display:none;" class="menumas">
	<p>
		<?php if (isset($controller) && isset($action)): ?>
			<?php if ($action == 'indexPatientUser'): ?>	
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idPromoter, $controller, $action, $promoter], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
			<?php elseif ($action == 'viewGlobal'): ?>
				<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idUser, 'Users', 'indexPatientUser', $idPromoter], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>		
			<?php endif; ?>
		<?php else: ?>	
			<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'indexPatientUser'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-danger', 'title' => 'Volver']) ?>
        <?php endif; ?>
	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'title' => 'Cerrar vista']) ?>
		<button type="button" id="menu-menos" title="Menos opciones" class="glyphicon glyphicon-minus btn btn-danger" onclick="mostrarMenos()"></button>
	</p>
</div>