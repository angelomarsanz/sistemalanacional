<div class="container">
    <div class="page-header">    
        <?php if ($controller == null): ?>
     	    <p><?= $this->Html->link(__('Volver'), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php else: ?> 
 	       <p><?= $this->Html->link(__('Volver'), ['controller' => $controller, 'action' => $action], ['class' => 'btn btn-sm btn-default']) ?></p>
        <?php endif; ?>
        <h2>Presupuesto enviado al paciente: <?= $namePatient ?></h2>
    </div>
    <div class="row">
        <div class="col col-sm-12">
			<?php if ($budget->initial_budget == null): ?>
				<!-- if (substr($budget->number_budget, 0, 3) == 'APP' && $budget->amount_budget > 0): -->
					<?php if (substr($budget->number_budget, 0, 3) == 'APP'): ?>
					<?php if ($current_user['role'] == 'Desarrollador del sistema' ||
							$current_user['role'] == 'Administrador del sistema' ||
							$current_user['role'] == 'Titular del sistema'): ?>				
						<h3>Cirugías La Nacional, C.A.</h3>
						<p>Rif: J-40024519-2</p>
						<p>Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
						<p>+58-0241-835-2284</p>
						<br />
						<h5>---------------- CLIENT DATA / DATOS DEL CLIENTE -----------------</h5>
						<p>Name / Nombre / Razón social: <?= $namePatient ?></p>
						<?php if ($namePromoter != 'Sitio  Web '): ?>
							<p>Promoter assigned / Promotor asignado: <?= $namePromoter ?></p>
							<p>Promoter phone / Teléfono promotor: <?= $cellPromoter ?></p>
							<p>Promoter email / Correo del promotor: <?= $emailPromoter ?></p>
						<?php endif; ?>			
						<p>Phone / Teléfono: <?= $budget->patient->user->cell_phone ?></p>
						<p>Address / Dirección: <?= $budget->patient->address ?></p>
						<p>Country / país: <?= $budget->patient->country ?></p>
						<br />
						<h5>--------------- BUDGET / PRESUPUESTO ------------------------------</h5>
						<p>Budget / Presupuesto Nro. <?= $budget->number_budget ?> </p>
						<p>Start Date / Fecha de emisión: <?= $budget->application_date->format('d-m-Y') ?></p>
						<p>Expiration date / Fecha de vencimiento: <?= $budget->expiration_date->format('d-m-Y') ?></p>
						<p>Service requested / Servicio requerido: <?= $budget->surgery ?></p>
						<BR />
						<h5>--------------- DETAILS / DETALLES ---------------------------------</h5>
						<?= $itemes ?>
						<BR />
						<?php if ($budget->coin == 'BOLIVAR'): ?>
							<h4>GRAND TOTAL / TOTAL GENERAL Bs. <?= number_format($budget->amount_budget, 2, ",", ".") ?></h4>
						<?php else: ?>
							<h4>GRAND TOTAL / TOTAL GENERAL $ <?= number_format($budget->amount_budget, 2, ".", ",") ?></h4>			
						<?php endif; ?>
						<br />
						<p>Al aprobar el presente presupuesto y completar el proceso de compra y pago
						del mismo, usted confirma que leyó y aceptó los Términos y Condiciones de 
						nuestros servicios</p>				
						<br />
					<?php else: ?>
						<p style="color: red;"><b>*** Aún no se ha enviado el presupuesto al paciente ***</b></p>
					<?php endif; ?>
				<?php else: ?>
					<p style="color: red;"><b>*** Aún no se ha enviado el presupuesto al paciente ***</b></p>
				<?php endif; ?>
			<?php else: ?>
				<?php $pdf = ".pdf"; ?>
				<?php $pos = strpos($budget->initial_budget, $pdf); ?>
				<?php if ($pos): ?>
					<embed src=<?= '/sln/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget ?> type="application/pdf" width="100%" height="400px"></embed>
				<?php else: ?>    
					<?php $txt = ".txt"; ?>  
					<?php $pos = strpos($budget->initial_budget, $txt); ?>
					<?php if ($pos): ?>
						<?php $texto = fopen('http://localhost/sln/webroot/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, "r"); ?>
						<?php echo nl2br($texto); ?> 
					<?php else: ?>
						<?= $this->Html->image('/files/budgets/initial_budget/' . $budget->initial_budget_dir . '/'. $budget->initial_budget, ['class' => 'img-thumbnail img-responsive']) ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
    </div>
</div>