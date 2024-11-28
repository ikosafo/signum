<?php
extract($data);
$uuid = Tools::generateUUID();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Maintenance Payment of <strong><?= $fullName ?></strong></h4>
            </div>
            <div class="card-body">
                <form id="needs-validation1" novalidate="" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label">Property</label>
                            <input type="text" class="form-control" disabled value="<?= strtoupper(Tools::propertyClient($propertyid)); ?>">
                        </div>
                    </div> 
                    <hr>

                    <div class="row">
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label">Amount Paid</label>
                            <input type="text" class="form-control-plaintext" readonly onkeypress="allowTwoDecimalPlaces(event)" id="amountPaid" value="<?php echo Tools::getMaintenanceFee($clientid) ?>">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label">Bill Type</label>
                            <input type="text" class="form-control-plaintext" id="billType" readonly value="Maintenance">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label required">Bill Date</label>
                            <input type="text" class="form-control" id="billDate" placeholder="Select date" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label required">Payment Method</label>
                            <select id="paymentMethod" class="default-select form-control wide" required>
                                <option value="">Select Number</option>
                                <option value="Bank Card">Bank Card</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Online Banking">Online Banking</option>
                                <option value="Mobile Money">Mobile Money</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label required">Reference/Serial Number</label>
                            <input type="text" class="form-control" id="serialNumber" placeholder="Enter Number">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label required">Payment Status</label>
                            <select id="paymentStatus" class="default-select form-control wide" required>
                                <option value=""></option>
                                <option value="Pending">Pending</option>
                                <option value="Processed">Processed</option>
                                <option value="Failed">Failed</option>
                                <option value="Successful">Successful</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-label">Payment Description</label>
                            <textarea class="form-control" id="paymentDescription" placeholder="Enter description"></textarea>
                        </div>
                       
                       
                        <div class="next-btn py-4 d-flex col-sm-12 justify-content-center">
                            <button type="submit" id="saveRentDetails" class="btn btn-primary next2 btn-sm">Save</button>
                        </div>
                    </div>
                   
                    

                </form>
            </div>
                
        </div>
    </div>
</div>

<script>
    $("#billDate").flatpickr();
    $("#paymentMethod").select2({
        placeholder:"Select Method"
    });
    $("#paymentStatus").select2({
        placeholder:"Select Status"
    });


    $("#saveRentDetails").on("click", function(event) {
        event.preventDefault(); 

        var rentData  = {
            amountPaid: $("#amountPaid").val(),
            billDate: $("#billDate").val(),
            billType: $("#billType").val(),
            paymentMethod: $("#paymentMethod").val(),
            paymentStatus: $("#paymentStatus").val(),
            paymentDescription: $("#paymentDescription").val(),
            serialNumber: $("#serialNumber").val(),
            uuid: '<?php echo $uuid; ?>',
            propertyid: '<?php echo $propertyid ?>',
            clientid:  '<?php echo $clientid ?>'
        };

        var url = urlroot + "/billing/saveBillPayment";

        var successCallback = function(response) {
            //alert(response);
            if (response == 1) {
                $.notify("Payment added successfully", {
                    position: "top center",
                    className: "success"
                });
            }
            else {
                $.notify("Payment updated successfully", {
                    position: "top center",
                    className: "success"
                });
            }

           /*  setTimeout(function() {
                location.reload();
            }, 500); */
        };

        var validateRentForm = function(rentData) {
            var error = '';
            if (!rentData.amountPaid) {
                error += 'Amount Paid is required\n';
                $("#amountPaid").focus();
            }
            if (!rentData.billDate) {
                error += 'Bill Date is required\n';
                $("#billDate").focus();
            }
            if (!rentData.billType) {
                error += 'Bill Type is required\n';
                $("#billType").focus();
            }
            if (!rentData.paymentStatus) {
                error += 'Payment Status is required\n';
                $("#paymentStatus").focus();
            }
            if (!rentData.paymentMethod) {
                error += 'Payment Method is required\n';
                $("#paymentMethod").focus();
            }
            if (!rentData.serialNumber) {
                error += 'Serial Number is required\n';
                $("#serialNumber").focus();
            }


            return error;
        };
        saveForm(rentData, url, successCallback, validateRentForm);
    });
    
</script>
