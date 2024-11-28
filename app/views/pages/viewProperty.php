<?php include ('includes/header.php');
$uuid = Tools::generateUUID();
extract($data);
?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">PROPERTY MANAGEMENT</a></li>
						<li class="breadcrumb-item active"><a href="#">View Property Details</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">View Details of <strong><?= $propertyDetails['propertyName'] ?></strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="row gx-lg-3">
                                    <div class="col-xl-9 col-xxl-12">
                                        <div class="row gx-lg-3">
                                            <div class="col-xl-4 col-lg-4 col-sm-12">
                                                <div class="card overflow-hidden">
                                                    <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                                                        <h3 class="mt-3 mb-1 text-white"><?= $propertyDetails['propertyName'] ?></h3>
                                                        <p class="text-white mb-0"><?= $propertyDetails['propertyType']; ?></p>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Category</span> <strong class="text-black"> <?= Tools::categoryName($propertyDetails['propertyCategory']) ?> </strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Address</span> <strong class="text-black px-3"> <?= $propertyDetails['propertyAddress'] ?> </strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Location</span> <strong class="text-black"><?= $propertyDetails['location'] ?></strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Number of Tenants</span> <strong class="text-black"><?= $propertyDetails['numberOfTenants'] ?></strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Property Size</span> <strong class="text-black"><?= $propertyDetails['propertySize'] ?></strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Furnishing Status</span> <strong class="text-black"><?= $propertyDetails['furnishingStatus'] ?></strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Facilities</span> <strong class="text-black px-3"><?= $propertyDetails['facilities'] ?></strong></li>
                                                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Description</span> <strong class="text-black px-3"><?= $propertyDetails['description'] ?></strong></li>
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
                                                                    <td><strong>Name :</strong> </td>
                                                                    <td class="tb-para"><?= $ownerDetails['fullName'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Birth Date :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['birthDate'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Gender :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['gender'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Email :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['emailAddress'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Phone :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['phoneNumber'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Alternative Phone :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['altPhoneNumber'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Residential Address :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['residentialAddress'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Nationality :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['nationality'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Contract Type :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['contractType'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Marital Status :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['maritalStatus'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Occupation :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['occupation'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Employer's Name :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['employersName'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Employer's Phone :</strong></td>
                                                                    <td class="tb-para"><?= $ownerDetails['employersPhone'] ?></td>
                                                                </tr>
                                                                
                                                            </tbody>

                                                        </table>
                                                        
                                                    </div>
                                                        
                                                </div>
                                            
                                                    
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-sm-12">
                                                <div class="card overflow-hidden">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Tenants</h4> 
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <table class="check-tbl mb-2">
                                                            <tbody>
                                                                                                    <?php
                                                                $no = 1; // Initialize a counter
                                                                foreach ($listClientsProp as $result) { ?>
                                                                    <tr>
                                                                        <td><strong class="text-black"><?= $no++ ?></strong></td>
                                                                        <td><?= $result->clientType ?></td>
                                                                        <td><?= $result->fullName ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                
                                                            </tbody>

                                                        </table>
                                                        
                                                    </div>
                                                        
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="next-btn py-4 d-flex col-sm-12 justify-content-center">
                                    <button type="button" id="backList" class="btn btn-primary next2 btn-sm">Back to List</button>
                                </div>

                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include ('includes/footer.php'); ?>

<script>
    var navItems = document.querySelectorAll('a span.nav-text');

    navItems.forEach(function(item) {
        var textContent = item.textContent.trim().replace(/\s+/g, ' ');
        console.log("Checking item:", textContent); 

        if (textContent === 'PROPERTY MANAGEMENT') {
            console.log("Found PROPERTY MANAGEMENT:", item); 
            item.closest('li').classList.add('mm-active');
        }
    });

    $('#backList').click(function() {
        window.location.href = urlroot + '/pages/listProperties'
    })
</script>