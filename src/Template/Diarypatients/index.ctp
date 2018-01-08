<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
     	    <h2>Agenda del día: <?= $currentDate->format('d-m-Y') ?></h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;">Fecha</th>
                        <th scope="col" style="width: 5%;">Alerta</th>
                        <th scope="col" style="width: 5%;">Responsable</th>
                        <th scope="col" style="width: 7%;">Teléfono</th>
                        <th scope="col" style="width: 10%;">Actividad</th>
                        <th scope="col" style="width: 10%;">Paciente</th>
                        <th scope="col" style="width: 10%;">Cirugía</th>
                        <th scope="col" style="width: 7%;">Teléfono/email</th>
                        <th scope="col" class="actions" style="width: 15%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($diary as $diarys): ?>
                        <?php if ($current_user['role'] == 'Promotor(a)' || $current_user['role'] == 'Promotor(a) independiente'): ?>
                            <?php if ($current_user['id'] == $diarys->budget->patient->user->parent_user): ?>
                                <tr>
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
                                    <td class="actions">
                                        <?= $this->Html->link(__(''), ['action' => 'edit', $diarys->id, $promoter[$diarys->id]['namePromoter'], 'index'], ['class' => 'glyphicon glyphicon-ok', 'title' => 'Cerrar actividad']) ?>
										<?= $this->Form->postLink(__(''), ['controller' => 'budgets', 'action' => 'delete', $diarys->budget->id, 'Diarypatients', 'index', $diarys->budget->patient->user->id, $diarys->budget->patient_id, $diarys->budget->patient->user->parent_user], ['class' => 'glyphicon glyphicon-envelope', 'title' => 'Enviar presupuesto actualizado']) ?>
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
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr>
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
                                <td class="actions">
                                    <?= $this->Html->link(__(''), ['action' => 'edit', $diarys->id, $promoter[$diarys->id]['namePromoter'], 'index'], ['class' => 'glyphicon glyphicon-ok', 'title' => 'Cerrar actividad']) ?>
                                    <?= $this->Html->link(__(''), ['action' => 'reasign', $diarys->budget->patient->user->id, 'index'], ['class' => 'glyphicon glyphicon-user', 'title' => 'Reasignar promotor']) ?>
									<?= $this->Form->postLink(__(''), ['controller' => 'budgets', 'action' => 'delete', $diarys->budget->id, 'Diarypatients', 'index', $diarys->budget->patient->user->id, $diarys->budget->patient_id, $diarys->budget->patient->user->parent_user], ['class' => 'glyphicon glyphicon-envelope', 'title' => 'Enviar presupuesto actualizado']) ?>
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
                                </td>
                            </tr>
                        <?php endif; ?>    
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>