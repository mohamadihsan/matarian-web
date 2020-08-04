
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">User Group</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumUserGroup" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-dsecondary mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateUserGroup"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-dsecondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card h-100 ml-2">
                <a href="<?= site_url('users') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">All User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumUser" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-primary mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateUser"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-primary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?= $title ?></h6>
                    <div class="flex-row-reverse">
                        <!-- <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Enable Fixed Header" id="enable" style="display: none"><i class="fas fa-bars"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Disable Fixed Header"  id="disable"><i class="fas fa-ban"></i></button> -->
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                <table class="table table-striped table-bordered nowrap table-md text-katapanda-sm" id="katapandaTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Group Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot class="">
                        <tr>
                            <th>Group Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<!-- Form Add/Edit -->
<div class="modal fade" id="formKatapanda" tabindex="-1" role="dialog" aria-labelledby="formKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="formTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="label-katapanda-sm" for="name">Group Name <i class="text-danger">*</i></label>
                        <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="label-katapanda-sm" for="description">Description</label>
                        <input type="text" name="description" class="form-control form-control-sm" id="description" placeholder="">
                    </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <!-- <button type="button" class="btn btn-secondary" id="btnResetFormInput">Reset Form</button> -->
                    <button type="submit" class="btn bg-custom" id="btnSubmit"></button>
                </div>
            </div>
        </form>    
    </div>
</div>

<!-- Confirm Delete -->
<div class="modal fade" id="confirmKatapanda" tabindex="-1" role="dialog" aria-labelledby="confirmKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="confirm">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="confirmTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data: <span class="text-custom" id="dataDelete"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-custom" id="submitDelete">Yes, delete</button>
                </div>
            </div>
        </form>    
    </div>
</div>

<!-- Approval -->
<div class="modal fade" id="approvalKatapanda" tabindex="-1" role="dialog" aria-labelledby="approvalKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="approval">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="approvalTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Approve data: <span class="text-custom" id="dataApproval"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="reject">No, reject</button>
                    <button type="button" class="btn btn-success" id="approve">Yes, approve</button>
                </div>
            </div>
        </form>    
    </div>
</div>

<!-- <script src="<?= base_url('assets/'); ?>js/tokenExpired.js"></script> -->
<script>

