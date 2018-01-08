<?php
    use Cake\I18n\Time;
    use Cake\Routing\Router; 
?>

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

<div class="container">
    <div class="page-header">  
 	    <p>
            <?= $this->Html->link(__(''), ['controller' => 'users', 'action' => 'indexPatientUser'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>

        </p>
        <h1>Paciente:&nbsp;<?= h($user->full_name) ?></h1>
        <input id="id-user" type="hidden" value=<?= $user->id ?>>
        <input id="id-patient" type="hidden" value=<?= $user->patients[0]['id'] ?>>
    </div>
    <div class="row">
        <div class="col col-sm-4">
            <?= $this->Html->image('../files/users/profile_photo/' . $user->profile_photo_dir . '/'. $user->profile_photo, ['url' => ['controller' => 'users', 'action' => 'view', $current_user['id']], 'class' => 'img-thumbnail img-responsive']) ?>
        </div>
        <div class="col col-sm-8">    
            <br />
                <b>Teléfono del paciente:</b>&nbsp;<?= h($user->cell_phone) ?>
            <br />
            <br />   
                <b>Email del paciente:</b>&nbsp;<?= h($user->email) ?>
            <br />
            <br />
                <b>Promotor responsable de este paciente:</b>&nbsp;<?= h($promoter->full_name) ?>
            <br />
            <br />
                <b>Teléfono del promotor responsable:</b>&nbsp;<?= h($promoter->cell_phone) ?>
            <br />
            <br />

            <div id="mas-datos-paciente" style="display:none">
                <h3>Datos adicionales del paciente</h3>
                <br />
                    <b>Usuario:</b>&nbsp;<?= h($user->username) ?>
                <br />
                <br />
                    <b>Sexo:</b>&nbsp;<?= h($user->sex) ?>
                <br />
                <br />

                <?php if ($user->patients): ?>
                
                        <b>Fecha de nacimiento:</b>&nbsp;<?= h($user->patients[0]['birthdate']->format('d-m-Y')) ?>
                    <br />            
                    <br />
                        <b>País donde reside:</b>&nbsp;<?= h($user->patients[0]['country']) ?>
                    <br />            
                    <br />
                        <b>Estado o provincia:</b>&nbsp;<?= h($user->patients[0]['province_state']) ?>
                    <br />            
                    <br />
                        <b>Ciudad:</b>&nbsp;<?= h($user->patients[0]['city']) ?>
                    <br />            
                    <br />
                        <b>Dirección de habitación:</b>&nbsp;<?= h($user->patients[0]['address']) ?>
                    <br />            
                    <br />
                        <b>Número de teléfono fijo:</b>&nbsp;<?= h($user->patients[0]['landline']) ?>
                    <br />            
                    <br />               
                        <h3>Datos laborales:</h3>
                        <hr size="3" />
                        <b>Profesión:</b>&nbsp;<?= h($user->patients[0]['profession']) ?>
                    <br />
                    <br />
                        <b>Empresa o institución donde trabaja:</b>&nbsp;<?= h($user->patients[0]['workplace']) ?>
                    <br />
                    <br />
                        <b>Teléfono:</b>&nbsp;<?= h($user->patients[0]['work_phone']) ?>
                    <br />
                    <br />
                        <b>Dirección de la empresa o institución:</b>&nbsp;<?= h($user->patients[0]['work_address']) ?>
                    <br />
                    <br />
                        <h3>Datos de la persona de contacto en caso de emergencia:</h3>
                        <hr size="3" />
                        <b>Nombre:</b>&nbsp;<?= $user->patients[0]['first_name_emergency'] . ' ' . $user->patients[0]['surname_emergency'] ?>
                    <br />
                    <br />
                        <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['type_of_identification_emergency'] . '-' . $user->patients[0]['identidy_card_emergency'] ?>
                    <br />
                    <br />
                        <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_emergency'] ?>
                    <br />
                    <br />
                        <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_emergency'] ?>
                    <br />
                    <br />
                        <h3>Datos del acompañante:</h3>
                        <hr size="3" />
                        <b>Nombre:</b>&nbsp;<?= $user->patients[0]['first_name_companion'] . ' ' . $user->patients[0]['surname_companion'] ?>
                    <br />
                    <br />
                        <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['type_of_identification_companion'] . '-' . $user->patients[0]['identidy_card_companion'] ?>
                    <br />
                    <br />
                        <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_companion'] ?>
                    <br />
                    <br />
                        <b>Email:</b>&nbsp;<?= $user->patients[0]['email_companion'] ?>
                    <br />
                    <br />
                        <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_companion'] ?>
                    <br />
                    <br />
                        <b>Celular:</b>&nbsp;<?= $user->patients[0]['cell_phone_companion'] ?>
                    <br />
                    <br />
                        <h3>Datos del responsable del pago:</h3>
                        <hr size="3" />
                        <b>Nombre o razón social del responsable del pago:</b>&nbsp;<?= $user->patients[0]['sponsor'] ?>
                    <br />
                    <br />
                        <b>Clasificación del responsable del pago:</b>&nbsp;<?= $user->patients[0]['sponsor_type'] ?>
                    <br />
                    <br />
                        <b>Nro. de identificación:</b>&nbsp;<?= $user->patients[0]['sponsor_identification'] ?>
                    <br />
                    <br />
                        <b>Dirección:</b>&nbsp;<?= $user->patients[0]['address_sponsor'] ?>
                    <br />
                    <br />
                        <b>Email:</b>&nbsp;<?= $user->patients[0]['email_sponsor'] ?>
                    <br />
                    <br />
                        <b>Teléfono fijo:</b>&nbsp;<?= $user->patients[0]['landline_sponsor'] ?>
                    <br />
                    <br />
                        <b>Celular:</b>&nbsp;<?= $user->patients[0]['cell_phone_sponsor'] ?>
                    <br />
                    <br />

                <?php endif; ?>

            </div>

            <div id="presupuestos-solicitados" style="display:none">
                <div class="row">
                    <div class="col col-sm-8">
                        <h3>Presupuestos solicitados por el paciente</h3>
                        <p><a href="#" id="agregar-presupuesto" title="Agregar nuevo presupuesto" class='glyphicon glyphicon-list btn btn-primary'></a></p>
                        <div id="agregar-presupuesto-paciente" style="display:none">   
                            <?php
                                echo $this->Form->input('surgery', ['label' => 'Agregar nuevo presupuesto', 'options' => 
                                    [null => '',
                                    'Apendicectomía' => 'Apendicectomía',
                                    'Bichectomía' => 'Bichectomía',
                                    'Biopsia de cuello uterino' => 'Biopsia de cuello uterino',
                                    'Blefaroplastia' => 'Blefaroplastia',
                                    'Braqueoplastia' => 'Braqueoplastia',
                                    'Cesárea' => 'Cesárea',
                                    'Cierre de lóbulo de la oreja' =>  'Cierre de lóbulo de la oreja',                     
                                    'Dermolipectomía + Lipoescultura' => 'Dermolipectomía + Lipoescultura',
                                    'Dermolipectomía + Lipotransferencia o Lipofilling' => 'Dermolipectomía + Lipotransferencia o Lipofilling',
                                    'Esterilización por laparoscopia' => 'Esterilización por laparoscopia',
                                    'Exceresis de lipoma' => 'Exceresis de lipoma',
                                    'Histerectomía' => 'Histerectomía', 
                                    'Hernia inguinal' => 'Hernia inguinal',
                                    'Hernia inguinal + hernia umbilical',
                                    'Hernia umbilical' => 'Hernia umbilical',
                                    'Jornada de esterilización por laparoscopia' => 'Jornada de esterilización por laparoscopia', 
                                    'Legrado uterino' => 'Legrado uterino',
                                    'Labioplastia' => 'Labioplastia',
                                    'Lifting facial' => 'Lifting facial',  
                                    'Lipofilling' => 'Lipofilling',
                                    'Litiasis vesicular' => 'Litiasis vesicular',
                                    'Marcación abdominal' => 'Marcación abdominal',
                                    'Mastectomía parcial reconstructiva' => 'Mastectomía parcial reconstructiva',
                                    'Mastopexia de aumento' => 'Mastopexia de aumento',
                                    'Mastopexia de aumento + Lipotransferencia o Lipofilling' => 'Mastopexia de aumento + Lipotransferencia o Lipofilling',
                                    'Mastopexia + Dermolipectomía + Lipoescultura' => 'Mastopexia + Dermolipectomía + Lipoescultura',
                                    'Miomectomía' => 'Miomectomía',
                                    'Plan de maternidad' => 'Plan de maternidad',
                                    'Prolapso' => 'Prolapso',
                                    'Resección trans-uretral de próstata' => 'Resección trans-uretral de próstata',
                                    'Rinoplastia' => 'Rinoplastia',
                                    'Vaginoplastia' => 'Vaginoplastia',
                                    'Varicocele' => 'Varicocele']]);
                            ?>
                        </div>
                        <?php foreach ($user->patients as $patients): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha de solicitud</th>
                                            <th scope="col">Presupuesto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($patients->budgets as $budgets): ?>
                                            <tr>
                                                <td><?= h($budgets->application_date->format('d-m-Y')) ?></td>
                                                <td><?= h($budgets->surgery) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>                    
                            </div>        
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div id="agenda-dia-paciente" style="display:none">
                <div class="row">
                    <div class="col col-sm-12">
                        <?php foreach ($user->patients as $patients): ?>
                        <h3>Agenda del día del paciente</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Presupuesto</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Observación</th>
                                        <th scope="col">Actividad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
                                        date_default_timezone_set('America/Caracas');
                                        $currentDate = time::now();                                           
                                        $currentDate->hour(23)
                                            ->minute(59)
                                            ->second(59);
                                    ?>
                                    <?php foreach ($patients->budgets as $budgets): ?>
                                        <?php $accountDiary = 0; ?>
                                        <?php foreach ($budgets->diarypatients as $diaryPatient): ?>
                                            <?php if ($diaryPatient->activity_date <= $currentDate &&
                                                $diaryPatient->status == null &&
                                                $diaryPatient->deleted_record == null): ?>
                                                <tr>
                                                    <td><?= $budgets->surgery ?></td>
                                                    <td><?= $diaryPatient->activity_date->format('d-m-Y') ?></td>
                                                    <?php $diferent = $diaryPatient->activity_date->diff($currentDate); ?>
                                                    <?php if ($diferent->y > 0 || $diferent->m > 0 || $diferent->d > 0): ?>
                                                        <?php $observation = "Atraso"; ?>
                                                        <td style="color: red;"><?= $observation ?></td>
                                                    <?php else: ?>
                                                        <?php $observation = "Pendiente"; ?>
                                                        <td style="color: blue;"><?= $observation ?></td>
                                                    <?php endif; ?>
                                                    <td><?= $diaryPatient->short_description_activity ?></td>
                                                </tr>
                                                <?php $accountDiary++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?> 
                                </tbody>
                            </table>
                            <?php if ($accountDiary == 0): ?>
                                <?= 'No tiene actividades pendientes en la agenda' ?>
                            <?php endif; ?>
                        </div>        
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div id="agenda-futura-paciente" style="display:none">
                <div class="row">
                    <div class="col col-sm-10">
                        <?php foreach ($user->patients as $patients): ?>
                            <h3>Agenda futura del paciente</h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Presupuesto</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Actividad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
                                            date_default_timezone_set('America/Caracas');
                                            $currentDate = time::now();                                           
                                            $currentDate->hour(23)
                                                ->minute(59)
                                                ->second(59);
                                        ?>
                                        <?php foreach ($patients->budgets as $budgets): ?>
                                            <?php $accountFuture = 0; ?>
                                            <?php foreach ($budgets->diarypatients as $diaryPatient): ?>
                                                <?php if ($diaryPatient->activity_date > $currentDate &&
                                                    $diaryPatient->status == null &&
                                                    $diaryPatient->deleted_record == null): ?>
                                                    <tr>
                                                        <td><?= $budgets->surgery ?></td>
                                                        <td><?= $diaryPatient->activity_date->format('d-m-Y') ?></td>
                                                        <td><?= $diaryPatient->short_description_activity ?></td>
                                                    </tr>
                                                    <?php $accountFuture++; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if ($accountFuture == 0): ?>
                                    <?= 'No tiene actividades en la agenda' ?>
                                <?php endif; ?>
                            </div>        
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="menu-menos-paciente" class="menumenos">
        <p>
        <a href="#" id="menu-mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
        </p>
    </div>
    <div id="menu-mas-paciente" style="display:none;" class="menumas">
        <p>
        <a href="#" id="mas-datos" title="Ver datos adicionales" class='glyphicon glyphicon-user btn btn-danger'></a>
        <a href="#" id="presupuestos" title="Ver presupuestos solicitados" class='glyphicon glyphicon-th-list btn btn-danger'></a>
        <a href="#" id="agenda-dia" title="Ver agenda del día" class='glyphicon glyphicon-calendar btn btn-danger'></a>
        <a href="#" id="agenda-futura" title="Ver agenda futura" class='glyphicon glyphicon-list-alt btn btn-danger'></a>  
        <a href=<?= '/users/editBasic/' . $user->id . '/Users/viewGlobal/' . $user->id ?> id="editar-paciente" title="Modificar datos del paciente" class='glyphicon glyphicon-edit btn btn-danger'></a>
        <?= $this->Form->postLink(__(''), ['action' => 'deleteBasic', $user->id, 'Users', 'indexPatientUser' ], ['confirm' => __('Está seguro de que desea eliminar el paciente?'), 'class' => 'glyphicon glyphicon-trash btn btn-sm btn-danger', 'title' => 'Eliminar datos del paciente', 'style' => 'padding: 7px 12px;']) ?>
        <a href="#" id="menu-menos" title="Cerrar opciones" class='glyphicon glyphicon-remove btn btn-danger'></a>
        </p>
    </div>
</div>
<script>
    function log(id) 
    {
        $.redirect('/sln/users/viewGlobal', { id : id, controller : 'Users', action : 'viewGlobal' }); 
    }
$(document).ready(function(){ 
    $('#mas-datos').on('click',function(){
        $('#presupuestos-solicitados').slideUp();
        $('#agenda-dia-paciente').slideUp();
        $('#agenda-futura-paciente').slideUp();
        $('#mas-datos-paciente').toggle('slow');
    });
    $('#presupuestos').on('click',function(){
        $('#mas-datos-paciente').slideUp();
        $('#agenda-dia-paciente').slideUp();
        $('#agenda-futura-paciente').slideUp();
        $('#presupuestos-solicitados').toggle('slow');
    });
    $('#agenda-dia').on('click',function(){
        $('#mas-datos-paciente').slideUp();
        $('#presupuestos-solicitados').slideUp();
        $('#agenda-futura-paciente').slideUp();
        $('#agenda-dia-paciente').toggle('slow');
    });
    $('#agenda-futura').on('click',function(){
        $('#mas-datos-paciente').slideUp();
        $('#presupuestos-solicitados').slideUp();
        $('#agenda-dia-paciente').slideUp();
        $('#agenda-futura-paciente').toggle('slow');
    });
    $('#agregar-presupuesto').on('click',function(){
        $('#agregar-presupuesto-paciente').toggle('slow');
    });
    $('#surgery').change(function(e)
    {
        e.preventDefault();
        $.redirect('/budgets/addBudget', { idUser : $('#id-user').val(), idPatient : $('#id-patient').val(), surgery : $('#surgery').val(), controller : 'Users', action : 'viewGlobal' }); 
    });
    $('#menu-mas').on('click',function()
    {
        $('#menu-menos-paciente').hide();
        $('#menu-mas-paciente').show();
    });
    $('#menu-menos').on('click',function()
    {
        $('#menu-mas-paciente').hide();
        $('#menu-menos-paciente').show();
    });
    $('#patient').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPatient")); ?>',
        minLength: 3,             
        select: function( event, ui ) {
            log(ui.item.id);
          }
    });
});
</script>