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
                            <th width="20%">CLIENT TYPE</th>
                            <th width="20%">PROPERTY</th>
                            <th width="20%">FULL NAME</th>
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
                                <td><?= $result->clientType ?></td>
                                <td><?= Tools::propertyClient($result->propertyid) ?></td>
                                <td><?= $result->fullName ?></td>
                                <td><?= $result->emailAddress ?></td>
                                <td><?= $result->phoneNumber ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="btn btn-primary viewClient shadow btn-xs sharp me-1" clientid='<?= $result->clientid ?>'><i class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-warning editClient shadow btn-xs sharp me-1" clientid='<?= $result->clientid ?>'><i class="fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-danger deleteClient shadow btn-xs sharp" clientid='<?= $result->clientid ?>'><i class="fas fa-trash"></i></a>
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

<script>
    $("#clientTable").DataTable({
        language: {
            paginate: {
            next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
            previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
            }
        }
    });

    $(document).on('click', '.editClient', function() {
        var clientid = $(this).attr('clientid');
        var hash = btoa(btoa(btoa(clientid)));
        window.location.href = urlroot + "/pages/editClient?clientid=" + hash;
    });

    $(document).on('click', '.viewClient', function() {
        var clientid = $(this).attr('clientid');
        var hash = btoa(btoa(btoa(clientid)));
        window.location.href = urlroot + "/pages/viewClient?clientid=" + hash;
    });


    $(document).off('click', '.deleteClient').on('click', '.deleteClient', function() {
        var clientid = $(this).attr('clientid');
       
        var formData = {};
        formData.clientid = clientid; 
       
        $.confirm({
            title: 'Delete Record!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        var formData = {};
                        formData.clientid = clientid; 
                        saveForm(formData, urlroot + "/delete/client", function(response) {
                            $('#clientTableDiv').html(response);
                        });
                        
                        $('html, body').animate({
                            scrollTop: $("#clientTableDiv").offset().top
                        }, 200);
                        
                        loadPage("/tables/clients", function(response) {
                            $('#clientTableDiv').html(response);
                        });
                        
                    }
                }
            }
        });
        
     });


</script>