$(document).ready( function () {
    
    // init variable
    let id = null;
    let actionCreate = <?php echo $action_create != '' ? 1 : 0; ?>;
    let actionUpdate = <?php echo $action_update != '' ? 1 : 0; ?>;
    let actionDelete = <?php echo $action_delete != '' ? 1 : 0; ?>;
    let actionApproval = <?php echo $action_approval != '' ? 1 : 0; ?>;
    let actionExportToExcel = <?php echo $action_export_to_excel != '' ? 1 : 0; ?>;
    let actionExportToCsv = <?php echo $action_export_to_csv != '' ? 1 : 0; ?>;
    let actionExportToPdf = <?php echo $action_export_to_pdf != '' ? 1 : 0; ?>;
    
    // init function
    sumUserGroup();
    sumUser();

    // button default for action datatables
    let buttonAction = ['copyHtml5']; // add button to copy data

    // button action by user role 
    actionCreate ? $('#actionCreate').html('<button class="btn btn-sm btn-outline-primary" id="newData"><i class="fas fa-plus"></i> New Data</button>') : '';
    actionExportToExcel ? buttonAction.push('excelHtml5') : ''; // button export to excel 
    actionExportToCsv ? buttonAction.push('csvHtml5') : ''; // button export to csv
    actionExportToPdf ? buttonAction.push({ // button export to pdf
        text: 'PDF',
        extend: 'pdfHtml5',
        orientation: 'portrait', //landscape
        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
        exportOptions: {
            columns: ':visible',
            search: 'applied',
            order: 'applied'
        },
        customize: function (doc) {
            doc.defaultStyle.fontSize = 6;
            doc.styles.tableHeader.fontSize = 7;
            doc.styles.tableFooter.fontSize = 7;
            doc.styles.tableHeader.alignment = 'left';
            doc.pageMargins = [20,60,20,30];
            doc.content[1].table.widths = [ '20%', '80%', '0%' ];
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'left';
                doc.content[1].table.body[i][1].alignment = 'left';
            }
            var objLayout = {};
            objLayout['hLineWidth'] = function(i) { return .5; };
            objLayout['vLineWidth'] = function(i) { return .5; };
            objLayout['hLineColor'] = function(i) { return '#aaa'; };
            objLayout['vLineColor'] = function(i) { return '#aaa'; };
            objLayout['paddingLeft'] = function(i) { return 4; };
            objLayout['paddingRight'] = function(i) { return 4; };
            doc.content[0].layout = objLayout;
        }
    }) : '';
    // setting dataTables
    $.extend( true, $.fn.dataTable.defaults, {
        responsive: false,
        fixedHeader: {
            header: true,
            footer: true
        },
        language: {
            lengthMenu: "Display _MENU_ records per page",
            zeroRecords: "Nothing found - sorry",
            info: "Showing page _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)"
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: buttonAction
    } );

    // store data to dataTables 
    $.fn.dataTable.ext.errMode = 'none';
    let table = $('#katapandaTable')
        .on( 'error.dt', function (e) { } )
        .DataTable({
        // data: data, // data
        // ajax: 'https://jsonplaceholder.typicode.com/posts', //array object
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/user-group',
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        columns: [
            { data: "user_group_name", className: "align-middle", responsivePriority: 1 },
            { data: "user_group_desc", className: "align-middle" },
            { data: "id", className: "align-middle text-center", width: "10%", responsivePriority: 2, render : function ( data, type, row, meta ) {
                // set by role
                let action = `<div class="btn-group">`;
                // actionApproval && data !== "1" ? action += `<button class="btn btn-sm btn-outline-success approval" data-toggle="tooltip" data-placement="top" title="Approval"><i class="far fa-clipboard"></i></button>` : '';
                actionUpdate && $.inArray(data, ["1"]) === -1 ? action += `<button class="btn btn-sm btn-outline-warning edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                actionDelete && $.inArray(data, ["1", "2"]) === -1 ? action += `<button class="btn btn-sm btn-outline-danger delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : ''; 
                action += `</div>`;
                return action;
            }},
        ],
        language: {
            loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
            processing: `<div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Processing...</span>
                        </div>`
        }
    }).columns.adjust();

    // Button Enable Fixed Header
    $('#enable').on( 'click', function () {
        table.fixedHeader.enable();
        $('#enable').css("display", "none");
        $('#disable').css("display", "");
    } );
 
    // Button Disable Fixed Header
    $('#disable').on( 'click', function () {
        table.fixedHeader.disable();
        $('#enable').css("display", "");
        $('#disable').css("display", "none");
    } );

    // getter and setter data in the row to form input
    $('#katapandaTable tbody').on( 'click', 'tr', function () {
        
        var ids = $.map(table.rows(this).data(), function (item) {
            // alert(JSON.stringify(item))
            console.log('Edit');
            console.log(JSON.stringify(item));

            // store data to input
            $('#name').val(item.user_group_name);
            $('#description').val(item.user_group_desc);

            // set
            id = item.id; 

            // store data to confirm delete text
            $('#dataDelete').text(item.user_group_name);
            
            // store data to approval text
            $('#dataApproval').text(item.user_group_name);
        });
    
    });

    // modal form add new data  
    $('#newData').click(function() {
        // reset ID
        id = null;
        // reset validator in the form
        validator.resetForm()
        // reset Form
        resetFormInput();

        // show modal
        $('#formTitle').html('<i class="fas fa-users"></i> New <?= $title ?>');
        $('#btnSubmit').text('Save');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "");
    })

    // modal form edit in desktop mode
    $('.edit').click(function() {
        // reset validator in the form
        validator.resetForm()

        // show modal
        $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
        $('#btnSubmit').text('Update');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "none");
    })

    // modal form edit in tablet/mobile mode
    $('#katapandaTable tbody').on( 'click', '.edit', function () {
        // reset validator in the form
        validator.resetForm()
        // show modal
        $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
        $('#btnSubmit').text('Update');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "none");
    })

    // confirm delete 
    $('#katapandaTable tbody').on( 'click', '.delete', function () {
        // show confirm
        $('#confirmTitle').html('<i class="fas fa-users"></i> Delete <?= $title ?>');
        $('#confirmKatapanda').modal('show')
    })

    // approval 
    $('#katapandaTable tbody').on( 'click', '.approval', function () {
        // show confirm
        $('#approvalTitle').html('<i class="fas fa-users"></i> Approval <?= $title ?>');
        $('#approvalKatapanda').modal('show')
    })

    // validate and request add new data and update existing data 
    let validator = $('#form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
        },
        messages: {
            name: {
                required: "Please enter Group Name",
                minlength: "Group Name must consist of at least 2 characters"
            }
        },
        submitHandler: function(form) {
            // start loading
            loadingStart()
            
            // send request 
            axios({
                method: id === null ? `POST` : `PUT`,
                url: id === null ? `<?= site_url() ?>api/web/v1/user-group` : `<?= site_url() ?>api/web/v1/user-group/${id}`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>' 
                },
                data: {
                    user_group_name: $('#name').val(),
                    user_group_desc: $('#description').val()
                }
            })
            .then(function (response) {
                // console.log(response);
                let status = response.data.status;
                let message = response.data.message;
                let action = id === null ? `create` : `update`;
                if (status) {
                    // show message
                    notification(action, 'success', message);
                    $('#formKatapanda').modal('hide');
                    $('#katapandaTable').DataTable().ajax.reload();
                    sumUserGroup();
                }else{
                    // show message
                    notification(action, 'error', message);
                }
            })
            .catch(function (error) {
                let messageError;
                let err = error.response;

                if (err.status === 404) {
                    messageError = 'Request Failed. Please check your connection!';
                } else {
                    messageError = err.statusText;
                }
                
                // show message
                notification('login', 'error', messageError);
            })
            .then(function () {
                // stop loading
                loadingStop()
            })
        }
    })

    // approve 
    $('#approve').click(function() {
        // alert('Approve : ' + `<?= site_url() ?>api/web/v1/user-group/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `PUT`,
            url: `<?= site_url() ?>api/web/v1/user-group/${id}/approve`,
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        })
        .then(function (response) {
            // console.log(response);
            let status = response.data.status;
            let message = response.data.message;
            let action = `approve`;
            if (status) {
                // show message
                notification(action, 'success', message);
                $('#approvalKatapanda').modal('hide');
                $('#katapandaTable').DataTable().ajax.reload();
            }else{
                // show message
                notification(action, 'error', message);
            }
        })
        .catch(function (error) {
            let messageError;
            let err = error.response;

            if (err.status === 404) {
                messageError = 'Request Failed. Please check your connection!';
            } else {
                messageError = err.statusText;
            }
            
            // show message
            notification('approve', 'error', messageError);
        })
        .then(function () {
            // stop loading
            loadingStop()
        })
    })

    // reject
    $('#reject').click(function() {
        // alert('Reject : ' + `<?= site_url() ?>api/web/v1/user-group/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `PUT`,
            url: `<?= site_url() ?>api/web/v1/user-group/${id}/reject`,
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        })
        .then(function (response) {
            // console.log(response);
            let status = response.data.status;
            let message = response.data.message;
            let action = `reject`;
            if (status) {
                // show message
                notification(action, 'success', message);
                $('#approvalKatapanda').modal('hide');
                $('#katapandaTable').DataTable().ajax.reload();
            }else{
                // show message
                notification(action, 'error', message);
            }
        })
        .catch(function (error) {
            let messageError;
            let err = error.response;

            if (err.status === 404) {
                messageError = 'Request Failed. Please check your connection!';
            } else {
                messageError = err.statusText;
            }
            
            // show message
            notification('reject', 'error', messageError);
        })
        .then(function () {
            // stop loading
            loadingStop()
        })
    })
    
    // delete
    $('#submitDelete').click(function() {
        // alert('Delete : ' + `<?= site_url() ?>api/web/v1/user-group/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `DELETE`,
            url: `<?= site_url() ?>api/web/v1/user-group/${id}`,
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        })
        .then(function (response) {
            // console.log(response);
            let status = response.data.status;
            let message = response.data.message;
            let action = `delete`;
            if (status) {
                // show message
                notification(action, 'success', message);
                $('#confirmKatapanda').modal('hide');
                $('#katapandaTable').DataTable().ajax.reload();
                sumUserGroup();
            }else{
                // show message
                notification(action, 'error', message);
            }
        })
        .catch(function (error) {
            let messageError;
            let err = error.response;

            if (err.status === 404) {
                messageError = 'Request Failed. Please check your connection!';
            } else {
                messageError = err.statusText;
            }
            
            // show message
            notification('delete', 'error', messageError);
        })
        .then(function () {
            // stop loading
            loadingStop()
        })
    })

    // button reset Form Input
    $('#btnResetFormInput').click(function() {
        // reset Form Input
        resetFormInput();
    })

    $.fn.digits = function(){ 
        return this.each(function(){ 
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") ); 
        })
    }

} );

// reset Form
function resetFormInput() {
    $('#form').trigger("reset");
}

// sum user group
function sumUserGroup() {
    $('#sumUserGroup').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user-group/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumUserGroup').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateUserGroup').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumUserGroup').text('Not Found');
        $('#lastUpdateUserGroup').text('-');
    })
}

// get sum User
function sumUser() {
    $('#sumUser').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumUser').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateUser').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumUser').text('Not Found');
        $('#lastUpdateUser').text('-');
    })
}
</script>
