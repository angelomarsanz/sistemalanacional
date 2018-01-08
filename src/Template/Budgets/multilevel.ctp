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
			    <div class="col-md-6">
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
						            </tr>
						        </thead>
						        <tbody>
						        	<?php $accountBudget = 0 ?>
						        	<?php $swBudgetsFather = 0; ?>
				            		<?php $comisionPadre = 0; ?>
						            <?php foreach ($budgetsG as $budgetsGs): ?>
						            	<?php if ($budgetsGs->patient->user->parent_user == $father): ?>
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
							                    <td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
							                </tr>						                
							                <?php $comisionPadre = $comisionPadre + $budgetsGs->amount_bill; ?>
							                <?php $accountBudget++; ?>
						                <?php endif; ?>
						            <?php endforeach; ?>
						        </tbody>
						    </table>                    
       				        <?php if ($swBudgetsFather == 0): ?>
					        	<p style="margin-left: 10px;">Este promotor no ha atendido a ningún paciente</p>
					        <?php endif; ?>
				            <p style="margin-left: 10px;"><b><?php echo 'Total ventas propias: Bs. ' . number_format($comisionPadre, 2, ",", "."); ?></b></p>
				            <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas propias (3%): Bs. ' . number_format(($comisionPadre * 0.03), 2, ",", "."); ?></b></p>
						</div> 
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-6">
			   	   	<div id="hijos" style="margin-left: 10px; display:none;">
				    	<h4>Hijos</h4>
    			    	<?php $comisionHijos = 0; ?>
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
								            </tr>
								        </thead>
								        <tbody>
								        	<?php $accountBudget = 0 ?>
								        	<?php $swBudgetsChildren = 0; ?>
								            <?php foreach ($budgetsG as $budgetsGs): ?>
								            	<?php if ($budgetsGs->patient->user->parent_user == $childrens->id): ?>
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
									                    <td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
									                </tr>
									                <?php $accountBudget++; ?>
									                <?php $comisionHijos = $comisionHijos + $budgetsGs->amount_bill; ?>
								                <?php endif; ?>
								            <?php endforeach; ?>
								        </tbody>
								    </table>     								    
		       				        <?php if ($swBudgetsChildren == 0): ?>
							        	<p style="margin-left: 10px;">Este promotor no ha atendido a ningún paciente</p>
							        <?php endif; ?>      
								</div> 
						    <?php endif; ?>
				        <?php endforeach; ?>
				        <?php if ($swChildren == 0): ?>
				        	<p style="margin-left: 10px;">Este promotor no tiene hijos</p>
				        <?php endif; ?>
				        <p style="margin-left: 10px;"><b><?php echo 'Total ventas realizadas por los hijos: Bs. ' . number_format($comisionHijos, 2, ",", "."); ?></b></p>
                        <p style="margin-left: 10px;"><b><?php echo 'Comisiones por ventas realizadas por los hijos (1,5%): Bs. ' . number_format(($comisionHijos * 0.015), 2, ",", ".") ?></b></p>
				    </div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-md-6">
			   	   	<div id="hijos-nietos" style="margin-left: 10px; display:none;">
				    	<h4>Hijos y nietos</h4>
				    	<?php $swChildren = 0; ?>
				    	<?php $swGrandchildren = 0; ?>
				    	<?php $comisionNietos = 0; ?>
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
										            </tr>
										        </thead>
										        <tbody>
										        	<?php $accountBudget = 0 ?>
										        	<?php $swBudgetsGrandchildren = 0; ?>
										            <?php foreach ($budgetsG as $budgetsGs): ?>
										            	<?php if ($budgetsGs->patient->user->parent_user == $grandchildrens->id): ?>
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
											                    <td style="width: 10%;"><?= number_format($budgetsGs->amount_bill, 2, ",", ".") ?></td>
											                </tr>
											                <?php $accountBudget++; ?>
											                <?php $comisionNietos = $comisionNietos + $budgetsGs->amount_bill; ?>
										                <?php endif; ?>
										            <?php endforeach; ?>
										        </tbody>
										    </table>        									    
				       				        <?php if ($swBudgetsGrandchildren == 0): ?>
									        	<p style="margin-left: 10px;">Este promotor no ha atendido a ningún paciente</p>
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
			            <p style="margin-left: 20px;"><b><?php echo 'Total ventas realizadas por los nietos: Bs. ' . number_format($comisionNietos, 2, ",", "."); ?></b></p>
			            <p style="margin-left: 20px;"><b><?php echo 'Comisiones por ventas realizadas por los nietos (0,5%): Bs. ' . number_format(($comisionNietos * 0.005), 2, ",", "."); ?></b></p>
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