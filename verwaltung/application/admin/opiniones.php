<?php require "login/loginheader.php";
include 'funciones.php';?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="ISO-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuarios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- SweetAlert  style -->
    <link rel="stylesheet" href="../../plugins/sweetalert/sweetalert.css">

    <!-- responsive datatables -->
     <link rel="stylesheet" href="../../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <!-- SweetAlert -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Bootstrap-notify -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="../../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    
    <script src="opiniones.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

          <header class="main-header">
           <?php include '../header.php';?>
          </header>

          <!-- =============================================== -->

          <!-- Left side column. contains the sidebar -->
          <aside class="main-sidebar">
         <?php include '../sidebar.php';?>
          </aside>

          <!-- =============================================== -->

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            
            <h1>OPINIONES</h1>
              <h1>
                
                <small>Hera Salud </small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Portada</a></li>
             >
              </ol>
            </section>

            <!-- ========================================================================================================== -->
            <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-body">
                 <button type="submit" class="btn btn-primary " id="btnadd" name="btnadd"><i class="fa fa-plus"></i> Nueva Opinión</button>
                 <br>
                 <br>
                 <div class="box-body" style="max-width:900px;" >
                  <table id="table_cust" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr class="tableheader">
                        <th style="width:40px">#</th>
                        <th style="width:100px">Nombre</th>
                        <th style="width:140px">Apellidos</th>
                        <th style="width:60px">Especialidad</th>
                        <th style="width:80px">Ciudad</th>
                        <th style="width:80px">Estado</th>
                        
                        <th style="width:80px">Pais</th>
                       <th style="width:100px">Verificada</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div id="modalcust" class="modal">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">X</button>
                      <h4 class="modal-title">Formulario de Opiniones</h4>
                    </div>
                    <!--modal header-->
                    <div class="modal-body">
                      <div class="pad" id="infopanel"></div>
                      <div class="form-horizontal">
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Nombre</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtnombre" placeholder="Nombre">
                              <input type="hidden" id="crudmethod" value="N"> 
                              <input type="hidden" id="txtid" value="0">
                            </div>
                        </div>
                     <div class="form-group"> 
                          <label class="col-sm-3  control-label">Apellidos</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtapellidos" placeholder="Apellidos">
                            </div>
                        </div>





                        
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Especialidad</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtespecialidad" placeholder="Especialidad">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Dirección</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtdireccion" placeholder="Dirección">
                            </div>
                        </div>
                          <div class="form-group"> 
                          <label class="col-sm-3  control-label">Teléfono</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txttelefono" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Ciudad del doctor</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtciudad" placeholder="Ciudad">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Estado/Provincia del doctor</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtestado" placeholder="Estado/Provincia">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Pais del doctor</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtpais" placeholder="Pais">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Atención</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0" class="form-control" id="txtatencion" placeholder="Atención">
                            </div>
                        </div>
                         <div class="form-group"> 
                          <label class="col-sm-3  control-label">Instalaciones</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0"  class="form-control" id="txtinstalaciones" placeholder="Instalaciones">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Precio</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0"  class="form-control" id="txtprecio" placeholder="Precio">
                            </div>
                        </div>
                         <div class="form-group"> 
                          <label class="col-sm-3  control-label">Puntualidad</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0"  class="form-control" id="txtpuntualidad" placeholder="Puntualidad">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Lo recomendarías</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0"  class="form-control" id="txtlorecomendarias" placeholder="Lo recomendarías">
                            </div>
                        </div>
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Eficiencia (te curó?)</label>
                          <div class="col-sm-9">
                              <input type="number" min="0" max="5" step="0.5" value="0"  class="form-control" id="txteficiencia" placeholder="Eficiencia">
                            </div>
                        </div>
                       
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label">Comentarios</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtcomentarios" placeholder="Comentarios">
                            </div>
                        </div>
                         <div class="form-group"> 
                          <label class="col-sm-3  control-label">Usuario</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="txtusuario" placeholder="Usuario">
                            </div>
                        </div>
                        
 <div class="form-group"> 
                          <label class="col-sm-3  control-label">Email del Usuario</label>
                          <div class="col-sm-9">
                              <input type="email" class="form-control" id="txtemail" placeholder="Email del usuario">
                            </div>
                        </div>
                        



                        
                         <div class="form-group">
                            <label class="col-sm-3  control-label">Verificado</label>
                          <div class="col-sm-9">
                              <select class="form-control" id="txtverificado" >
                              
                                  <option value="1" selected="selected" selected=true> Si </option>
                                  <option value="0"> No </option>
                            
                              
                              </select>
                          </div>
                        </div>
                       
                       
                       
                   
                        
                        <div class="form-group"> 
                          <label class="col-sm-3  control-label"></label>
                          <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary " id="btnsave"><i class="fa fa-save"></i> Guardar</button></div>
                        </div>
                      </div>
                      <!--modal footer-->
                    </div>
                    <!--modal-content-->
                  </div>
                  <!--modal-dialog modal-lg-->
                </div>
                <!--form-kantor-modal-->
              </div>


            </section><!-- /.content -->

            <!-- ========================================================================================================== -->

          </div><!-- /.content-wrapper -->

<?php include '../footer.php';?>
       