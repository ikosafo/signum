<?php include ('includes/headerClient.php');
extract($data);
$uuid = $clientDetails['uuid'];
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
										<svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
											<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
											<polyline points="14 2 14 8 20 8"></polyline>
											<line x1="16" y1="13" x2="8" y2="13"></line>
											<line x1="16" y1="17" x2="8" y2="17"></line>
											<polyline points="10 9 9 9 8 9"></polyline>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Payment Record</p>
										<h4 class="mb-0">97%</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <div class="widget-stat card">
							<div class="card-body  p-4">
								<div class="media ai-icon">
									<span class="me-3 bgl-danger text-danger">
										<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
											<line x1="12" y1="1" x2="12" y2="23"></line>
											<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Months Paid</p>
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
									<span class="me-3 bgl-success text-success">
										<svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
											<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
											<path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
											<path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="mb-1">Reported Issues</p>
										<h4 class="mb-0">23</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body  p-4">
								<div class="media">
									<span class="me-3">
										<i class="flaticon-381-calendar-1"></i>
									</span>
									<div class="media-body text-white text-end">
										<p class="mb-1">Good standing Status</p>
										<h3 class="text-white">Expired</h3>
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
										<span class="mb-0"><?= $clientDetails['fullName'];  ?></span>
									</li>
									<li class="list-group-item d-flex px-0 justify-content-between">
										<strong>Email Address</strong>
										<span class="mb-0"><?= $clientDetails['emailAddress'];  ?></span>
									</li>
									<li class="list-group-item d-flex px-0 justify-content-between">
										<strong>Telephone</strong>
										<span class="mb-0"><?= $clientDetails['phoneNumber'];  ?></span>
									</li>
									<li class="list-group-item d-flex px-0 justify-content-between">
										<strong>Gender</strong>
										<span class="mb-0"><?= $clientDetails['gender'];  ?></span>
									</li>
								</ul>
                            </div>
                        </div>
					</div>
					
                </div>
            </div>
        </div>
	
<?php include ('includes/footer.php'); ?>
	
