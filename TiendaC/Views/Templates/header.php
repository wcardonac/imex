<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de admimistracion</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url; ?>Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url; ?>Assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url; ?>Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url; ?>Assets/css/select2.css" rel="stylesheet">    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">Sistema de ventas </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>configuracion</span>
                </a>
                <div id="collapseTwo" class="collapse"  data-parent="#accordionSidebar">
                    <div class="bg-back py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="nav-link" href="<?php echo base_url; ?>Usuarios">Usuarios</a>
                        <a class="nav-link" href="<?php echo base_url; ?>Cajas">Cajas</a>
                    </div>
                </div>
                <a class="nav-link " href="<?php echo base_url; ?>Clientes" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fa fa-users"></i></div>
                    <span>Clientes</span>
                </a>
                <a class="nav-link " href="<?php echo base_url; ?>Productos" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span>Productos</span>
                </a>
                  <a class="nav-link " href="<?php echo base_url; ?>Compras" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span>Ventas</span>
                </a>
                <a class="nav-link " href="<?php echo base_url; ?>Compras/historial" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span> Historial Ventas</span>
                </a>
                <a class="nav-link " href="<?php echo base_url; ?>Compras/reportes" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span>Reportes</span>
                </a>
                <!-- </a>
                  <a class="nav-link " href="<?php echo base_url; ?>Ventas" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span> Nueva Ventas</span>
                </a>
                </a>
                  <a class="nav-link " href="<?php echo base_url; ?>HIstorial_ventas" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <div class="sb-nav-link-icon "><i class="fab fa-product-hunt"></i></div>
                    <span>Historial ventas</span>
                </a> -->
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
       
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cambiarPass">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a></li>
                </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <main>
                
            </main>
            <!-- Main Content -->
            <div id="content">

             <main>
                <div class="container-fluid mt-2">
                <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a>
          
           

          