<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FACITEC | www.facitec.edu.py</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
   
    <!---css para las Notificaciones  ---->
    <link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div style="display: none;" id="cargador_empresa" align="center"><br>
      <center><label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label><br>
      <label style="color:#ABB6BA">Realizando tarea solicitada ...</label><br></center>
      <center style="margin-top: 10px">
        <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> 
      </center>
      <hr style="color:#003" width="50%"><br>
    </div>
    <input type="hidden"  id="url_raiz_proyecto" value="{{ url('/') }}" />
    <div id="capa_modal" class="div_modal" style="display: none;"></div>
    <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
    
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
         <a
         {{-- href="index2.html"--}} class="logo"> 
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>FC</b>V</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>FACITEC</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                          page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('img/muser2-160x160.jpg')}}" class="user-image" alt="User Image">
                  {{-- <span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header"> 
                    <img src="{{asset('img/muser2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    <p>
                    {{ Auth::user()->name }}
                       <small> {{ Auth::user()->email }}</small> 
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                     <a href="" class="btn btn-default btn-flat" value="{{ Auth::user()->id }}">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat"  onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Cerrar</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </div>
                  </li>
                  
                </ul>
              </li>
              
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="/home">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <!-- <ul class="treeview-menu">
                <li><a href="/home"><i class="fa fa-circle-o"></i>Dashboard</a></li>
              </ul> -->
            </li>
          
          @can('ver-registro')  
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bars"></i>
                <span>Registros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('registro/facultad')}}"><i class="fa fa-circle-o"></i>Facultades</a></li>
                <li><a href="/registro/sede"><i class="fa fa-circle-o"></i>Sedes</a></li>
                <li><a href="/registro/carrera"><i class="fa fa-circle-o"></i>Carreras</a></li>
                <li><a href="/registro/dimension"><i class="fa fa-circle-o"></i>Dimensiones</a></li>
                <li><a href="/registro/periodo"><i class="fa fa-circle-o"></i>Periodos</a></li>
                <li><a href="/registro/responsable"><i class="fa fa-circle-o"></i>Responsables</a></li>
              </ul>
            </li>
          @endcan

            <li class="treeview">
              <a href="#">
                <i class="fa fa-exchange"></i>
                <span>Transacciones</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/transaccion/mejora"><i class="fa fa-circle-o"></i>Plan de Mejoras</a></li>
                <li><a href="/transaccion/realizada"><i class="fa fa-circle-o"></i>Seguimiento del Plan de Mejoras </a></li>
              </ul>
            </li>
                         
            
        @can('ver-rol')      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>    
              <ul class="treeview-menu">
                <li><a class="nav-link" href="/usuarios"><i class="fa fa-circle-o"></i> Usuarios</a></li>       
                <li><a class="nav-link" href="/roles"><i class="fa fa-circle-o"></i> Roles</a></li>                 
              </ul>
            </li>              
        @endcan

            <!-- <li class="sidebar-menu-left-red">
              <a href="#">
                <i class="fa fa-file-pdf-o"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('mejora/reporte') }}"><i class="fa fa-circle-o"></i>Mejoras</a></li>

                <li><a href="{{ URL::to('propuesta/reporte') }}"><i class="fa fa-circle-o"></i>Mejoras Propuestas</a></li>
                <li><a href="{{ URL::to('realizada/reporte') }}"><i class="fa fa-circle-o"></i>Mejoras Realizadas</a></li>
      
              </ul>
            </li> -->
             <li>
              <a href="{{asset('storage/documentos/manual_usuario.pdf')}}">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="{{asset('storage/documentos/Plan de Mejora.pdf')}}">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">

          {{-- @if(session('datos'))
               <div class="alert-success alert-dismissible fade show" role="alert">
                   {{session('datos')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                    </button>
               </div>
          @endif --}}

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de seguimiento de plan de mejoras</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @include('components.flash_alerts')
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022-2023 <a href="https://facitec.edu.py/v2/">Facitec</a>.</strong> Desarrollador: Esteban Castillo.
      </footer>

      
     
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- Notificaciones -->
    <script src="{{ asset('js/Lobibox.js') }}"></script>
    <script src="{{ asset('js/notification-active.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <script src="{{asset('js/https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
    <script src="{{asset('js/https://code.jquery.com/jquery-3.2.1.js')}}"></script>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/chart.js')}}"></script>
    @stack('js')
    @yield('js')

  </body>
</html>
