<p>testFunction</p>
		<?php if (substr($_SERVER['REQUEST_URI'], 1 , 3) == 'sln'): ?> 	
			<p>El error es en la aplicación: <?= substr($_SERVER['REQUEST_URI'], 1 , 3) ?></p>
		<?php elseif (substr($_SERVER['REQUEST_URI'], 1 , 4) == 'dsln'): ?>
			<p>El error es en la aplicación: <?= substr($_SERVER['REQUEST_URI'], 1 , 4) ?></p>)
		<?php else: ?>
			<p>El Error no es en la aplicación</p>
		<?php endif; ?>