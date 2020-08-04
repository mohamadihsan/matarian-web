
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
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

            <div class="card h-100 ml-2">
                <a href="<?= site_url('users/verified') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">User Terverifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumUserVerified" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateUserVerified"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="card h-100  ml-2">
                <a href="<?= site_url('users/rejected') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">User Rejected</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumUserRejected" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateUserRejected"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-danger"></i>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="card h-100 ml-2">
                <a href="<?= site_url('users/activation') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Activation</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumPendingActivation" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-warning mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdatePendingActivation"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-lock fa-2x text-warning"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
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
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>No.Tlp</th>
                            <th>Email</th>
                            <th>Group User</th>
                            <th>Activation Status</th>
                            <th>Activation At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot class="">
                        <tr>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>No.Tlp</th>
                            <th>Email</th>
                            <th>Group User</th>
                            <th>Activation Status</th>
                            <th>Activation At</th>
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
                            <label class="label-katapanda-sm" for="fullname">Fullname <i class="text-danger">*</i></label>
                            <input type="text" name="fullname" class="form-control form-control-sm" id="fullname" placeholder="">
                        </div>
                        
                        <div class="form-group">
                        <label class="label-katapanda-sm" for="nomorTelepon">Nomor Telepon <i class="text-danger">*</i></label>
                            <input type="text" name="nomorTelepon" class="form-control form-control-sm" id="nomorTelepon" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control form-control-sm" id="username" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="">
                        </div>
                        <div class="form-group">
                        <label class="label-katapanda-sm" for="confirm_password">Repeat Password <i class="text-danger">*</i></label>
                            <input type="password" name="confirm_password" class="form-control form-control-sm" id="confirm_password" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="email">Email <i class="text-danger">*</i></label>
                            <input type="email" name="email" class="form-control form-control-sm" id="email" placeholder="">
                        </div>
                        <div class="form-group admin-hide">
                            <label class="label-katapanda-sm" for="userGroup">User Group <i class="text-danger">*</i></label>
                            <select name="userGroup" id="userGroup" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>
                        <div class="form-group admin-hide">
                            <label class="label-katapanda-sm" for="salesAR">Kode Sales AR (optional) </label>
                            <input type="text" name="salesAR" id="salesAR" class="form-control form-control-sm" placeholder="">
                        </div> 
                        
                    </form>
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
                    <p>Approve <span class="text-custom" id="dataApproval"></span> sebagai :</p>
                    <div class="form-group">
                        <select name="userGroupApprove" id="userGroupApprove" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                    </div> 
                    <div id="salesARApprove"></div>
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

<script>

