   <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">
                  <img src="usuarios/<?php echo $_SESSION['foto']?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                  <p><?php echo $_SESSION['nombre']?></p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>
              
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                  <li class="header">SUPER ADMNISTRADOR</li>
                                  <li>
                      <a href="usuarios.php">
                        <i class="fa fa-sitemap"></i> <span>Usuarios</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                                <li>
                      <a href="licencias.php">
                        <i class="fa fa-sitemap"></i> <span>Licencias</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li> 
                      <li class="header">DOCTORES</li>
                                  <li>
                      <a href="opiniones.php">
                        <i class="fa fa-commenting-o"></i> <span>Opiniones</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                                <li>
                      <a href="licencias.php">
                        <i class="fa fa-medkit"></i> <span>Doctores</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                      <li class="header">HOSPITALES</li>
                                  <li>
                      <a href="usuarios.php">
                        <i class="fa fa-sitemap"></i> <span>Usuarios</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                                <li>
                      <a href="licencias.php">
                        <i class="fa fa-sitemap"></i> <span>Licencias</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                      <li class="header">FARMACIAS</li>
                                  <li>
                      <a href="usuarios.php">
                        <i class="fa fa-sitemap"></i> <span>Usuarios</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                                <li>
                      <a href="licencias.php">
                        <i class="fa fa-sitemap"></i> <span>Licencias</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>    
                     <li class="header">LABORATORIOS</li>
                                  <li>
                      <a href="usuarios.php">
                        <i class="fa fa-sitemap"></i> <span>Usuarios</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>
                                <li>
                      <a href="licencias.php">
                        <i class="fa fa-sitemap"></i> <span>Licencias</span>
                        <small class="label pull-right bg-red"></small>
                      </a>
                    </li>       
              </ul>
            </section>
            <!-- /.sidebar -->