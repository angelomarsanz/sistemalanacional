<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="page-header">
 	    <p>
        <?php if (isset($idUser)): ?>
	        <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action, $idUser, 'Users', 'indexPatientUser'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
        <?php elseif (isset($controller)): ?>
	        <?= $this->Html->link(__(''), ['controller' => $controller, 'action' => $action], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
        <?php else: ?>
    	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-chevron-left btn btn-sm btn-default', 'title' => 'Volver', 'style' => 'color: #9494b8']) ?>
        <?php endif; ?>
	    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'wait'], ['class' => 'glyphicon glyphicon-remove btn btn-sm btn-default', 'title' => 'Cerrar vista', 'style' => 'color: #9494b8']) ?>
        </p>
        <h2>Confirme el presupuesto solicitado por el paciente:</h2>
        </div>
            <?= $this->Form->create($budget) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('surgery', ['label' => 'Servicio médico: *', 'required' => 'true', 'options' => 
                    [null => '',
                    'Apendicectomía' => 'Apendicectomía',
                    'Bichectomía' => 'Bichectomía',
                    'Biopsia de cuello uterino' => 'Biopsia de cuello uterino',
                    'Blefaroplastia' => 'Blefaroplastia',
                    'Braqueoplastia' => 'Braqueoplastia',
                    'Cesárea' => 'Cesárea',
                    'Cierre de lóbulo de la oreja' =>  'Cierre de lóbulo de la oreja',                     
                    'Dermolipectomía + Lipoescultura' => 'Dermolipectomía + Lipoescultura',
                    'Dermolipectomía + Lipotransferencia o Lipofilling' => 'Dermolipectomía + Lipotransferencia o Lipofilling',
                    'Esterilización por laparoscopia' => 'Esterilización por laparoscopia',
                    'Exceresis de lipoma' => 'Exceresis de lipoma',
                    'Histerectomía' => 'Histerectomía', 
                    'Hernia inguinal' => 'Hernia inguinal',
                    'Hernia inguinal + hernia umbilical',
                    'Hernia umbilical' => 'Hernia umbilical',
                    'Jornada de esterilización por laparoscopia' => 'Jornada de esterilización por laparoscopia', 
                    'Legrado uterino' => 'Legrado uterino',
                    'Labioplastia' => 'Labioplastia',
                    'Lifting facial' => 'Lifting facial',  
                    'Lipofilling' => 'Lipofilling',
                    'Litiasis vesicular' => 'Litiasis vesicular',
                    'Marcación abdominal' => 'Marcación abdominal',
                    'Mastectomía parcial reconstructiva' => 'Mastectomía parcial reconstructiva',
                    'Mastopexia de aumento' => 'Mastopexia de aumento',
                    'Mastopexia de aumento + Lipotransferencia o Lipofilling' => 'Mastopexia de aumento + Lipotransferencia o Lipofilling',
                    'Mastopexia + Dermolipectomía + Lipoescultura' => 'Mastopexia + Dermolipectomía + Lipoescultura',
                    'Miomectomía' => 'Miomectomía',
                    'Plan de maternidad' => 'Plan de maternidad',
                    'Prolapso' => 'Prolapso',
                    'Resección trans-uretral de próstata' => 'Resección trans-uretral de próstata',
                    'Rinoplastia' => 'Rinoplastia',
                    'Vaginoplastia' => 'Vaginoplastia',
                    'Varicocele' => 'Varicocele']]);
                ?>
            </fieldset>
        <?= $this->Form->button(__('Confirmar'), ['id' => 'save-user', 'class' =>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>