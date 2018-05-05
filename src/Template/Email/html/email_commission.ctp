<?php
	use Cake\I18n\Time;
?>
<div style="width: 100%; float: left;"> 
	<img src='http://cirugiaslanacional.com/sln/webroot/img/logo.png' width = 200 height = 75 />
</div>
<div style="width: 100%; float: left;">
	<p>Rif: J-40024519-2</p>
	<p><img src='http://cirugiaslanacional.com/sln/webroot/img/iconubicacionr.png' width = 15 height = 15 />Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
	<p><img src='http://cirugiaslanacional.com/sln/webroot/img/iconcellr.png' width = 15 height = 15 />+58-0241-835-2284</p>
</div>
<div>
	<?php if ($varTypeEmail == 'Original'): ?>
		<h3>Recibo de Pago de Comisión</h3>
		<p>Estimado <?= $varPromoter ?>, hemos abonado a su cuenta el pago que se detalla a continuación:</>
	<?php elseif ($varTypeEmail == 'Modificación'): ?>
		<h3>** Corrección ** recibo de Pago de Comisión</h3>
		<p>Estimado <?= $varPromoter ?>, rectificamos el abono realizado en su cuenta que se detalla a continuación:</>	
	<?php else: ?>
		<h3>** Anulación ** recibo de Pago de Comisión</h3>
		<p>Estimado <?= $varPromoter ?>, anulamos el recibo del abono en su cuenta que se detalla a continuación:</>
	<?php endif; ?>
	
	<div style="width: 5%; float: left;">
		<p></p>
	</div>
	<div style="width: 95%; float: left;">
			
		<p>Beneficiario: <?= $varPromoter ?></p>
		
		<p>Nro. de identificación: <?= $varIdentification ?></p>

		<?php if ($varCoin == 'BOLIVAR'): ?>
			<p>Monto (Bs.F) <?= number_format($varAmount, 2, ",", ".") ?></p>
			<p>Monto (Bs.S) <?= number_format(($varAmount/1000), 2, ",", ".") ?></p>
		<?php else: ?>
			<p>Monto ($) <?= number_format($varAmount, 2, ".", ",") ?></p>
		<?php endif; ?>
		
		<p>Por concepto de comisión ganada por el servicio: <?= $varBudgetService ?></p>
		
		<p>Cuenta: <?= $varAccount ?></p>
		
		<p>Nro. de comprobante: <?= $varReference ?></p>
		
		<p>Fecha: <?= $varDate->format('d-m-Y') ?></p>
		
		<p><b>Atentamente, Cirugías La Nacional, C.A.</b></p>
	</div>
</div>