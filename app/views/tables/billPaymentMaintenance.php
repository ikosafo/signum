<?php extract($data); ?>
<div id="clientDetailsDiv"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Clients</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-responsive-md" id="clientTable">
                    <thead>
                        <tr>
                            <th width="10%">NO.</th>
                            <th width="20%">FULL NAME</th>
                            <th width="20%">PROPERTY</th>
                            <th width="20%">CLIENT TYPE</th>
                            <th width="20%">EMAIL ADDRESS</th>
                            <th width="20%">TELEPHONE</th>
                            <th width="10%">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1; // Initialize a counter
                        foreach ($listClients as $result) { ?>
                            <tr>
                                <td><strong class="text-black"><?= $no++ ?></strong></td>
                                <td><?= $result->fullName ?></td>
                                <td><?= Tools::propertyClient($result->propertyid) ?></td>
                                <td><?= $result->clientType ?></td>
                                <td><?= $result->emailAddress ?></td>
                                <td><?= $result->phoneNumber ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-success makePayment" clientid='<?= $result->clientid ?>'>Make Payment</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="makePaymentDiv"></div>

<script>
    $("#clientTable").DataTable({
        language: {
            paginate: {
            next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
            previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
            }
        }
    });

    $(document).on('click', '.makePayment', function() {
        var clientid = $(this).attr('clientid');
        $('html, body').animate({
            scrollTop: $("#makePaymentDiv").offset().top
        }, 500);

        var formData = {};
        formData.clientid = clientid; 
        saveForm(formData, "/forms/billPaymentMaintenance", function(response) {
            $('#makePaymentDiv').html(response);
        });
    });


</script>