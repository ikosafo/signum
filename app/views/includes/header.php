<?php
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$currentPath = parse_url($currentUrl, PHP_URL_PATH);
$uid = $_SESSION['uid'];
$uuid = Tools::getUUIDbyid($uid);
$userPermissions = Tools::getUserPermissions($uuid);?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Client - Signum Properties Ltd</title>
 
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Signum Properties Ltd">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="property management, real estate, rental properties, leasing, maintenance, investment, portfolio, agency">
    <meta name="description" content="Your trusted property management company, specializing in residential and commercial properties. We maximize value and provide exceptional real estate services.">

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URLROOT ?>/assets/images/signum_logo.png">
    <link href="<?php echo URLROOT ?>/assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo URLROOT ?>/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/css/flatpickr.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo URLROOT ?>/assets/css/sumoselect.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URLROOT ?>/assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/vendor/datatables/responsive/responsive.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/jquery-confirm/css/jquery-confirm.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/css/select2.min.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/uploadifive/uploadifive.css" rel="stylesheet">
	<link href="<?php echo URLROOT ?>/assets/css/custom.css" rel="stylesheet">

	<script>
		var cvhead = <?php echo json_encode(unserialize(JSVARS)); ?>;
		const urlroot = cvhead.urlroot;
	</script>

