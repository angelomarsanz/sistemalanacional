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
		<h2>Multinivel</h2>
		<?php if (isset($budgetsG)): ?>
			<h3 style="margin-left: 10px;"><?= $promoter ?></h3>
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
				            		<?php $comisionPadreBolivar = 0; ?>
									<?php $comisionPadreDolar = 0; ?>
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
												<?php if ($budgetsGs->coin_bill == 'BOLIVAR'): ?>
													<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
													<td style="width: 10%;"></td>
													<?php $comisionPadreBolivar+= $budgetsGs->amount_bill; ?>
												<?php else: ?>
													<td style="width: 10%;"></td>
													<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
													<?php $comisionPadreDolar+= $budgetsGs->amount_bill; ?>
												<?php endif; ?>
							                </tr>						           
							                <?php $accountBudget++; ?>
										<?php endif; ?>
						                <?php endif; ?>
						            <?php endforeach; ?>
						        </tbody>
						    </table>                    
       				        <?php if ($swBudgetsFather == 0): ?>
					        	<p style="margin-left: 10px;">Este promotor no tiene presupuestos activos</p>
					        <?php endif; ?>
				            <p style="margin-left: 10px;"><b><?php echo 'Total ventas propias en bolívares: Bs. ' . number_format($comisionPadreBolivar, 2, ",", "."); ?></b></p>
				            <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas propias en bolívares (3%): Bs. ' . number_format(($comisionPadreBolivar * 0.03), 2, ",", "."); ?></b></p>
							<p style="margin-left: 10px;"><b><?php echo 'Total ventas propias en dólares: $ ' . number_format($comisionPadreDolar, 2, ",", "."); ?></b></p>
				            <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas propias en dólares (3%): $ ' . number_format(($comisionPadreDolar * 0.03), 2, ",", "."); ?></b></p>
						</div> 
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-9">
			   	   	<div id="hijos" style="margin-left: 10px; display:none;">
				    	<h4>Hijos</h4>
    			    	<?php $comisionHijosBolivar = 0; ?>
						<?php $comisionHijosDolar = 0; ?>
				    	<?php $swChildren = 0; ?>
				        <?php foreach ($children as $childrens): ?>
				        	<?php if ($rolePromoter != 'Coordinador(a)'): ?>
				        		<?php $swChildren = 1; ?>
					        	<h4 style="margin-left: 10px;"><?= $childrens->full_name ?></h4>
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
												<?php $keyArray = 'u' . $budgetsGs->patient->user->parent_user . 'b' . $budgetsGs->id; ?> 
												<?php if (isset($arrayCommissions[$keyArray])): ?>
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
														<?php if ($budgetsGs->coin_bill == 'BOLIVAR'): ?>
															<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
															<td style="width: 10%;"></td>
															<?php $comisionHijosBolivar+= $budgetsGs->amount_bill; ?>
														<?php else: ?>
															<td style="width: 10%;"></td>
															<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
															<?php $comisionHijosDolar+= $budgetsGs->amount_bill; ?>
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
						    <?php endif; ?>
				        <?php endforeach; ?>
				        <?php if ($swChildren == 0): ?>
				        	<p style="margin-left: 10px;">Este promotor no tiene hijos</p>
				        <?php endif; ?>
						<p style="margin-left: 10px;"><b><?php echo 'Total ventas en bolívares realizadas por los hijos: Bs. ' . number_format($comisionHijosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas en bolívares (1.5%) realizadas por los hijos: Bs. ' . number_format(($comisionHijosBolivar * 0.03), 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Total ventas en dólares realizadas por los hijos: $ ' . number_format($comisionHijosDolar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas en dólares (1.5%) realizadas por los hijos: $ ' . number_format(($comisionHijosDolar * 0.03), 2, ",", "."); ?></b></p>
				    </div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-md-9">
			   	   	<div id="hijos-nietos" style="margin-left: 10px; display:none;">
				    	<h4>Hijos y nietos</h4>
				    	<?php $swChildren = 0; ?>
				    	<?php $swGrandchildren = 0; ?>
				    	<?php $comisionNietosBolivar = 0; ?>
						<?php $comisionNietosDolar = 0; ?>
				        <?php foreach ($children as $childrens): ?>
				        	<?php if ($rolePromoter != 'Coordinador(a)'): ?>
					        	<?php $swChildren = 1; ?>
					        	<h4 style="margin-left: 10px;"><?= $childrens->full_name ?></h4>
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
														<?php $keyArray = 'u' . $budgetsGs->patient->user->parent_user . 'b' . $budgetsGs->id; ?> 
														<?php if (isset($arrayCommissions[$keyArray])): ?>
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
																<?php if ($budgetsGs->coin_bill == 'BOLIVAR'): ?>
																	<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
																	<td style="width: 10%;"></td>
																	<?php $comisionNietosBolivar+= $budgetsGs->amount_bill; ?>
																<?php else: ?>
																	<td style="width: 10%;"></td>
																	<td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
																	<?php $comisionNietosDolar+= $budgetsGs->amount_bill; ?>
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
				        	<?php endif; ?>
				        <?php endforeach; ?>
				        <?php if ($swChildren == 0): ?>
				        	<p style="margin-left: 10px;">Este promotor no tiene hijos</p>
				        <?php endif; ?>
				        <?php if ($swGrandchildren == 0): ?>
				        	<p style="margin-left: 20px;">Este promotor no tiene nietos</p>
				        <?php endif; ?>
						<p style="margin-left: 10px;"><b><?php echo 'Total ventas en bolívares realizadas por los nietos: Bs. ' . number_format($comisionNietosBolivar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas en bolívares (3%) realizadas por los nietos: Bs. ' . number_format(($comisionNietosBolivar * 0.03), 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Total ventas en dólares realizadas por los nietos: $ ' . number_format($comisionNietosDolar, 2, ",", "."); ?></b></p>
						<p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas en dólares (0,5%) realizadas por los nietos: $ ' . number_format(($comisionNietosDolar * 0.03), 2, ",", "."); ?></b></p>
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
		        <a href="#" id="ver-pacientes-atendidos" title="Ver pacientes atendidos" class='glyphicon glyphicon-user btn btn-danger'></a>
		        <a href="#" id="ver-hijos" title="Ver hijos" class='glyphicon glyphicon-user btn btn-danger'></a>
		        <a href="#" id="ver-hijos-nietos" title="Ver hijos y nietos" class='glyphicon glyphicon-user btn btn-danger'></a>
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