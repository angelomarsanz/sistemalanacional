<?php
    use Cake\Routing\Router; 
?>
<style>
    .ui-autocomplete 
    {
        z-index: 2000;
    }
</style>
<div class="row">
    <div class="col-md-12">
		<input type="hidden" id="ambiente" value=<?= $system->ambient ?>>
    	<div class="page-header">
     	    <h2>Agenda del día: <?= $currentDate->format('d-m-Y') ?></h2>
			<?php if ($namePromoter != 'General'): ?>
				<h3>Promotor: <?= $namePromoter ?></h3>
			<?php endif; ?>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="actions" style="width: 5%;"></th>
                        <th scope="col" style="width: 10%;">Fecha</th>
                        <th scope="col" style="width: 5%;">Alerta</th>
                        <th scope="col" style="width: 15%;">Responsable</th>
                        <th scope="col" style="width: 7%;">Teléfono</th>
                        <th scope="col" style="width: 10%;">Actividad</th>
                        <th scope="col" style="width: 10%;">Paciente</th>
                        <th scope="col" style="width: 10%;">Cirugía</th>
                        <th scope="col" style="width: 7%;">Teléfono/email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($diary as $diarys): ?>
                        <?php if ($current_user['role'] == 'Promotor(a)' || $current_user['role'] == 'Promotor(a) independiente'): ?>
                            <?php if ($current_user['id'] == $diarys->budget->patient->user->parent_user): ?>
                                <tr>
                                    <td class="actions">
										<?php 
											if ($diarys->budget->initial_budget == null):
												echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
													$diarys->budget->id, 
													$diarys->budget->patient->user->full_name,
													$promoter[$diarys->id]['namePromoter'], 
													$promoter[$diarys->id]['cellPromoter'], 
													$promoter[$diarys->id]['emailPromoter'], 'Diarypatients', 'index'], ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto']);
											else: 
												$pdf = ".pdf";
												$pos = strpos($diarys->budget->initial_budget, $pdf);
												if ($pos):
													echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $diarys->budget->initial_budget_dir . '/'. $diarys->budget->initial_budget, ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto', 'target' => '_blank']);
												else:    
													$txt = ".txt";   
													$pos = strpos($diarys->budget->initial_budget, $txt);
													if ($pos):
														echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $diarys->budget->initial_budget_dir . '/'. $diarys->budget->initial_budget, ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto', 'target' => '_blank']);
													else:      
														echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
															$diarys->budget->id, 
															$diarys->budget->patient->user->full_name,
															$promoter[$diarys->id]['namePromoter'], 
															$promoter[$diarys->id]['cellPromoter'], 
															$promoter[$diarys->id]['emailPromoter'], 'Diarypatients', 'index'], ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto']);
												   endif;
												endif;
											endif;
										?>
										<?= $this->Html->link(__(''), ['controller' => 'budgets', 'action' => 'budget', $diarys->budget->id, $diarys->budget->patient->user->id, $diarys->budget->patient_id, $diarys->budget->patient->user->parent_user, 'Diarypatients', 'index', $diarys->budget->id, $diarys->budget->surgery], ['class' => 'glyphicon glyphicon-envelope', 'title' => 'Enviar presupuesto actualizado']) ?>
                                        <?= $this->Html->link(__(''), ['action' => 'edit', $diarys->id, $promoter[$diarys->id]['namePromoter'], 'index'], ['class' => 'glyphicon glyphicon-ok', 'title' => 'Cerrar actividad']) ?>										
                                    </td>
                                    <td><?= h($diarys->activity_date->format('d-m-Y')) ?></td>
                                    <?php if ($promoter[$diarys->id]['observationPromoter'] == "Atraso"): ?>
                                        <td style="color : red;"><b><?= $promoter[$diarys->id]['observationPromoter'] ?></b></td>
                                    <?php else: ?>
                                        <td style="color : blue;"><?= $promoter[$diarys->id]['observationPromoter'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $promoter[$diarys->id]['namePromoter'] ?></td>
                                    <td><?= $promoter[$diarys->id]['cellPromoter'] ?></td>
                                    <td><?= h($diarys->short_description_activity) ?></td>
                                    <td><?= h($diarys->budget->patient->user->full_name) ?></td>
                                    <td><?= h($diarys->budget->surgery) ?></td>
                                    <td><?= h($diarys->budget->patient->user->cell_phone) . ' ' . h($diarys->budget->patient->user->email) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr>
                                <td class="actions">
                                    <?php 
                                        if ($diarys->budget->initial_budget == null):
                                            echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
												$diarys->budget->id, 
												$diarys->budget->patient->user->full_name,
												$promoter[$diarys->id]['namePromoter'], 
												$promoter[$diarys->id]['cellPromoter'], 
												$promoter[$diarys->id]['emailPromoter'], 'Diarypatients', 'index'], ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto']);
										else: 
                                            $pdf = ".pdf";
                                            $pos = strpos($diarys->budget->initial_budget, $pdf);
                                            if ($pos):
                                                echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $diarys->budget->initial_budget_dir . '/'. $diarys->budget->initial_budget, ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto', 'target' => '_blank']);
                                            else:    
                                                $txt = ".txt";   
                                                $pos = strpos($diarys->budget->initial_budget, $txt);
                                                if ($pos):
                                                    echo $this->Html->link(__(''), '/files/budgets/initial_budget/' . $diarys->budget->initial_budget_dir . '/'. $diarys->budget->initial_budget, ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto', 'target' => '_blank']);
                                                else:      
													echo $this->Html->link(__(''), ['controller' => 'Budgets', 'action' => 'view',
														$diarys->budget->id, 
														$diarys->budget->patient->user->full_name,
														$promoter[$diarys->id]['namePromoter'], 
 														$promoter[$diarys->id]['cellPromoter'], 
														$promoter[$diarys->id]['emailPromoter'], 'Diarypatients', 'index'], ['class' => 'glyphicon glyphicon-search', 'title' => 'Ver presupuesto']);
                                               endif;
                                            endif;
                                        endif;
                                    ?>
									<?= $this->Html->link(__(''), ['controller' => 'budgets', 'action' => 'budget', $diarys->budget->id, $diarys->budget->patient->user->id, $diarys->budget->patient_id, $diarys->budget->patient->user->parent_user, 'Diarypatients', 'index', $diarys->budget->id, $diarys->budget->surgery], ['class' => 'glyphicon glyphicon-envelope', 'title' => 'Enviar presupuesto actualizado']) ?>									
                                    <?= $this->Html->link(__(''), ['action' => 'edit', $diarys->id, $promoter[$diarys->id]['namePromoter'], 'index'], ['class' => 'glyphicon glyphicon-ok', 'title' => 'Cerrar actividad']) ?>
                                </td>
								<td><?= h($diarys->activity_date->format('d-m-Y')) ?></td>
                                <?php if ($promoter[$diarys->id]['observationPromoter'] == "Atraso"): ?>
                                    <td style="color : red;"><b><?= $promoter[$diarys->id]['observationPromoter'] ?></b></td>
                                <?php else: ?>
                                    <td style="color : blue;"><?= $promoter[$diarys->id]['observationPromoter'] ?></td>
                                <?php endif; ?>
								
								<td>
									<input type="text" value="<?= $promoter[$diarys->id]['namePromoter'] ?>" id=<?= "buscarPromotor-" . $diarys->budget->patient->user->id . "-" . $diarys->budget->id ?> class="buscarPromotor"><spam id=<?= "mensajesUsuario-" . $diarys->budget->patient->user->id . "-" . $diarys->budget->id ?>
								</td>
								
                                <td><?= $promoter[$diarys->id]['cellPromoter'] ?></td>
                                <td><?= h($diarys->short_description_activity) ?></td>
                                <td><?= h($diarys->budget->patient->user->full_name) ?></td>
                                <td><?= h($diarys->budget->surgery) ?></td>
                                <td><?= h($diarys->budget->patient->user->cell_phone) . ' ' . h($diarys->budget->patient->user->email) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function diaryPromoter(idPromoter, namePromoter) 
    {
		if ($('#ambiente').val() == 'Producción')
		{
			$.redirect('/sln/Diarypatients/index', { idPromoter : idPromoter, namePromoter : namePromoter }); 
		}
		else if ($('#ambiente').val() == 'Desarrollo')
		{
			$.redirect('/dsln/Diarypatients/index', { idPromoter : idPromoter, namePromoter : namePromoter });
		}
		else if ($('#ambiente').val() == 'Prueba')
		{
			$.redirect('/psln/Diarypatients/index', { idPromoter : idPromoter, namePromoter : namePromoter });
		}
    }

    function actualizarPromotor(idUsuarioPaciente, idPresupuesto, idNuevoPromotor)
    {
        var mensajesUsuario = 
            "<div class='alert alert-info alert-dismissible'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                "<strong>Por favor espere mientras se reasigna el promotor</strong>" +
            "</div>";

        var idMensaje = "#mensajesUsuario-" + idUsuarioPaciente + "-" + idPresupuesto; 

      	$(idMensaje).html(mensajesUsuario);

        var jsonDatos = 
        {
            "idUsuarioPaciente" : idUsuarioPaciente,
            "idNuevoPromotor" : idNuevoPromotor
        }

        $.post("<?php echo Router::url(array("controller" => "Users", "action" => "reasignarPromotor")); ?>", 
            jsonDatos, null, "json")          
        .done(function(response) 
        {
            if (response.satisfactorio) 
            {
                mensajesUsuario =
                    "<div class='alert alert-success alert-dismissible'>" +
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                        "<strong>" + response.mensaje + "</strong>" +
                    "</div>";
                // $(idMensaje).html(mensajesUsuario);
            } 
            else 
            {
                mensajesUsuario =
                "<div class='alert alert-danger alert-dismissible'>" +
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                    "<strong>" + response.mensaje + "</strong>" +
                "</div>"; 

            	$(idMensaje).html(mensajesUsuario);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) 
        {
            mensajesUsuario =
                "<div class='alert alert-danger alert-dismissible'>" +
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                    "<strong>¡ Ocurrió un error en el servidor. Los datos no se pudieron guardar !</strong>" +
                "</div>"; 

        	$(idMensaje).html(mensajesUsuario);
        });
    }

    $(document).ready(function(){
        $('#diary-promoter').autocomplete(
        {
            source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPromoter")); ?>',
            minLength: 3,             
            select: function( event, ui ) {
                diaryPromoter(ui.item.id, ui.item.value);
              }
        });
		
        $(".buscarPromotor").autocomplete(
        {
            source: <?= json_encode($arrayPromoters) ?>,
            minLength: 3,
            
			select: function( event, ui ) 
            {   
				idCompleto = $(this).attr("id").substring(15);
				var arregloId = idCompleto.split("-");
				idUsuarioPaciente = arregloId[0];
				idPresupuesto = arregloId[1];
                idNuevoPromotor = ui.item.id;
                actualizarPromotor(idUsuarioPaciente, idPresupuesto, idNuevoPromotor);
            }
        });
	});
</script>