$(document).ready( function () {
    // get last url
    let lastSegmentURL = location.href.match(/([^\/]*)\/*$/)[1];
    let keyword = '';
    if (lastSegmentURL === 'activation') {
        keyword = 'pending';
    } else if (lastSegmentURL === 'verified') {
        keyword = 'verified';
    } else if (lastSegmentURL === 'rejected') {
        keyword = 'rejected';
    }

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
    sumUserRejected();
    sumUserVerified();
    sumUser();
    sumPendingActivation();
    getUserGroup();

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
            doc.content[1].table.widths = [ '15%', '15%', '15%', '15%', '15%', '10%', '15%', '0%' ];
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'left';
                doc.content[1].table.body[i][1].alignment = 'left';
                doc.content[1].table.body[i][2].alignment = 'left';
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
        responsive: true,
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
    let table = $('#katapandaTable').DataTable({
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/user',
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        search: {
            search: keyword
        },
        columns: [
            { data: "fullname", className: "align-middle", responsivePriority: 1 },
            { data: "username", className: "align-middle" },
            { data: "nomor_telepon", className: "align-middle" },
            { data: "email", className: "align-middle", responsivePriority: 5 },
            { data: "id_user_group", className: "align-middle text-center", responsivePriority: 4, render : function ( data, type, row, meta ) { 
                return row.user_group_name;
            }},
            { data: "activation_status", className: "align-middle text-center", responsivePriority: 3, render : function ( data, type, row, meta ) { 
                let label = '';
                if (data === "1") {
                    label += `<button type="button" class="btn btn-sm btn-success">Verified <span class="badge badge-light"></span></button>`;
                } else if (data === "0") {
                    label += `<button type="button" class="btn btn-sm btn-danger">Rejected <span class="badge badge-light"></span></button>`;
                } else {
                    label += `<button type="button" class="btn btn-sm btn-warning">Pending <span class="badge badge-light"></span></button>`;
                }
                label += '</label>'
                
                return label;
            }},
            { data: "activation_at", className: "align-middle", render : function ( data, type, row, meta ) {
                return moment(data, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss');
            }},
            { data: "id", className: "align-middle text-center", width: "10%", responsivePriority: 2, render : function ( data, type, row, meta ) {
                // set by role
                let action = `<div class="btn-group">`;
                actionApproval && row.activation_status === null ? action += `<button class="btn btn-sm btn-outline-success approval" data-toggle="tooltip" data-placement="top" title="Approval"><i class="far fa-clipboard"></i></button>` : '';
                actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                actionDelete && $.inArray(data, ["1"]) === -1 ? action += `<button class="btn btn-sm btn-outline-danger delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : ''; 
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
            // console.log('Edit');
            // console.log(JSON.stringify(item));

            // store data to input
            $('#fullname').val(item.fullname);
            $('#nomorTelepon').val(item.nomor_telepon);
            $('#username').val(item.username);
            $('#email').val(item.email);
            $('#userGroup').val(item.id_user_group).trigger('change');
            $('#userGroupApprove').val(item.id_user_group).trigger('change');
            $('#salesAR').val(item.sales_ar);

            // hide if administrator
            if (item.id_user_group === "1") {
                $('.admin-hide').hide();
            } else {
                $('.admin-hide').show();
            }
            // set
            id = item.id; 

            // store data to confirm delete text
            $('#dataDelete').text(item.fullname);
            
            // store data to approval text
            $('#dataApproval').text(item.fullname);
        });
    
    });

    // modal form add new data  
    $('#newData').click(function() {
        $('.admin-hide').show();
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
            fullname: "required",
            username: {
                required: true,
                minlength: 2
            },
            password: {
                required: false,
                // minlength: 5
            },
            confirm_password: {
                required: false,
                // minlength: 5,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            },
            userGroup: {
                required: true
            },
            salesAR: {
                required: false,
                maxlength: 5
            }
        },
        messages: {
            fullname: "Please enter your fullname",
            username: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 2 characters"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address",
            userGroup: {
                required: "Please select user group"
            },
            salesAR: {
                maxlength: "Sales AR is too long. It must be at most 5 characters long"
            }
        },
        submitHandler: function(form) {
            // start loading
            loadingStart()
            
            // send request 
            axios({
                method: id === null ? `POST` : `PUT`,
                url: id === null ? `<?= site_url() ?>api/web/v1/user` : `<?= site_url() ?>api/web/v1/user/${id}`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>' 
                },
                data: {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    fullname: $('#fullname').val(),
                    nomor_telepon: $('#nomorTelepon').val(),
                    email: $('#email').val(),
                    id_user_group: $('#userGroup').val(),
                    sales_ar: $('#salesAR').val()
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
                    sumUser();
                    sumPendingActivation();
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
                notification(null, 'error', messageError);
            })
            .then(function () {
                // stop loading
                loadingStop()
            })
        }
    })

    // approve 
    $('#approve').click(function() {
        // alert('Approve : ' + `<?= site_url() ?>api/web/v1/user/${id}`)
        
        if ($('#userGroupApprove').val() != '') {
            
            // start loading
            loadingStart()
            // send request 
            axios({
                method: `PUT`,
                url: `<?= site_url() ?>api/web/v1/user/${id}/approve`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>' 
                },
                data: {
                    id_user_group: $('#userGroupApprove').val(),
                    sales_ar: $('#salesArApprove').val()
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
                    sumUser();
                    sumPendingActivation();
                    sumUserVerified();
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
        } else {
            notification('approve', 'warning', 'Please Choose Privilege for User!');
        }
        
    })

    $('#userGroupApprove').change(function() {
        if ($('#userGroupApprove').val() == "2") {
            let template = `<input type="text" id="salesArApprove" class="form-control form-control-sm" placeholder="Kode Sales (Sales AR)">`;
            $('#salesARApprove').html(template);
        } else {
            $('#salesARApprove').html('');
        }
    })

    // reject
    $('#reject').click(function() {
        // alert('Reject : ' + `<?= site_url() ?>api/web/v1/user/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `PUT`,
            url: `<?= site_url() ?>api/web/v1/user/${id}/reject`,
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
                sumUser();
                sumPendingActivation();
                sumUserRejected();
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
        // alert('Delete : ' + `<?= site_url() ?>api/web/v1/user/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `DELETE`,
            url: `<?= site_url() ?>api/web/v1/user/${id}`,
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
                sumUser();
                sumPendingActivation();
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

// get UserGroup
function getUserGroup() {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user-group`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            if (element.id != 1) {
                // add option
                $('#userGroup').append('<option value="'+element.id+'">'+element.user_group_name+'</option>')
                $('#userGroupApprove').append('<option value="'+element.id+'">'+element.user_group_name+'</option>')
            }
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// sum user reject
function sumUserRejected() {
    $('#sumUserRejected').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user/reject/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumUserRejected').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateUserRejected').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumUserRejected').text('Not Found');
        $('#lastUpdateUserRejected').text('-');
    })
}

// sum user verified
function sumUserVerified() {
    $('#sumUserRejected').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user/verify/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumUserVerified').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateUserVerified').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumUserVerified').text('Not Found');
        $('#lastUpdateUserVerified').text('-');
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

// get sum User Pending Activation
function sumPendingActivation() {
    $('#sumPendingActivation').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/user/activation/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumPendingActivation').text(response.data.data.total_rows + ' Data');
        $('#lastUpdatePendingActivation').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumPendingActivation').text('Not Found');
        $('#lastUpdatePendingActivation').text('-');
    })
}
</script>
