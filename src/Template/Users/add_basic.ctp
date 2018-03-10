<?php
    use Cake\Routing\Router; 
?>
<style>
@media screen
{
    .mensaje 
    {
        display:scroll;
        position:fixed;
        top:5%;
        left: 100px;
    }
}    
</style>
<div class="row">
    <p class="message"></p>
    <div class="col-md-6 col-md-offset-3">
        <div class="page-header">
            <p>
            <?php if (isset($controller)): ?>
                <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php else: ?>
                <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
            <?php endif; ?>
            <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
            </p>
            <h2>Registrar datos básicos del paciente:</h2>
        </div>
            <?= $this->Form->create(null) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('type_of_identification', ['label' => 'Tipo de documento de identificación: *', 'required' => 'true', 'options' => 
                        [null => " ",
                         'V' => 'Cédula venezolano',
                         'E' => 'Cédula extranjero',
                         'P' => 'Pasaporte'],
                         ]);
                    echo $this->Form->input('identidy_card', ['label' => 'Por favor escriba el número de cédula de identidad (sin puntos): *', 'required' => 'true', 'class' => 'positive-integer']);                    
                    echo $this->Form->input('role', ['label' => 'Rol: *', 'options' => 
                    ['Paciente' => 'Paciente']]);
                    echo $this->Form->input('first_name', ['label' => 'Primer nombre: *', 'required' => 'true']);
                    echo $this->Form->input('surname', ['label' => 'Primer apellido: *', 'required' => 'true']);
                    echo $this->Form->input('sex', ['required' => 'true', 'options' => [null => ' ', 'MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], 'label' => 'Sexo: *']);
                    echo $this->Form->input('email', ['label' => 'Correo electrónico: *', 'required' => 'true']);
                    echo $this->Form->input('cell_phone', ['label' => 'Número de teléfono celular:', 'required' => 'true']);
                    echo $this->Form->input('birthdate', ['type' => 'date', 'required' => 'true', 'label' => 'Fecha de nacimiento: *', 
                            'minYear' => 1930,
                            'maxYear' => 2017]);
                    echo $this->Form->input('country', ['required' => 'true', 'label' => 'País donde reside: *', 'options' => 
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
                    echo $this->Form->input('address', ['required' => 'true', 'label' => 'Dirección completa (urbanización o barrio, calle o avenida, Nro. de casa, edificio, piso, Nro. de apartamento, sector y punto de referencia): *']); 
                    echo $this->Form->input('profession', ['label' => 'Profesión u oficio: *', 'required' => 'true']);					
                    echo $this->Form->input('surgery', ['label' => 'Servicio médico: *', 'required' => 'true', 'options' => $services]); 
                    echo $this->Form->input('sponsor_type', 
                        ['required' => 'true', 'options' => 
                        [null => ' ',
                        'Recursos propios del paciente' => 'Recursos propios del paciente',
                        'Familiar o amigo' => 'Familiar o amigo',
                        'Aseguradora' => 'Aseguradora',
                        'Otro tipo de empresa o institución' => 'Otro tipo de empresa o institución'],
                        'label' => '¿Quién financiará la cirugía?: ']);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function() 
    {	
    	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
   
        $('#email').change(function(e) 
        {
            e.preventDefault();
            
            $.post('/sln/users/checkUser', {"role" : $("#role").val(), "email" : $("#email").val() }, null, "json")
                
            .done(function(response) 
            {
                if (response.success == true) 
                {
                    idUserPatient = response.data.id;

                    if (response.data.status == "ACTIVO")
                    {
                        $.redirect('/sln/users/viewGlobal', { id : idUserPatient, controller : 'Users', action : 'indexPatientUser', status : 'ACTIVO' }); 
                    }
                    else
                    {
                        namePatient = response.data.surname + ' ' + response.data.firstName;

                        $.redirect('/sln/users/confirmPatient', { id : idUserPatient, controller : 'Users', action : 'indexPatientUser', name : namePatient }); 
                    }
                }        
            })
            .fail(function(jqXHR, textStatus, errorThrown) 
            {
                alert('algo falló');
                $(".message").html("Error al buscar registro en la base de datos");
            });
        });
        $('#save-user').click(function(e) 
        {
            $('#email').val($('#email').val().toLowerCase());
        });
    });
</script>