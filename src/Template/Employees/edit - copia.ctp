<?php
    use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
     	    <p>
            <?php if (isset($controller)): ?>
				<?php if ($current_user['id'] == $employee->user_id): ?>
					<?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
				<?php else: ?>
					<?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
				<?php endif; ?>
            <?php else: ?>
        	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php endif; ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
            </p>
            <h3>Por favor complete estos otros datos:</h3>
        </div>
        <?= $this->Form->create($employee, ['type' => 'file']) ?>
            <fieldset>
                <div class="row panel panel-default">
                    <div class="col-md-12">
                        <br />
                        <?php
                            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
                            date_default_timezone_set('America/Caracas');
                            echo $this->Form->input('country_of_birth', ['label' => 'País de nacimiento: *', 'options' => 
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
                            echo $this->Form->input('place_of_birth', ['label' => 'Ciudad y estado (provincia) donde nació: *']);
                            echo $this->Form->input('birthdate', 
                            ['label' => 'Fecha de nacimiento: *', 
                            'minYear' => 1950,
                            'maxYear' => 2017,]);
                            echo $this->Form->input('landline', ['label' => 'Número de teléfono fijo: *']);
                            echo $this->Form->input('address', ['label' => 'Dirección completa (urbanización o barrio, calle o avenida, Nro. de casa, edificio, piso, Nro. de apartamento, sector y punto de referencia: *']);
                            echo $this->Form->input('degree_instruction', ['label' => 'Grado de instrucción: *']);
                            echo $this->Form->input('bank', ['label' => 'Banco:', 'options' => 
                                [null => '',
                                '100% Banco' => '100% Banco',
                                'Activo' => 'Activo',
                                'Agrícola de Venezuela' => 'Agrícola de Venezuela',
                                'Bancamiga' => 'Bancamiga',
                                'Bancaribe' => 'Bancaribe',
                                'Bancoex' => 'Bancoex',
                                'Bancrecer' => 'Bancrecer',
                                'Banesco' => 'Banesco',
                                'Banfanb' => 'Banfanb',
                                'Bangente' => 'Bangente',
                                'Banplus' => 'Banplus',
                                'Bicentenario del Pueblo' => 'Bicentenario del Pueblo',
                                'BOD' => 'BOD',
                                'Caroní' => 'Caroní',
                                'Citibank' => 'Citibank',
                                'Delsur' => 'Delsur',
                                'Exportación y Comercio' => 'Exportación y Comercio', 
                                'Exterior' => 'Exterior',
                                'Fondo Común' => 'Fondo Común',
                                'Instituto Municipal de Crédito Popular (IMCP)' => 'Instituto Municipal de Crédito Popular (IMCP)',
                                'Internacional de Desarrollo' => 'Internacional de Desarrollo',
                                'Mercantil' => 'Mercantil',
                                'Mi Banco' => 'Mi Banco',
                                'Nacional de Crédito' => 'Nacional de Crédito',
                                'Novo Banco' => 'Novo Banco',
                                'Plata' => 'Plata',
                                'Plaza' => 'Plaza',
                                'Provincial' => 'Provincial',
                                'Sofitasa' => 'Sofitasa',
                                'Tesoro' => 'Tesoro',
                                'Venezolano de Crédito' => 'Venezolano de Crédito',
                                'Venezuela' => 'Venezuela',
                                'Otro banco no especificado en la lista']]); 
                            echo $this->Form->input('account_type', ['label' => 'Tipo de cuenta: *', 'options' => 
                                [null => '',
                                'Ahorros' => 'Ahorros',
                                'Corriente' => 'Corriente']]);
                            echo $this->Form->input('account_bank', ['label' => 'Número de cuenta: *']);
                        ?>
                    </div>
                </div>
            </fieldset>
        <?= $this->Form->button(__('Guardar'), ['class' =>'btn btn-success', 'id' => 'save-employee']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>