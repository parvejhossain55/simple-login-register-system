<?php
include 'ad_header.php';
include 'lib/Student.php';
$std = new Student();
Session::init();
Session::checksession();
?>
<?php
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy();
	}
?>
<!-- Main Content -->
<div id="content">
	<!-- Topbar -->
	<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		<i class="fa fa-bars"></i>
		</button>
		<!-- Topbar Search -->
		<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
			<div class="input-group">
				<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
					<i class="fas fa-search fa-sm"></i>
					</button>
				</div>
			</div>
		</form>
		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">
			<!-- Nav Item - Search Dropdown (Visible Only XS) -->
			<li class="nav-item dropdown no-arrow d-sm-none">
				<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-search fa-fw"></i>
				</a>
				<!-- Dropdown - Messages -->
				<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
					<form class="form-inline mr-auto w-100 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
								<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</li>
			<!-- Nav Item - Alerts -->
			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-bell fa-fw"></i>
					<!-- Counter - Alerts -->
					<span class="badge badge-danger badge-counter">3+</span>
				</a>
				<!-- Dropdown - Alerts -->
				
			</li>
			<!-- Nav Item - Messages -->
			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-envelope fa-fw"></i>
					<!-- Counter - Messages -->
					<span class="badge badge-danger badge-counter">7</span>
				</a>
				<!-- Dropdown - Messages -->
			</li>
			<div class="topbar-divider d-none d-sm-block"></div>
			<!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">
						<?php
						$name = Session::get('name');
						if (isset($name)) {
							echo $name;
						}
						?>
					</span>
					<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
				</a>
				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="view-profile.php">
						<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
						Profile
					</a>
					<a class="dropdown-item" href="#">
						<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
						Settings
					</a>
					<a class="dropdown-item" href="#">
						<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
						Activity Log
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="?action=logout" >
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Logout
					</a>
				</div>
			</li>
		</ul>
	</nav>
	<!-- End of Topbar -->
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- DataTales Example -->
		<div class="card shadow ">
			<div class="card-header py-3">
				<h2 class="m-0 font-weight-bold text-primary text-center">Student List</h2>
			</div>
			<!-- DataTales Example -->
			<div class="card  ">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Name</th>
									<th>Position</th>
									<th>Office</th>
									<th>Age</th>
									<th>Start date</th>
									<th>Salary</th>
								</tr>
							</thead>
							<tfoot>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>System Architect</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>2011/04/25</td>
									<td>$320,800</td>
								</tr>
								<tr>
									<td>Garrett Winters</td>
									<td>Accountant</td>
									<td>Tokyo</td>
									<td>63</td>
									<td>2011/07/25</td>
									<td>$170,750</td>
								</tr>
								<tr>
									<td>Ashton Cox</td>
									<td>Junior Technical Author</td>
									<td>San Francisco</td>
									<td>66</td>
									<td>2009/01/12</td>
									<td>$86,000</td>
								</tr>
								<tr>
									<td>Cedric Kelly</td>
									<td>Senior Javascript Developer</td>
									<td>Edinburgh</td>
									<td>22</td>
									<td>2012/03/29</td>
									<td>$433,060</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- <div style="width: 700px;margin: 0 auto;" class="pt-5"></div> -->
		</div>
	</div>
	<!-- End of Main Content -->
	<?php
	include 'ad_footer.php';
	?>