<?php 
use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
    	    <?php if ($origin == null): ?>
    	        <p><?= $this->Html->link(__('Volver'), ['controller' => 'Users', 'action' => 'home'], ['class' => 'btn btn-sm btn-default']) ?></p>
    	    <?php else: ?>
                <p><?= $this->Html->link(__('Volver'), ['controller' => 'Diarypatients', 'action' => $origin], ['class' => 'btn btn-sm btn-default']) ?></p>    	   
    	    <?php endif; ?>
    		<h2>Cerrar actividad</h2>
    		<h4>Paciente: <?= $diarypatient->budget->patient->user->full_name ?></h4>
    		<h4>Cirugía: <?= $diarypatient->budget->surgery ?> </h4>
    		<h4>Responsable: <?= $promoter ?> </h4>
        </div>
            <?= $this->Form->create($diarypatient) ?>
            <fieldset>
                <?php
                setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
                date_default_timezone_set('America/Caracas');
				
				$currentDate = time::now();
											
                echo $this->Form->input('activity_date', ['label' => 'Fecha: ', 'disabled' => 'disabled', 
					'type' => 'date',
					'monthNames' =>
					['01' => 'Enero',
					'02' => 'Febrero',
					'03' => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre'],
					'templates' => ['dateWidget' => '<ul class="list-inline"><li class="day">Día{{day}}</li><li class="month">Mes{{month}}</li><li class="year">Año{{year}}</li></ul>']]);				
                echo $this->Form->input('short_description_activity', ['label' => 'Actividad: ', 'disabled' => 'disabled']);
                echo $this->Form->input('detailed_activity_description', ['label' => 'Detalle: ', 'disabled' => 'disabled']);
                echo $this->Form->input('activity_comments', ['label' => 'Comentarios del cierre de la actividad: ']); 
				echo $this->Form->input('activity_date_next', ['label' => 'Por favor seleccione la fecha en que se debe ejecutar la próxima actividad: ', 
					'type' => 'date',
					'value' => $currentDate,
					'monthNames' =>
					['01' => 'Enero',
					'02' => 'Febrero',
					'03' => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre'],
					'templates' => ['dateWidget' => '<ul class="list-inline"><li class="day">Día{{day}}</li><li class="month">Mes{{month}}</li><li class="year">Año{{year}}</li></ul>']]);
			
				echo $this->Form->input('activity_next', ['label' => 'Actividad: ', 'options' => 
                    [null => '',
                    'Enviar presupuesto al paciente' => 'Enviar presupuesto al paciente',
                    'Completar datos del paciente' => 'Completar datos del paciente',
                    'Confirmar presupuesto con el paciente' => 'Confirmar presupuesto con el cliente',
                    'Planificar consulta médica previa a la cirugía' => 'Planificar consulta médica previa a la cirugía',
                    'Enviar presupuesto definitivo al paciente (aprobado por el médico)' => 'Enviar presupuesto definitivo al paciente (aprobado por el médico)',
                    'Confirmar el presupuesto definitivo' => 'Confirmar el presupuesto definitivo',
                    'Enviar el contrato para la firma' => 'Enviar contrato para la firma',
                    'Confirmar la aprobación del contrato por parte del paciente' => 'Confirmar la aprobación del contrato por parte del paciente',
                    'Firmar el contrato de la cirugía' => 'Firmar el contrato de la cirugía',
                    'Cobrar cuota del contrato' => 'Cobrar cuota del contrato',
                    'Verificar el pago de cuota del contrato' => 'Verificar el pago de cuota del contrato',
                    'Enviar recibo provisional de pago' => 'Enviar recibo provisional de pago',
                    'Planificar la fecha de la cirugía' => 'Planificar la fecha de la cirugía',
                    'Hacer la cirugía al paciente' => 'Hacer la cirugía al paciente',
                    'Enviar factura al paciente' => 'Enviar factura al paciente',
					'Cerrar (el paciente ya no está interesado)' => 'Cerrar (el paciente ya no está interesado)',
					'Cerrar (ya se practicó la cirugía o se ejecutó el servicio)' => 'Cerrar (ya se practicó la cirugía o se ejecutó el servicio)']]);
                echo $this->Form->input('detailed_next_activity', ['label' => 'Detalles de la actividad a realizar: ']);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Guardar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>