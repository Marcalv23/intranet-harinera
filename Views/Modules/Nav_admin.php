<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
     <script>
         var navbarStyle = localStorage.getItem("navbarStyle");
         if (navbarStyle && navbarStyle !== 'transparent') {
             document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
         }
     </script>
     <div class="d-flex align-items-center">
         <div class="toggle-icon-wrapper">

             <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

         </div><a class="navbar-brand" href="Management">
             <div class="d-flex align-items-center py-3"><img class="me-2" src="Views/Modules/img/harinera-de-oriente.png" alt="" width="100"/><span class="font-sans-serif text-primary"></span>
             </div>
         </a>
     </div>
     <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
         <div class="navbar-vertical-content scrollbar">
             <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                 <li class="nav-item">
                     <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                         </div>
                     </a>
                     <ul class="nav collapse show" id="dashboard">
                         <li class="nav-item"><a class="nav-link active" href="Management">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Management</span>
                                 </div>
                             </a>

                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                         <div class="col-auto navbar-vertical-label">App
                         </div>
                         <div class="col ps-0">
                             <hr class="mb-0 navbar-vertical-divider" />
                         </div>
                     </div>
                     <a class="nav-link" href="../app/calendar.php" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span><span class="nav-link-text ps-1">Calendario</span>
                         </div>
                     </a>
                     <a class="nav-link" href="../app/chat.php" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                         </div>
                     </a>
                     <a class="nav-link" href="Archivos" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-folder"></span></span><span class="nav-link-text ps-1">Gestionar Archivos</span>
                         </div>
                     </a>
                     <a class="nav-link dropdown-indicator" href="#events" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="events">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-day"></span></span><span class="nav-link-text ps-1">Eventos</span>
                         </div>
                     </a>
                     <ul class="nav collapse" id="events">
                         <li class="nav-item"><a class="nav-link" href="../app/events/create-an-event.html">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Crear un evento</span>
                                 </div>
                             </a>

                         </li>
                         <li class="nav-item"><a class="nav-link" href="../app/events/event-detail.html">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Detalles del evento</span>
                                 </div>
                             </a>

                         </li>
                         <li class="nav-item"><a class="nav-link" href="../app/events/event-list.html">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Lista de eventos</span>
                                 </div>
                             </a>

                         </li>
                     </ul>
                     <a class="nav-link dropdown-indicator" href="#support-desk" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="support-desk">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-ticket-alt"></span></span><span class="nav-link-text ps-1">Directorios</span>
                         </div>
                     </a>
                     <ul class="nav collapse" id="support-desk">
                         <li class="nav-item"><a class="nav-link" href="DirectorioEmpleados">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Empleados</span>
                                 </div>
                             </a>

                         </li>
                         <li class="nav-item"><a class="nav-link" href="DirectorioClientes">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Clientes</span>
                                 </div>
                             </a>

                         </li>
                         <li class="nav-item"><a class="nav-link" href="DirectorioProveedores">
                                 <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Proveedores</span>
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                         <div class="col-auto navbar-vertical-label">Panel de control
                         </div>
                         <div class="col ps-0">
                             <hr class="mb-0 navbar-vertical-divider" />
                         </div>
                     </div>
                     <a class="nav-link" href="Empleados" role="button">
                         <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users"></span></span><span class="nav-link-text ps-1">Gestionar Usuarios</span>
                         </div>
                     </a>
                 </li>
                <a class="nav-link dropdown-indicator" href="#formularios" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="formularios">
                     <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-file-alt"></span></span><span class="nav-link-text ps-1">Formularios</span>
                     </div>
                 </a>
                 <ul class="nav collapse" id="formularios">
                     <!--<li class="nav-item"><a class="nav-link" href="CatalogoColaboradores">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Catalogo de colaboradores</span>
                             </div>
                         </a>
                         <br>
                     </li>-->
                     <li class="nav-item"><a class="nav-link" href="SolicitudMercancia">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">F-CMP-01</span>
                             </div>
                         </a>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="ESequipoVisitantes">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">F-GES-05</span>
                             </div>
                         </a>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="ESequipoColaboradores">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">F-GES-04</span>
                             </div>
                         </a>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="RepIndicencias">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">F-GES-08</span>
                             </div>
                         </a>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="vacanteLaboral">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Vacante laboral</span>
                             </div>
                         </a>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="tablevacanteLaboral">
                             <div class="d-flex align-items-center"><span class="nav-link-text ps-1">tablevacanteLaboral</span>
                             </div>
                         </a>
                     </li>
                 </ul>
                 <!-- <li class="nav-item"><a class="nav-link" href="../app/support-desk/reports.html">
                         <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Reportes</span>
                         </div>
                     </a>
                 </li> -->


                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </nav>