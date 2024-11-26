<?php include ('includes/header.php');
extract($data);
$uuid = $userDetails['uuid'];
?>

	<div class="content-body">
		<div class="container-fluid">
			<div class="page-titles">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active"><a href="javascript:void(0)">DASHBOARD</a></li>
				</ol>
			</div>
			<!-- row -->
			<div class="row">
				
				
				<div class="col-xl-3 col-lg-6 col-sm-6">
					<div class="widget-stat card">
						<div class="card-body p-4">
							<div class="media ai-icon">
								<span class="me-3 bgl-warning text-warning">
									<!-- Property Icon SVG -->
									<svg id="icon-property" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
										<path d="M3 9L12 3l9 6v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"></path>
										<polyline points="9 22 9 12 15 12 15 22"></polyline>
									</svg>
								</span>
								<div class="media-body">
									<p class="mb-1">Properties</p>
									<h4 class="mb-0">14</h4>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6">
					<div class="widget-stat card">
						<div class="card-body  p-4">
							<div class="media ai-icon">
								<span class="me-3 bgl-info text-info">
									<!-- User Icon SVG -->
									<svg id="icon-users" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
										<path d="M15 17c3 0 5 2 5 5s-2 5-5 5H9c-3 0-5-2-5-5s2-5 5-5h6z"></path>
										<path d="M12 12c2 0 4-2 4-4s-2-4-4-4-4 2-4 4 2 4 4 4z"></path>
									</svg>
								</span>
								<div class="media-body">
									<p class="mb-1">Clients</p>
									<h4 class="mb-0">6</h4>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6">
					<div class="widget-stat card">
						<div class="card-body p-4">
							<div class="media ai-icon">
								<span class="me-3 bgl-danger text-danger">
									<svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
										<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
										<path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
										<path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
									</svg>
								</span>
								<div class="media-body">
									<p class="mb-1">Open Issues</p>
									<h4 class="mb-0">23</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-success">
						<div class="card-body  p-4">
							<div class="media">
								<span class="me-3">
									<i class="flaticon-381-calendar-1"></i>
								</span>
								<div class="media-body text-white text-end">
									<p class="mb-1">Good standing Status</p>
									<h3 class="text-white">12</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
						
				<div class="col-xl-4 col-lg-12 col-sm-12">
					<div class="card">
						<div class="card-header border-0 pb-0">
							<h2 class="card-title">Profile</h2>
						</div>
						<div class="card-body pb-0">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex px-0 justify-content-between">
									<strong>Full Name</strong>
									<span class="mb-0"><?= $userDetails['firstName'].' '.$userDetails['lastName'];  ?></span>
								</li>
								<li class="list-group-item d-flex px-0 justify-content-between">
									<strong>Email Address</strong>
									<span class="mb-0"><?= $userDetails['emailaddress'];  ?></span>
								</li>
								<li class="list-group-item d-flex px-0 justify-content-between">
									<strong>Telephone</strong>
									<span class="mb-0"><?= $userDetails['phoneNumber'];  ?></span>
								</li>
								<li class="list-group-item d-flex px-0 justify-content-between">
									<strong>Access Level</strong>
									<span class="mb-0"><?= $userDetails['accessLevel'];  ?></span>
								</li>
								<li class="list-group-item d-flex px-0 justify-content-between">
									<strong>Username</strong>
									<span class="mb-0"><?= $userDetails['username'];  ?></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
<?php include ('includes/footer.php'); ?>
	
