<?php
extract($data);
?>
<div class="row gx-lg-3">
					<div class="col-xl-9 col-xxl-12">
						<div class="row gx-lg-3">
							<div class="col-xl-4 col-lg-4 col-sm-12">
								<div class="card overflow-hidden">
									<div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
										<h3 class="mt-3 mb-1 text-white"><?= $propertyName ?></h3>
										<p class="text-white mb-0"><?= $propertyType; ?></p>
									</div>
									<ul class="list-group list-group-flush">
										<li class="list-group-item d-flex justify-content-between"><span class="mb-0">Category</span> <strong class="text-black"> <?= $propertyCategory ?>	</strong></li>
										<li class="list-group-item d-flex justify-content-between"><span class="mb-0">Address</span>&nbsp;&nbsp;&nbsp;&nbsp; <strong class="text-black"> <?= $propertyAddress ?> </strong></li>
										<li class="list-group-item d-flex justify-content-between"><span class="mb-0">Location</span> <strong class="text-black"><?= $location ?></strong></li>
										<li class="list-group-item d-flex justify-content-between"><span class="mb-0">Number of Tenants</span> <strong class="text-black"><?= $numberOfTenants ?></strong></li>
										<li class="list-group-item d-flex justify-content-between"><span class="mb-0">Property Size</span> <strong class="text-black"><?= $propertySize ?></strong></li>
                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Furnishing Status</span> <strong class="text-black"><?= $furnishingStatus ?></strong></li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="mb-0 mr-3">Facilities</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong class="text-black ml-3"><?= $facilities ?></strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="mb-0 mr-3">Description</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong class="text-black ml-3"><?= $description ?></strong>
                                        </li>

                                        
									</ul>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-sm-12">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h4 class="card-title">Ownership Details</h4>
									</div>
									<div class="card-body">
										
										<table class="check-tbl mb-2">
                                            <tbody>
                                                <tr>
                                                    <td width="40%"><strong>Name :</strong> </td>
                                                    <td width="60%" class="tb-para"><?= $ownerFullName ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email :</strong></td>
                                                    <td class="tb-para"><?= $ownerEmail ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone :</strong></td>
                                                    <td class="tb-para"><?= $ownerPhone ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>City :</strong></td>
                                                    <td class="tb-para"><?= $ownerCity ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address :</strong></td>
                                                    <td class="tb-para"><?= $ownerAddress ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Type :</strong></td>
                                                    <td class="tb-para"><?= $ownershipType ?></td>
                                                </tr>
                                            </tbody>


										</table>
                                        
                                    </div>
                                        
								</div>
                                <button id="listUsers" class="btn-sm btn btn-primary mb-3">Back to List</button>
									
							</div>
                            <div class="col-xl-4 col-lg-4 col-sm-12">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h4 class="card-title">Rental Details</h4>
									</div>
									<div class="card-body">
										
										<table class="check-tbl mb-2">
                                            <tbody>
                                                    
                                                    <tr>
                                                        <td><strong>Bedrooms Available :</strong></td>
                                                        <td class="tb-para"><?= $numberRooms ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Rent Amount :</strong></td>
                                                        <td class="tb-para"><?= $rentAmount ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Deposited Amount :</strong></td>
                                                        <td class="tb-para"><?= $depositAmount ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Lease Period :</strong></td>
                                                        <td class="tb-para"><?= $leasePeriod ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Availability Date :</strong></td>
                                                        <td class="tb-para"><?= $availabilityDate ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Utilities Included :</strong></td>
                                                        <td class="tb-para"><?= $utilitiesIncluded ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payment Frequency :</strong></td>
                                                        <td class="tb-para"><?= $paymentFrequency ?></td>
                                                    </tr>
                                            </tbody>

										</table>
                                        
                                    </div>
                                        
								</div>
                                <button id="listUsers" class="btn-sm btn btn-primary mb-3">Back to List</button>
									
							</div>
							
						</div>
					</div>
					
				</div>


<script>
    $("#listUsers").click(function() {
        loadPage("/tables/adminUsers", function(response) {
            $('#userTableDiv').html(response);
        });
    })
</script>
