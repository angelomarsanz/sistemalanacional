<h2>Estimado (a): <?= $varPromoter ?>,</h2>

<?php if ($varResultPromoter == 0): ?>

    <p>Usted fue registrado exitosamente en el sistema:</p>
    
    <p>El usuario para acceder a la aplicación es: <?= $varUsername ?></p>
    
    <p>La contraseña es: <?= $varPassword ?></p>
    
    <p>Por favor hacer clic en el siguiente enlace e ingresar el usuario y la contraseña</p>
    
    <p>http://cirugiaslanacional.com/sln</p>
    
    <p>Gracias por unirse a nuestro grupo de promotores...</p>

<?php elseif ($varResultPromoter == 1): ?>

    <p>Usted no pudo ser registrado en el sistema, por favor comuníquese al +58-00426-5450845</p>


<?php elseif ($varResultPromoter == 3): ?>	
	
    <p>Los datos de usuario fueron actualizados correctamente</p>
	
<?php else: ?>

    <p>Usted ya estaba registrado anteriormente en el sistema:</p>
    
    <p>El usuario para acceder a la aplicación es: <?= $varUsername ?></p>
    
    <p>La contraseña es: <?= $varPassword ?></p>
    
    <p>Por favor hacer clic en el siguiente enlace e ingresar el usuario y la contraseña</p>
    
    <p>http://cirugiaslanacional.com/sln</p>
    
    <p>Gracias por unirse a nuestro grupo de promotores...</p>

<?php endif; ?>