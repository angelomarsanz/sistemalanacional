<div style="width: 100%; float: left;"> 
	<img src='http://cirugiaslanacional.com/sln/webroot/img/logo.png' width = 200 height = 75 />
</div>
<div style="width: 100%; float: left;">
	<p>Rif: J-40024519-2</p>
	<p><img src='http://cirugiaslanacional.com/sln/webroot/img/iconubicacionr.png' width = 15 height = 15 />Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
	<p><img src='http://cirugiaslanacional.com/sln/webroot/img/iconcellr.png' width = 15 height = 15 />+58-0241-835-2284</p>
</div>
<div style="width: 5%; float: left;">
	<img src='http://cirugiaslanacional.com/sln/webroot/img/avatar.png' width = 50 height = 50 />
</div>
<div style="width: 95%; float: left;">
	<h3>CLIENT DATA / DATOS DEL CLIENTE</h3>
	<p>Name / Nombre / Razón social: <?= $varPatient ?></p>
	<p>ID / Documento de identidad: <?= $varIdentidy ?></p>
	<p>Phone / Teléfono: <?= $varPhone ?></p>
	<p>Address / Dirección: <?= $varAddress ?></p>
	<p>Country / país: <?= $varCountry ?></p>
</div>
<div style="width: 5%; float: left;">
	<img src='http://cirugiaslanacional.com/sln/webroot/img/iconopresupuestor.png' width = 50 height = 50 />
</div>
<div style="width: 95%; float: left;">
	<h3>BUDGET / PRESUPUESTO</h3>
	<p>Budget / Presupuesto Nro. <?= $varId ?> </p>
	<p>Start Date / Fecha de emisión: <?= $varStartDate->format('d-m-Y') ?></p>
	<p>Expiration date / Fecha de vencimiento: <?= $varExpirationDate->format('d-m-Y') ?></p>
	<p>Service requested / Servicio requerido: <?= $varSurgery ?></p>
</div>
<div style="width: 5%; float: left;">
	<img src='http://cirugiaslanacional.com/sln/webroot/img/lupar.png' width = 50 height = 50 />
</div>
<div style="width: 95%; float: left;">
	<h3>DETAILS / DETALLES</h3>
	<?= $varItemes ?>
	<br />
	<?php if (strtoupper($varCountry) == 'VENEZUELA'; ?>
		<h3>TOTAL GENERAL / GRAND TOTAL Bs. <?= number_format($varTotal, 2, ",", ".") ?></h3>
	<?php else: ?>
		<h3>TOTAL GENERAL / GRAND TOTAL $ <?= number_format($varTotal, 2, ".", ",") ?></h3>		
	<?php endif; ?>
	<br />
</div>
<p>Al aprobar el presente presupuesto y completar el proceso de compra y pago
del mismo, usted confirma que leyó y aceptó los Términos y Condiciones de nuestros servicios</p>
<p>Por favor no responder a este email, cualquier información comunicarse con:</p>
<?php if ($varNamePromoter == 'Sitio web'): ?>
	<p>Nuestro Call Center al +58-0241-835-2284</p>
<?php else: ?>
	<p>El promotor(a): <?= $varNamePromoter . ' teléfono ' . $varPhonePromoter . ' email ' . $varMailPromoter ?></p>
<?php endif; ?>
</div>