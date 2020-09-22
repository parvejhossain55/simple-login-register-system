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
					<a class="dropdown-item" href="view-profile.php?profile_view=view">
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
	<?php
		$stdId = (int) Session::get('id');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
		$id = (int) Session::get('id');
		$uppasword = $std->changePassword($id, $_POST);
	}
	?>
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- DataTales Example -->
		<div class="card shadow mb-4 pb-5">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Update Password</h6>
			</div>
			<div style="width: 700px;margin: 0 auto;" class="pt-5">
				<?php
					if (isset($uppasword)) {
						echo $uppasword;
					}
				?>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="user">
					<div class="form-group">
						<label for="oldpass">Old Password : </label>
						<input type="text" name="oldpass" class="form-control" id="oldpass">
					</div>
					<div class="form-group">
						<label for="newpass">New Password : </label>
						<input type="password" name="newpass" class="form-control" id="newpass">
					</div>
					<div class="form-group">
						<label for="confirmpass">Confirm Password : </label>
						<input type="password" name="confirmpass" class="form-control" id="confirmpass">
					</div>
					<input type="submit" name="changepass" value="Update Password" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	<!-- End of Main Content -->
	<?php
	include 'ad_footer.php';
	?>