</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="<?php echo URLROOT ?>/pages/client" class="brand-logo">
                <img class="logo-abbr" src="<?php echo URLROOT ?>/assets/images/signum_logo.png" alt="/">
                <img class="logo-compact" src="<?php echo URLROOT ?>/assets/images/signum_logo.png" alt="/">
                <img class="brand-title" src="<?php echo URLROOT ?>/assets/images/signum_logo.png" alt="/">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <div class="search_bar dropdown">
									<div class="dropdown-menu p-0 m-0">
										<form>
											<div class="input-group search-area d-xl-inline-flex d-none">
												<input class="form-control" type="text" placeholder="Search Here" aria-label="Search">
												<button class="input-group-text">
													<span class="search_icon p-3 c-pointer">
														<svg class="ms-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M23.7871 22.7761L17.9548 16.9437C19.5193 15.145 20.4665 12.7982 20.4665 10.2333C20.4665 4.58714 15.8741 0 10.2333 0C4.58714 0 0 4.59246 0 10.2333C0 15.8741 4.59246 20.4665 10.2333 20.4665C12.7982 20.4665 15.145 19.5193 16.9437 17.9548L22.7761 23.7871C22.9144 23.9255 23.1007 24 23.2816 24C23.4625 24 23.6488 23.9308 23.7871 23.7871C24.0639 23.5104 24.0639 23.0528 23.7871 22.7761ZM1.43149 10.2333C1.43149 5.38004 5.38004 1.43681 10.2279 1.43681C15.0812 1.43681 19.0244 5.38537 19.0244 10.2333C19.0244 15.0812 15.0812 19.035 10.2279 19.035C5.38004 19.035 1.43149 15.0865 1.43149 10.2333Z" fill="#3B4CB8"/>
														</svg>
													</span>
												</button>
											</div>	
										</form>
									</div>
								</div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link  ai-icon" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M21.75 14.8385V12.0463C21.7471 9.88552 20.9385 7.80353 19.4821 6.20735C18.0258 4.61116 16.0264 3.61555 13.875 3.41516V1.625C13.875 1.39294 13.7828 1.17038 13.6187 1.00628C13.4546 0.842187 13.2321 0.75 13 0.75C12.7679 0.75 12.5454 0.842187 12.3813 1.00628C12.2172 1.17038 12.125 1.39294 12.125 1.625V3.41534C9.97361 3.61572 7.97429 4.61131 6.51794 6.20746C5.06159 7.80361 4.25291 9.88555 4.25 12.0463V14.8383C3.26257 15.0412 2.37529 15.5784 1.73774 16.3593C1.10019 17.1401 0.751339 18.1169 0.75 19.125C0.750764 19.821 1.02757 20.4882 1.51969 20.9803C2.01181 21.4724 2.67904 21.7492 3.375 21.75H8.71346C8.91521 22.738 9.45205 23.6259 10.2331 24.2636C11.0142 24.9013 11.9916 25.2497 13 25.2497C14.0084 25.2497 14.9858 24.9013 15.7669 24.2636C16.548 23.6259 17.0848 22.738 17.2865 21.75H22.625C23.321 21.7492 23.9882 21.4724 24.4803 20.9803C24.9724 20.4882 25.2492 19.821 25.25 19.125C25.2486 18.117 24.8998 17.1402 24.2622 16.3594C23.6247 15.5786 22.7374 15.0414 21.75 14.8385ZM6 12.0463C6.00232 10.2113 6.73226 8.45223 8.02974 7.15474C9.32723 5.85726 11.0863 5.12732 12.9212 5.125H13.0788C14.9137 5.12732 16.6728 5.85726 17.9703 7.15474C19.2677 8.45223 19.9977 10.2113 20 12.0463V14.75H6V12.0463ZM13 23.5C12.4589 23.4983 11.9316 23.3292 11.4905 23.0159C11.0493 22.7026 10.716 22.2604 10.5363 21.75H15.4637C15.284 22.2604 14.9507 22.7026 14.5095 23.0159C14.0684 23.3292 13.5411 23.4983 13 23.5ZM22.625 20H3.375C3.14298 19.9999 2.9205 19.9076 2.75644 19.7436C2.59237 19.5795 2.50014 19.357 2.5 19.125C2.50076 18.429 2.77757 17.7618 3.26969 17.2697C3.76181 16.7776 4.42904 16.5008 5.125 16.5H20.875C21.571 16.5008 22.2382 16.7776 22.7303 17.2697C23.2224 17.7618 23.4992 18.429 23.5 19.125C23.4999 19.357 23.4076 19.5795 23.2436 19.7436C23.0795 19.9076 22.857 19.9999 22.625 20Z" fill="#3B4CB8"/>
									</svg>
									<div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
										<ul class="timeline">
											<!-- <li>
												<div class="timeline-panel">
													<div class="media me-2">
														<img alt="image" width="50" src="<?php echo URLROOT ?>/assets/images/avatar/1.jpg">
													</div>
													<div class="media-body">
														<h6 class="mb-1">Dr sultads Send you Photo</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li> -->
										</ul>
									</div>
                                    <a class="all-notification" href="javascript:void(0);">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<div class="header-info">
										<span class="text-black"><?= $_SESSION['username']; ?></span>
										<p class="fs-12 mb-0"><?= $_SESSION['accessLevel']; ?></p>
									</div>
									<?= Tools::displayHeaderImages($_SESSION['uuid']) ?>
                                 </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php echo URLROOT ?>/pages/userProfileClient" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                	<a href="<?php echo URLROOT ?>/auth/login" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="<?php echo URLROOT ?>/pages/index" aria-expanded="false">
							<i class="flaticon-dashboard-1"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>

					<?php if (Tools::hasPermission($userPermissions, 'Property Management') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
								<i class="flaticon-381-layer-1"></i>
								<span class="nav-text">PROPERTY <br>MANAGEMENT</span>
								
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/addProperty">Add New Property</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/listProperties">List Properties</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/searchProperties">Search Property</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/propertyReports">Property Reports</a></li>           
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Client Management') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
								<i class="flaticon-381-user-7"></i>
								<span class="nav-text">CLIENT <br> MANAGEMENT</span>
								
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/addClient">Add Client</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/listClients">List Clients</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/searchClients">Search Clients</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/clientReport">Client Report</a></li>
								
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Rent Management') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-381-blueprint"></i>
								<span class="nav-text">RENT <br>MANAGEMENT</span>
								
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/rentInformation">Add Rent Info</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/listRentInformation">List Rent Info</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/rentReports">Rent Due Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/rentInvoices">Generate Rent Invoices</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/rentReceipts">Rent Receipts</a></li>
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Billings') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-381-database-1"></i>
								<span class="nav-text">BILLINGS</span>
								
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/billPayments">Record Rent Payment</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/billPaymentsMaintenance">Record Maintenance Payment</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/paymentHistory">Payment History</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/billReports">Rent Due Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/billInvoices">Generate Rent Invoices</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/billReceipts">Rent Receipts</a></li>
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Inspections') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-app"></i>
								<span class="nav-text">INSPECTIONS</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/scheduleInspection">Schedule Inspections</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/inspectionResults">Record Inspection Results</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/inspectionHistory">Inspection History</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/inspectionReports">Inspection Reports</a></li>
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Financials') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li>
							<a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-381-back-1"></i>
								<span class="nav-text">FINANCIALS</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/incomeReports">Property Income Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/expenseTracking">Expense Tracking</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/financialStatement">Profit/Loss Statements</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/budgetPlanning">Budget Planning</a></li>
							</ul>
						</li>
					<?php endif ?>

                   <!--  <li>
						<a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-battery-5"></i>
							<span class="nav-text">CONTRACTS</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo URLROOT ?>/pages/leaseAgreements">Lease Agreements</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/contractRenewal">Renew Contracts</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/terminateContract">Terminate Contracts</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/contractTemplate">Contract Templates</a></li>
                        </ul>
                    </li> -->

					<?php if (Tools::hasPermission($userPermissions, 'Maintenance') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-plugin"></i>
								<span class="nav-text">MAINTENANCE</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/maintenanceRequests">Log Maintenance Requests</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/assignMaintenance">Assign Maintenance Tasks</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/tractRepairs">Track Repairs</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/completedMaintenance">Completed Maintenance</a></li>
							</ul>
						</li>
					<?php endif ?>

					<?php if (Tools::hasPermission($userPermissions, 'Reports') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-381-controls-4"></i>
								<span class="nav-text">REPORTS</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/occupancyReports">Occupancy Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/maintenanceReports">Maintenance Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/tenancyReports">Tenant Reports</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/financialReports">Financial Reports</a></li>
							</ul>
						</li>
					<?php endif ?>

					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-user-4"></i>
							<span class="nav-text">USER MANAGEMENT</span>
							
						</a>
                        <ul aria-expanded="false">
						<?php if (Tools::hasPermission($userPermissions, 'User Management') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
                            <li><a href="<?php echo URLROOT ?>/pages/addUser">Add Admin User</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/listUsers">List of Users</a></li>
                            <li><a href="<?php echo URLROOT ?>/pages/userPermissions">User Permissions</a></li>
						<?php endif ?>
							<li><a href="<?php echo URLROOT ?>/pages/changePasswordUser">Change Password</a></li>
							<li><a href="<?php echo URLROOT ?>/pages/userProfileAdmin">User Profile</a></li>
                        </ul>
                    </li>

					<?php if (Tools::hasPermission($userPermissions, 'Settings') || Tools::hasPermission($userPermissions, 'All Permissions')): ?>
						<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
								<i class="flaticon-381-calendar-2"></i>
								<span class="nav-text">SETTINGS</span>
							</a>
							<ul aria-expanded="false">
								<li><a href="<?php echo URLROOT ?>/pages/companyDepartments">Company Departments</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/propertyCategories">Property Categories</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/maintenanceFee">Maintenance Fee</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/rentReminders">Rent Reminders</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/notificationSettings">Notification Settings</a></li>
								<li><a href="<?php echo URLROOT ?>/pages/paymentOptions">Payment Options</a></li>
							</ul>
						</li>
					<?php endif ?>
                    
                </ul>
            
				<div class="copyright mt-5">
					<p></p>
				</div>
			</div>
        </div>