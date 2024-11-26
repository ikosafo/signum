<?php include ('includes/header.php');
extract($data);
$uuid = $propertyDetails['uuid'];
?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">PROPERTY MANAGEMENT</a></li>
						<li class="breadcrumb-item active"><a href="#">Edit Property</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Property Details of <strong><?= $propertyDetails['propertyName'] ?></strong></h4>
                            </div>
                            <div class="card-body">
								<div class="wizard-step-container">
                                <form class="row" id="needs-validation" novalidate="" autocomplete="off">
                                                    <div class="mb-3 col-md-4 col-sm-12">
                                                        <label class="form-label required">Property Name/Title/Phase</label>
                                                        <input type="text" name="propertyName" class="form-control" value="<?= $propertyDetails['propertyName'] ?>" placeholder="Green Valley Apartments" required>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Property Type</label>
                                                        <select name="propertyType" class="default-select form-control wide" required>
                                                             <option value="" disabled>Select Property Type</option>
                                                            <option value="Apartment" <?= ($propertyDetails['propertyType'] == 'Apartment') ? 'selected' : '' ?>>Apartment</option>
                                                            <option value="House" <?= ($propertyDetails['propertyType'] == 'House') ? 'selected' : '' ?>>House</option>
                                                            <option value="Commercial" <?= ($propertyDetails['propertyType'] == 'Commercial') ? 'selected' : '' ?>>Commercial</option>
                                                            <option value="Land" <?= ($propertyDetails['propertyType'] == 'Land') ? 'selected' : '' ?>>Land</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Facilities</label>
                                                        <select name="facilities[]" class="form-control" id="facilities" multiple="multiple">
                                                            <option value="None" <?= (strpos($propertyDetails['facilities'], 'None') !== false) ? 'selected' : '' ?>>None</option>
                                                            <option value="Swimming Pool" <?= (strpos($propertyDetails['facilities'], 'Swimming Pool') !== false) ? 'selected' : '' ?>>Swimming Pool</option>
                                                            <option value="Gym/Fitness Center" <?= (strpos($propertyDetails['facilities'], 'Gym/Fitness Center') !== false) ? 'selected' : '' ?>>Gym/Fitness Center</option>
                                                            <option value="Parking Garage" <?= (strpos($propertyDetails['facilities'], 'Parking Garage') !== false) ? 'selected' : '' ?>>Parking Garage</option>
                                                            <option value="Elevator" <?= (strpos($propertyDetails['facilities'], 'Elevator') !== false) ? 'selected' : '' ?>>Elevator</option>
                                                            <option value="24/7 Security" <?= (strpos($propertyDetails['facilities'], '24/7 Security') !== false) ? 'selected' : '' ?>>24/7 Security</option>
                                                            <option value="Childrens Playground" <?= (strpos($propertyDetails['facilities'], "Childrens Playground") !== false) ? 'selected' : '' ?>>Children's Playground</option>
                                                            <option value="Clubhouse/Community Hall" <?= (strpos($propertyDetails['facilities'], 'Clubhouse/Community Hall') !== false) ? 'selected' : '' ?>>Clubhouse/Community Hall</option>
                                                            <option value="Backup Power Generator" <?= (strpos($propertyDetails['facilities'], 'Backup Power Generator') !== false) ? 'selected' : '' ?>>Backup Power Generator</option>
                                                            <option value="CCTV Surveillance" <?= (strpos($propertyDetails['facilities'], 'CCTV Surveillance') !== false) ? 'selected' : '' ?>>CCTV Surveillance</option>
                                                            <option value="On-site Laundry Facilities" <?= (strpos($propertyDetails['facilities'], 'On-site Laundry Facilities') !== false) ? 'selected' : '' ?>>On-site Laundry Facilities</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Property Category</label>
                                                        <select name="propertyCategory" id="propertyCategory" class="form-control" required>
                                                            <option disabled>Select Category</option>
                                                            <?php foreach ($listPropertyCategory as $record): ?>
                                                                <option value="<?= $record->categoryId ?>" 
                                                                    <?= ($record->categoryId == $propertyDetails['propertyCategory']) ? 'selected' : '' ?>>
                                                                    <?= $record->categoryName ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>  
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label">Property Manager(s)</label>
                                                        <?php $selectedManagers = explode(',', $propertyDetails['propertyManager']); ?>
                                                        <select name="propertyManager[]" class="form-control" id="propertyManager" multiple="multiple">
                                                            <?php foreach ($listUsers as $record): ?>
                                                                <option value="<?= $record->userid ?>" 
                                                                    <?= in_array($record->userid, $selectedManagers) ? 'selected' : '' ?>>
                                                                    <?= $record->firstName.'  '.$record->lastName ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Number of Tenants</label>
                                                        <input type="number" name="numberOfTenants" class="form-control" value="<?= $propertyDetails['numberOfTenants'] ?>" placeholder="e.g., 10" required>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Property Size</label>
                                                        <input type="text" name="propertySize" class="form-control" value="<?= $propertyDetails['propertySize'] ?>" placeholder="e.g., 2000 sq ft or 0.5 acres" required>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Furnishing Status</label>
                                                        <select name="furnishingStatus" class="default-select form-control wide" required>
                                                            <option value="" disabled>Select Furnishing Status</option>
                                                            <option value="Furnished" <?= (strpos($propertyDetails['furnishingStatus'], 'Furnished') !== false) ? 'selected' : '' ?>>Furnished</option>
                                                            <option value="Semi-Furnished" <?= (strpos($propertyDetails['furnishingStatus'], 'Semi-Furnished') !== false) ? 'selected' : '' ?>>Semi-Furnished</option>
                                                            <option value="Unfurnished" <?= (strpos($propertyDetails['furnishingStatus'], 'Unfurnished') !== false) ? 'selected' : '' ?>>Unfurnished</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Location</label>
                                                        <input type="text" name="location" class="form-control" value="<?= $propertyDetails['location'] ?>" placeholder="Location (e.g., city or neighborhood)" required>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label required">Property Address</label>
                                                        <textarea name="propertyAddress" class="form-control" placeholder="Full address including street, city, state, postal code, and country" rows="3" required><?= $propertyDetails['propertyAddress'] ?></textarea>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" placeholder="Brief description of the property" rows="3"><?= $propertyDetails['description'] ?></textarea>
                                                    </div>
                                                   
                                                    <div class="next-btn py-4 d-flex col-sm-12 justify-content-center">
                                                        <button type="submit" id="saveProperty" class="btn btn-warning next2 btn-sm">Update</button>
                                                    </div>
                                                </form>
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
    
    $('#facilities').SumoSelect({
        placeholder: 'Select options',
        selectAll: true,
        search: true,
        okCancelInMulti: true
    });

    $('#propertyManager').SumoSelect({
        placeholder: 'Select options',
        search: true,
        okCancelInMulti: true
    });

    $('#numberRooms').SumoSelect({
        placeholder: 'Select number of rooms',
        search: true,
        okCancelInMulti: true
    });

    $("#propertyCategory").select2({
        placeholder: "Select Category"
    });

    $("#saveProperty").on("click", function() {
        event.preventDefault(); 

        var formData = {
            propertyName: $("input[name='propertyName']").val(),
            propertyType: $("select[name='propertyType']").val(),
            propertyCategory: $("#propertyCategory").val(),
            propertyAddress: $("textarea[name='propertyAddress']").val(),
            location: $("input[name='location']").val(),
            description: $("textarea[name='description']").val(),
            numberOfTenants: $("input[name='numberOfTenants']").val(),
            propertySize: $("input[name='propertySize']").val(),
            furnishingStatus: $("select[name='furnishingStatus']").val(),
            propertyManager: $('#propertyManager').val(),
            selectedFacilities: $('#facilities').val(),
            uuid: '<?php echo $uuid; ?>'
        };
        var url = urlroot + "/property/saveProperty";

        var successCallback = function(response) {
            response = JSON.parse(response);
            //alert(response);

            if (response == 1 || response == 3) {
                    $.notify("Property saved", {
                        position: "top center",
                        className: "success"
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 500); 
                }
            else {
                $.notify("Property already exists", {
                    position: "top center",
                    className: "error"
                });
            }

        };

        var validateForm = function(formData) {
            var error = '';
            if (!formData.propertyName) {
                error += 'Property Name is required\n';
                $("input[name='propertyName']").focus();
            }
            if (!formData.propertyType) {
                error += 'Property Type is required\n';
                $("select[name='propertyType']").focus();
            }
            if (!formData.propertyCategory) {
                error += 'Property Category is required\n';
                $("input[name='propertyCategory']").focus();
            }
            if (!formData.propertyAddress) {
                error += 'Property Address is required\n';
                $("textarea[name='propertyAddress']").focus();
            }
            if (!formData.location) {
                error += 'Location is required\n';
                $("input[name='location']").focus();
            }
            if (!formData.numberOfTenants) {
                error += 'Number of Tenants is required\n';
                $("input[name='numberOfTenants']").focus();
            }
            if (!formData.propertySize) {
                error += 'Property Size is required\n';
                $("input[name='propertySize']").focus();
            }
            if (!formData.furnishingStatus) {
                error += 'Furnishing Status is required\n';
                $("select[name='furnishingStatus']").focus();
            }
            if (!formData.selectedFacilities || formData.selectedFacilities.length === 0) {
                error += 'Facilities are required\n';
                $('#facilities').focus();
            }
            if (!formData.propertyManager || formData.propertyManager.length === 0) {
                error += 'Manager is required\n';
                $('#propertyManager').focus();
            }
            
            return error;
        };

        saveForm(formData, url, successCallback, validateForm);
    });



</script>