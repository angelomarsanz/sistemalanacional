<h2>Cirugías La Nacional, C.A.</h2>
<p>Rif: J-40024519-2</p>
<p>Avenida Bolívar Sur, Valencia 2001, Carabobo, Venezuela</p>
<p>+58-0241-835-2284</p>
<br />
<h3>---------------- CLIENT DATA / DATOS DEL CLIENTE -----------------</h3>
<p>Name / Nombre / Razón social: <?= $varPatient ?></p>
<p>ID / Documento de identidad: <?= $varIdentidy ?></p>
<p>Phone / Teléfono: <?= $varPhone ?></p>
<p>Address / Dirección: <?= $varAddress ?></p>
<p>Country / país: <?= $varCountry ?></p>
<br />
<h3>--------------- BUDGET / PRESUPUESTO ------------------------------</h3>
<p>Budget / Presupuesto Nro. <?= $varId ?> </p>
<p>Start Date / Fecha de emisión: <?= $varStartDate->format('d-m-Y') ?></p>
<p>Expiration date / Fecha de vencimiento: <?= $varExpirationDate->format('d-m-Y') ?></p>
<p>Service requested / Servicio requerido: <?= $varSurgery ?></p>
<h3>--------------- DETAILS / DETALLES ---------------------------------</h3>
<?= $varItemes ?>
<BR />
<h3>TOTAL GENERAL Bs. <?= number_format($varTotal, 2, ",", ".") ?></h3>
<br />
<p>Al aprobar el presente presupuesto y completar el proceso de compra y pago
del mismo, usted confirma que leyó y aceptó los Términos y Condiciones de 
nuestros servicios</p>