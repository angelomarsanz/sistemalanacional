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
	<h4>Recibo de Pago de Comisión</h4>

	<p>Estimado <?= $varPromoter ?> ?>, le hemos abonado a su cuenta el pago que se detalla a continuación:</>

	<?php if ($varCoin == 'BOLIVAR'): ?>
		<p>Bs. <? number_format($varAmount, 2, ",", ".") ?></p>
	<?php else: ?>
		<p>$ <? number_format($varAmount, 2, ".", ",") ?></p>
	<?php endif; ?>
	
	<p>Por concepto de comisión ganada por servicio: <?= $varBudgetService ?></p>
	
	<p>Abonado a su cuenta: <?= $varAccount ?></p>
	
	<p>Nro. de comprobante: <?= $varReference ?></p>
	
	<p>De fecha: <?= $varDate->format('d-m-Y') ?></p>
	
	<p>Atentamente, Cirugías La Nacional, C.A.</p>
</div>