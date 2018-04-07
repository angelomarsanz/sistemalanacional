<style>
    .iconoMenu
    {
        padding-left: 10px;
        color: #9494b8;
        font-size: 150%;
    }
    .logo
    {
        padding: 5px;
        margin: 5px;
        border: 0;
        background-color: #00ffcc;
     }

</style>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #00ffcc;">
    <div class="container-fluid">
        <div class="navbar-header">

            <a href='/sln/users/home'><img src='/sln/img/logo.png' width = 100 height = 35 class="img-thumbnail img-responsive logo"/></a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>  
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($current_user)): ?>
                <ul class="nav navbar-nav">
                    <li><?=  $this->Html->link('', ['controller' => 'Users', 'action' => 'home'], ['class' => "glyphicon glyphicon-home iconoMenu", 'title' => 'Inicio']) ?></li>
					<li><?=  $this->Html->link('', ['controller' => 'Users', 'action' => 'edit', $current_user['id']], ['class' => "glyphicon glyphicon-user iconoMenu", 'title' => 'Modificar mi perfil']) ?></li>
					
                    <?php if($current_user['role'] == 'Desarrollador del sistema'): ?>
                        <li><?=  $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Multinivel', ['controller' => 'Budgets', 'action' => 'multilevel']) ?></li>

                        <li><?=  $this->Html->link('Pacientes', ['controller' => 'Users', 'action' => 'indexPatientUser']) ?></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=  $this->Html->link('Agenda del día', ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
                                <li><?=  $this->Html->link('Agenda futura', ['controller' => 'Diarypatients', 'action' => 'indexMonth']) ?></li>
								<li><?=  $this->Html->link('Reporte', ['controller' => 'Diarypatients', 'action' => 'reportDiary']) ?></li>
                           </ul>
                        </li>

                        <li><?=  $this->Html->link('Servicios', ['controller' => 'Services', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Comisiones', ['controller' => 'Budgets', 'action' => 'bill']) ?></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sistema <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=  $this->Html->link('Interruptores del sistema', ['controller' => 'Systems', 'action' => 'systemSwitch']) ?></li>
                                <li><?=  $this->Html->link('Verificar servidor', ['controller' => 'Users', 'action' => 'serverError']) ?></li>
                           </ul>
                        </li>
                        
                        <?php if (isset($currentView)): ?>    
                            <?php if ($currentView == 'multilevel'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="promoter" class="form-control" placeholder="Buscar promotor..." title="Escriba el primer apellido del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'bill'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="number-budget-search" class="form-control" placeholder="Buscar presupuesto..." title="Escriba el número del presupuesto"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'usersViewGlobal' || $currentView == 'indexPatientUser'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="patient" class="form-control" placeholder="Buscar paciente..." title="Escriba el primer apellido del paciente"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'usersView' || $currentView == 'usersIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="user" class="form-control" placeholder="Buscar usuario..." title="Escriba el primer apellido del usuario"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'servicesIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="service" class="form-control" placeholder="Buscar servicio..." title="Escriba el nombre del servicio médico"/>
                                    </div>
                                </form>
                            <?php endif; ?>
							<?php if ($currentView == 'DiarypatientsIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="diary-promoter" class="form-control" placeholder="Promotor..." title="Escriba el nombre del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php elseif ($current_user['role'] == 'Administrador del sistema' ||
                        $current_user['role'] == 'Titular del sistema' ||
                        $current_user['role'] == 'Auditor(a) externo' ||
                        $current_user['role'] == 'Auditor(a) interno'): ?>

                        <li><?=  $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Multinivel', ['controller' => 'Budgets', 'action' => 'multilevel']) ?></li>

                        <li><?=  $this->Html->link('Pacientes', ['controller' => 'Users', 'action' => 'indexPatientUser']) ?></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=  $this->Html->link('Agenda del día', ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
                                <li><?=  $this->Html->link('Agenda futura', ['controller' => 'Diarypatients', 'action' => 'indexMonth']) ?></li>
                           </ul>
                        </li>

                        <li><?=  $this->Html->link('Servicios', ['controller' => 'Services', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Facturación', ['controller' => 'Budgets', 'action' => 'bill']) ?></li>

                        <?php if (isset($currentView)): ?>    
                            <?php if ($currentView == 'multilevel'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="promoter" class="form-control" placeholder="Buscar promotor..." title="Escriba el primer apellido del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>

                            <?php if ($currentView == 'bill'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="number-budget-search" class="form-control" placeholder="Buscar presupuesto..." title="Escriba el número del presupuesto"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            
                            <?php if ($currentView == 'usersViewGlobal' || $currentView == 'indexPatientUser'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="patient" class="form-control" placeholder="Buscar paciente..." title="Escriba el primer apellido del paciente"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'usersView' || $currentView == 'usersIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="user" class="form-control" placeholder="Buscar usuario..." title="Escriba el primer apellido del usuario"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'servicesIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="service" class="form-control" placeholder="Buscar servicio..." title="Escriba el nombre del servicio médico"/>
                                    </div>
                                </form>
                            <?php endif; ?>
							<?php if ($currentView == 'DiarypatientsIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="diary-promoter" class="form-control" placeholder="Promotor..." title="Escriba el nombre del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>

                        <?php endif; ?>

                    <?php elseif ($current_user['role'] == 'Coordinador(a)'): ?>
                    
                        <li><?=  $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Multinivel', ['controller' => 'Budgets', 'action' => 'multilevel']) ?></li>

                        <li><?=  $this->Html->link('Pacientes', ['controller' => 'Users', 'action' => 'indexPatientUser']) ?></li>
						
						<li><?=  $this->Html->link('Servicios', ['controller' => 'Services', 'action' => 'index']) ?></li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=  $this->Html->link('Agenda del día', ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
                                <li><?=  $this->Html->link('Agenda futura', ['controller' => 'Diarypatients', 'action' => 'indexMonth']) ?></li>
                           </ul>
                        </li>

                        <?php if (isset($currentView)): ?>    
                            <?php if ($currentView == 'multilevel'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="promoter" class="form-control" placeholder="Buscar promotor..." title="Escriba el primer apellido del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>

                            <?php if ($currentView == 'usersViewGlobal' || $currentView == 'indexPatientUser'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="patient" class="form-control" placeholder="Buscar paciente..." title="Escriba el primer apellido del paciente"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'usersView' || $currentView == 'usersIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="user" class="form-control" placeholder="Buscar usuario..." title="Escriba el primer apellido del usuario"/>
                                    </div>
                                </form>
                            <?php endif; ?>
                            <?php if ($currentView == 'servicesIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="service" class="form-control" placeholder="Buscar servicio..." title="Escriba el nombre del servicio médico"/>
                                    </div>
                                </form>
                            <?php endif; ?>
							<?php if ($currentView == 'DiarypatientsIndex'): ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" id="diary-promoter" class="form-control" placeholder="Promotor..." title="Escriba el nombre del promotor"/>
                                    </div>
                                </form>
                            <?php endif; ?>

                        <?php endif; ?>

                    <?php elseif ($current_user['role'] == 'Promotor(a)' || $current_user['role'] == 'Promotor(a) independiente'): ?>

                        <li><?=  $this->Html->link('Usuarios', ['controller' => 'Users', 'action' => 'index']) ?></li>

                        <li><?=  $this->Html->link('Multinivel', ['controller' => 'Budgets', 'action' => 'multilevel']) ?></li>

                        <li><?=  $this->Html->link('Pacientes', ['controller' => 'Users', 'action' => 'indexPatientUser']) ?></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?=  $this->Html->link('Agenda del día', ['controller' => 'Diarypatients', 'action' => 'index']) ?></li>
                                <li><?=  $this->Html->link('Agenda futura', ['controller' => 'Diarypatients', 'action' => 'indexMonth']) ?></li>
                           </ul>
                        </li>

                    <?php elseif ($current_user['role'] == 'Call center'): ?> 
                        <li><?=  $this->Html->link('Pacientes', ['controller' => 'Users', 'action' => 'indexPatientUser']) ?></li>
                    <?php endif; ?>                   
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <?= $this->Html->link('', ['controller' => 'Users', 'action' => 'logout'], ['class' => "glyphicon glyphicon-log-out iconoMenu", 'title' => 'Salir del sistema']) ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>                        