<?php
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
    .ui-autocomplete 
    {
        z-index: 2000;
    }
}
</style>
<div class="row">
    <div class="col-md-12">
		<h3>Multinivel</h3>
		<?php if (isset($budgetsG)): ?>
			<h4 style="margin-left: 10px;"><?= $promoter ?></h4>
			<div class="row">
			    <div class="col-md-9">
				   	<div id="pacientes-atendidos" style="margin-left: 10px; display:none;">
				    	<h4>Pacientes atendidos</h4>
						<div class="table-responsive" style="margin-left: 10px;">
						    <table class="table table-striped table-hover">
						        <thead>
						            <tr>
						            	<th scope="col" style="width: 10%;">Paciente</th>
						            	<th scope="col" style="width: 10%;">Nro presupuesto</th>
						                <th scope="col" style="width: 10%;">Presupuesto</th>
						                <th scope="col" style="width: 10%;">Nro factura</th>
						                <th scope="col" style="width: 10%;">Monto (Bs.)</th>
										<th scope="col" style="width: 10%;">Monto ($)</th>
						            </tr>
						        </thead>
						        <tbody>
						        	<?php $accountBudget = 0 ?>
						        	<?php $swBudgetsFather = 0; ?>
									<?php $ventasPadreBolivar = 0; ?>
				            		<?php $comisionPadreBolivar = 0; ?>
									<?php $ventasPadreDolar = 0; ?>
									<?php $comisionPadreDolar = 0; ?>
									<?php if ($rolePromoter == 'Coordinador(a)' || $rolePromoter == 'Promotor(a)' || $rolePromoter == 'Promotor(a) independiente'): ?>
						            <?php foreach ($budgetsG as $budgetsGs): ?>
						            	<?php if ($budgetsGs->patient->user->parent_user == $father): ?>
										<?php $keyArray = 'u' . $budgetsGs->patient->user->parent_user . 'b' . $budgetsGs->id; ?> 
										<?php if (isset($arrayCommissions[$keyArray]) || $budgetsGs->number_bill == null): ?> 
						            		<?php $swBudgetsFather = 1; ?>
							                <tr>
							            		<?php if ($accountBudget == 0): ?>
							            			<?php $namePatient = $budgetsGs->patient->user->full_name ?>
							            			<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
							            		<?php else: ?>
							            			<?php if ($namePatient != $budgetsGs->patient->user->full_name): ?>
							            				<?php $namePatient = $budgetsGs->patient->user->full_name ?>
							            				<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
							            			<?php else: ?>
									                	<td style="width: 10%;"></td>
									                <?php endif; ?>
							            		<?php endif; ?>
							            		<td style="width: 10%;"><?= h($budgetsGs->number_budget) ?></td>
							                    <td style="width: 10%;"><?= h($budgetsGs->surgery) ?></td>
							                    <td style="width: 10%;"><?= h($budgetsGs->number_bill) ?></td>
												<?php if ($budgetsGs->coin == 'BOLIVAR'): ?>
													<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
													<td style="width: 10%;"></td>
													<?php $ventasPadreBolivar+= $budgetsGs->amount_bill; ?>
													<?php if (isset($arrayCommissions[$keyArray])): ?>
														<?php $comisionPadreBolivar+= $arrayCommissions[$keyArray]; ?>
													<?php endif; ?>
												<?php else: ?>
													<td style="width: 10%;"></td>
													<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
													<?php $ventasPadreDolar+= $budgetsGs->amount_bill; ?>
													<?php if (isset($arrayCommissions[$keyArray])): ?>
														<?php $comisionPadreDolar+= $arrayCommissions[$keyArray]; ?>
													<?php endif; ?>
												<?php endif; ?>
							                </tr>						           
							                <?php $accountBudget++; ?>
										<?php endif; ?>
						                <?php endif; ?>
						            <?php endforeach; ?>
									<?php endif; ?>
						        </tbody>
						    </table>                    
       				        <?php if ($swBudgetsFather == 0): ?>
					        	<p style="margin-left: 10px;">Este promotor no tiene presupuestos activos</p>
					        <?php endif; ?>
				            <p style="margin-left: 10px;"><b><?php echo 'Total ventas propias en bolívares (Bs.): ' . number_format($ventasPadreBolivar, 2, ",", "."); ?></b></p>
				            <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas propias en bolívares (Bs.): ' . number_format($comisionPadreBolivar, 2, ",", "."); ?></b></p>
							<p style="margin-left: 10px;"><b><?php echo 'Total ventas propias en dólares ($): ' . number_format($ventasPadreDolar, 2, ",", "."); ?></b></p>
				            <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas propias en dólares ($): ' . number_format($comisionPadreDolar, 2, ",", "."); ?></b></p>
						</div> 
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-9">
			   	   	<div id="hijos" style="margin-left: 10px; display:none;">
				    	<h4>Hijos</h4>
						<?php $ventasHijosBolivar = 0; ?>
    			    	<?php $comisionHijosBolivar = 0; ?>
						<?php $ventasHijosDolar = 0; ?>
						<?php $comisionHijosDolar = 0; ?>
				    	<?php $swChildren = 0; ?>
						<?php if ($rolePromoter == 'Promotor(a)' || $rolePromoter == 'Promotor(a) independiente'): ?>
							<?php foreach ($children as $childrens): ?>
				        		<?php $swChildren = 1; ?>
					        	<h5 style="margin-left: 10px;"><?= $childrens->full_name ?></h5>
								<div class="table-responsive" style="margin-left: 20px;">
								    <table class="table table-striped table-hover">
								        <thead>
								            <tr>
								            	<th scope="col" style="width: 10%;">Paciente</th>
								            	<th scope="col" style="width: 10%;">Nro presupuesto</th>
								                <th scope="col" style="width: 10%;">Presupuesto</th>
								                <th scope="col" style="width: 10%;">Nro factura</th>
								                <th scope="col" style="width: 10%;">Monto (Bs.)</th>
												<th scope="col" style="width: 10%;">Monto ($)</th>
								            </tr>
								        </thead>
								        <tbody>
								        	<?php $accountBudget = 0 ?>
								        	<?php $swBudgetsChildren = 0; ?>
								            <?php foreach ($budgetsG as $budgetsGs): ?>
								            	<?php if ($budgetsGs->patient->user->parent_user == $childrens->id): ?>
												<?php $keyArray = 'u' . $father . 'b' . $budgetsGs->id; ?> 
												<?php if (isset($arrayCommissions[$keyArray]) || $budgetsGs->number_bill == null): ?>
								            		<?php $swBudgetsChildren = 1; ?>
									                <tr>
									            		<?php if ($accountBudget == 0): ?>
									            			<?php $namePatient = $budgetsGs->patient->user->full_name ?>
									            			<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
									            		<?php else: ?>
									            			<?php if ($namePatient != $budgetsGs->patient->user->full_name): ?>
									            				<?php $namePatient = $budgetsGs->patient->user->full_name ?>
									            				<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
									            			<?php else: ?>
											                	<td style="width: 10%;"></td>
											                <?php endif; ?>
									            		<?php endif; ?>
									            		<td style="width: 10%;"><?= h($budgetsGs->number_budget) ?></td>
									                    <td style="width: 10%;"><?= h($budgetsGs->surgery) ?></td>
									                    <td style="width: 10%;"><?= h($budgetsGs->number_bill) ?></td>
														<?php if ($budgetsGs->coin == 'BOLIVAR'): ?>
															<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
															<td style="width: 10%;"></td>
															<?php $ventasHijosBolivar+= $budgetsGs->amount_bill; ?>
															<?php if (isset($arrayCommissions[$keyArray])): ?>
																<?php $comisionHijosBolivar+= $arrayCommissions[$keyArray]; ?>
															<?php endif; ?>
														<?php else: ?>
															<td style="width: 10%;"></td>
															<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
															<?php $ventasHijosDolar+= $budgetsGs->amount_bill; ?>
															<?php if (isset($arrayCommissions[$keyArray])): ?>
																<?php $comisionHijosDolar+= $arrayCommissions[$keyArray]; ?>
															<?php endif; ?>
														<?php endif; ?>
									                </tr>
									                <?php $accountBudget++; ?>	
												<?php endif; ?>	
								                <?php endif; ?>
								            <?php endforeach; ?>
								        </tbody>
								    </table>     								    
		       				        <?php if ($swBudgetsChildren == 0): ?>
							        	<p style="margin-left: 10px;">Este promotor no tiene presupuestos activos</p>
							        <?php endif; ?>      
								</div> 
							<?php endforeach; ?>
						<?php endif; ?>
				        <?php if ($swChildren == 0): ?>
				        	<p style="margin-left: 10px;">Este promotor no tiene hijos</p>
				        <?php endif; ?>
						<p style="margin-left: 30px;"><b><?php echo 'Total ventas en bolívares realizadas por los hijos (Bs.): ' . number_format($ventasHijosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 30px;"><b><?php echo 'Comisiones por ventas en bolívares realizadas por los hijos (Bs.): ' . number_format($comisionHijosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 30px;"><b><?php echo 'Total ventas en dólares realizadas por los hijos ($): ' . number_format($ventasHijosDolar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 30px;"><b><?php echo 'Comisiones por ventas en dólares realizadas por los hijos ($): ' . number_format($comisionHijosDolar, 2, ",", "."); ?></b></p>
				    </div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-md-9">
			   	   	<div id="hijos-nietos" style="margin-left: 10px; display:none;">
				    	<h5>Hijos y nietos</h5>
				    	<?php $swChildren = 0; ?>
				    	<?php $swGrandchildren = 0; ?>
						<?php $ventasNietosBolivar = 0; ?>
				    	<?php $comisionNietosBolivar = 0; ?>
						<?php $ventasNietosDolar = 0; ?>
						<?php $comisionNietosDolar = 0; ?>
						<?php if ($rolePromoter == 'Promotor(a)' || $rolePromoter == 'Promotor(a) independiente'): ?>
							<?php foreach ($children as $childrens): ?>
					        	<?php $swChildren = 1; ?>
					        	<h5 style="margin-left: 10px;"><?= $childrens->full_name ?></h5>
					            <?php foreach ($grandchildren as $grandchildrens): ?>
					            	<?php if ($grandchildrens->parent_user == $childrens->id): ?>
					            		<?php $swGrandchildren = 1; ?>
					        			<h5 style="margin-left: 20px;"><?= $grandchildrens->full_name ?></h5>
										<div class="table-responsive" style="margin-left: 30px;">
										    <table class="table table-striped table-hover">
										        <thead>
										            <tr>
										            	<th scope="col" style="width: 10%;">Paciente</th>
										            	<th scope="col" style="width: 10%;">Nro presupuesto</th>
										                <th scope="col" style="width: 10%;">Presupuesto</th>
										                <th scope="col" style="width: 10%;">Nro factura</th>
										                <th scope="col" style="width: 10%;">Monto (Bs.)</th>
														<th scope="col" style="width: 10%;">Monto ($)</th>
										            </tr>
										        </thead>
										        <tbody>
										        	<?php $accountBudget = 0 ?>
										        	<?php $swBudgetsGrandchildren = 0; ?>
										            <?php foreach ($budgetsG as $budgetsGs): ?>
										            	<?php if ($budgetsGs->patient->user->parent_user == $grandchildrens->id): ?>
														<?php $keyArray = 'u' . $father . 'b' . $budgetsGs->id; ?> 
														<?php if (isset($arrayCommissions[$keyArray]) || $budgetsGs->number_bill == null): ?>
										            		<?php $swBudgetsGrandchildren = 1; ?>
											                <tr>
											            		<?php if ($accountBudget == 0): ?>
											            			<?php $namePatient = $budgetsGs->patient->user->full_name ?>
											            			<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
											            		<?php else: ?>
											            			<?php if ($namePatient != $budgetsGs->patient->user->full_name): ?>
											            				<?php $namePatient = $budgetsGs->patient->user->full_name ?>
											            				<td style="width: 10%;"><?= h($budgetsGs->patient->user->full_name) ?></td>
											            			<?php else: ?>
													                	<td style="width: 10%;"></td>
													                <?php endif; ?>
											            		<?php endif; ?>
											            		<td style="width: 10%;"><?= h($budgetsGs->number_budget) ?></td>
											                    <td style="width: 10%;"><?= h($budgetsGs->surgery) ?></td>
											                    <td style="width: 10%;"><?= h($budgetsGs->number_bill) ?></td>
																<?php if ($budgetsGs->coin == 'BOLIVAR'): ?>
																	<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
																	<td style="width: 10%;"></td>
																	<?php $ventasNietosBolivar+= $budgetsGs->amount_bill; ?>
																	<?php if (isset($arrayCommissions[$keyArray])): ?>
																		<?php $comisionNietosBolivar+= $arrayCommissions[$keyArray]; ?>
																	<?php endif; ?>
																<?php else: ?>
																	<td style="width: 10%;"></td>
																	<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
																	<?php $ventasNietosDolar+= $budgetsGs->amount_bill; ?>
																	<?php if (isset($arrayCommissions[$keyArray])): ?>
																		<?php $comisionNietosDolar+= $arrayCommissions[$keyArray]; ?>
																	<?php endif; ?>	
																	</tr>
																<?php endif; ?>	
																<?php $accountBudget++; ?>
														<?php endif; ?>
														<?php endif; ?>
										            <?php endforeach; ?>
										        </tbody>
										    </table>        									    
				       				        <?php if ($swBudgetsGrandchildren == 0): ?>
									        	<p style="margin-left: 10px;">Este promotor no tiene presupuestos activos</p>
									        <?php endif; ?>            
										</div> 
					        		<?php endif; ?>
				            	<?php endforeach; ?>
							<?php endforeach; ?>
						<?php endif; ?>
				        <?php if ($swChildren == 0): ?>
				        	<p style="margin-left: 10px;">Este promotor no tiene hijos</p>
				        <?php endif; ?>
				        <?php if ($swGrandchildren == 0): ?>
				        	<p style="margin-left: 20px;">Este promotor no tiene nietos</p>
				        <?php endif; ?>
						<p style="margin-left: 40px;"><b><?php echo 'Total ventas en bolívares realizadas por los nietos (Bs.): ' . number_format($ventasNietosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 40px;"><b><?php echo 'Comisiones por ventas en bolívares realizadas por los nietos (Bs.): ' . number_format($comisionNietosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 40px;"><b><?php echo 'Total ventas en dólares realizadas por los nietos ($): ' . number_format($ventasNietosDolar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 40px;"><b><?php echo 'Comisiones por ventas en dólares realizadas por los nietos ($): ' . number_format($comisionNietosDolar, 2, ",", "."); ?></b></p>
				    </div>
			    </div>
			</div>

		    <div id="menu-menos-promotor" class="menumenos">
		        <p>
		        <a href="#" id="menu-mas" title="Más opciones" class='glyphicon glyphicon-plus btn btn-danger'></a>
		        </p>
		    </div>
		    <div id="menu-mas-promotor" style="display:none;" class="menumas">
		        <p>
		        <a href="#" id="ver-pacientes-atendidos" title="Ver pacientes atendidos" class='glyphicon icon-avatarpromotor btn btn-danger' style='padding: 8px 12px 10px 12px;'></a>
		        <a href="#" id="ver-hijos" title="Ver hijos" class='glyphicon icon-avatarpadre btn btn-danger' style='padding: 8px 12px 10px 12px;'></a>
		        <a href="#" id="ver-hijos-nietos" title="Ver hijos y nietos" class='glyphicon icon-avatarabuelo btn btn-danger' style='padding: 8px 12px 10px 12px;'></a>
		        <a href="#" id="menu-menos" title="Cerrar opciones" class='glyphicon glyphicon-remove btn btn-danger'></a>
		        </p>
		    </div>

		<?php endif; ?>
    </div>
</div>
<script>
function log(id, promoter) 
{
    $.redirect('../budgets/multilevel', { father : id, controller : 'Users', action : 'wait', promoter : promoter }); 
}
$(document).ready(function()
{ 
    $('#menu-mas').on('click',function()
    {
        $('#menu-menos-promotor').hide();
        $('#menu-mas-promotor').show();
    });
    $('#menu-menos').on('click',function()
    {
        $('#menu-mas-promotor').hide();
        $('#menu-menos-promotor').show();
    });
    $('#ver-pacientes-atendidos').on('click',function()
    {
        $('#hijos').slideUp();
        $('#hijos-nietos').slideUp();
    	$('#pacientes-atendidos').toggle('slow');
    });
    $('#ver-hijos').on('click',function()
    {
        $('#pacientes-atendidos').slideUp();
        $('#hijos-nietos').slideUp();
    	$('#hijos').toggle('slow');
    });
    $('#ver-hijos-nietos').on('click',function()
    {
        $('#pacientes-atendidos').slideUp();
        $('#hijos').slideUp();
    	$('#hijos-nietos').toggle('slow');
    });
    $('#promoter').autocomplete(
    {
        source:'<?php echo Router::url(array("controller" => "Users", "action" => "findPromoterMulti")); ?>',
        minLength: 3,             
        select: function( event, ui ) {
            log(ui.item.id, ui.item.value);
          }
    });
});
</script>