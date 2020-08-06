 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-0">
          <i class="fas fa-chalkboard-teacher"></i>
          <!--img src="img/logo-web.png" width="90%"-->
        </div>
        <div class="sidebar-brand-text mx-3">Mare de Deu dels Angels</div>
        <div class="sidebar-brand-text"><sup>v1.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
		<i class="fas fa-fw fa-home"></i>
		<span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Classes Collapse Menu 
      <li class="nav-item">
        <a class="nav-link collapsed" href="classes.php" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-graduation-cap"></i>
          <span>Classes</span>
        </a>
      </li>-->

      <!-- Nav Item - Subjects Collapse Menu
	   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
		  <i class="fas fa-book-open"></i>
          <span>Subjects</span>
        </a>
      </li>-->
	  

      <!-- Nav Item - Students Collapse Menu 
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			  <i class="fas fa-user-graduate"></i>
			  <span>Students</span>
			</a>
		</li>-->

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Profile</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Timetable</span></a>
      </li>
	  
	  <?php
			if($_SESSION['group_user_id'] == 1){
			echo'
			<li class="nav-item">
				<a class="nav-link" href="administration.php">
				<i class="fas fa-user-shield"></i>
				<span>Administration</span></a>
			</li>
			';
			}
      ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->