<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

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
                        <!-- <div id="actionCreate"></div> -->
                        <div class="btn-group">
                            <button class="btn btn-outline-light collapsed" type="button" data-toggle="collapse" data-target="#accessData" aria-expanded="false" aria-controls="accessData"><i class="fas fa-network-wired"></i> Access Data</button>
                            <button class="btn btn-outline-light collapsed" type="button" data-toggle="collapse" data-target="#other" aria-expanded="false" aria-controls="other"><i class="fas fa-globe"></i> Other</button>
                        </div>
                    </div>
                </div>

                <div id="accordion">
                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="collapse show" id="accessData" data-parent="#accordion">
                                <div class="table-responsive">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="label-katapanda-sm" for="user">Give permission for user :</label>
                                            <select name="user" id="user" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose User"></select>
                                        </div>
                                        <div class="form-group col-md-8"><br />
                                            <label class="label-katapanda-sm pt-3" for="user"> to access data :</label>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered nowrap table-md text-katapanda-sm" id="katapandaTable" width="100%">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Fullname</th>
                                                <th>Group</th>
                                                <th>Sales AR</th>
                                                <th>Mark</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="">
                                            <tr>
                                                <th colspan="4"><span id="btnSubmit"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="collapse" id="other" data-parent="#accordion">
                                <div class="card card-body">
                                    No Content!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->


<!-- <script src="<?= base_url('assets/'); ?>js/tokenExpired.js"></script> -->
<script>
    $(document).ready(function() {

        // init variable
        let id = null;
        let actionCreate = <?php echo $action_create == 1 ? 1 : 0; ?>;
        let actionUpdate = <?php echo $action_update == 1 ? 1 : 0; ?>;
        let actionDelete = <?php echo $action_delete == 1 ? 1 : 0; ?>;
        let actionApproval = <?php echo $action_approval == 1 ? 1 : 0; ?>;
        let actionExportToExcel = <?php echo $action_export_to_excel == 1 ? 1 : 0; ?>;
        let actionExportToCsv = <?php echo $action_export_to_csv == 1 ? 1 : 0; ?>;
        let actionExportToPdf = <?php echo $action_export_to_pdf == 1 ? 1 : 0; ?>;

        // button default for action datatables
        let buttonAction = ['copyHtml5']; // add button to copy data

        // store to select
        getUser();

        // button action by user role 
        actionCreate ? $('#actionCreate').html('') : '';
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
            customize: function(doc) {
                doc.defaultStyle.fontSize = 6;
                doc.styles.tableHeader.fontSize = 7;
                doc.styles.tableFooter.fontSize = 7;
                doc.styles.tableHeader.alignment = 'left';
                doc.pageMargins = [20, 60, 20, 30];
                doc.content[1].table.widths = ['18%', '8%', '8%', '8%', '8%', '8%', '8%', '8%', '10%', '8%', '8%'];
                var rowCount = doc.content[1].table.body.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'left';
                    doc.content[1].table.body[i][1].alignment = 'center';
                    doc.content[1].table.body[i][2].alignment = 'center';
                    doc.content[1].table.body[i][3].alignment = 'center';
                    doc.content[1].table.body[i][4].alignment = 'center';
                    doc.content[1].table.body[i][5].alignment = 'center';
                    doc.content[1].table.body[i][6].alignment = 'center';
                    doc.content[1].table.body[i][7].alignment = 'center';
                    doc.content[1].table.body[i][8].alignment = 'center';
                    doc.content[1].table.body[i][9].alignment = 'center';
                    doc.content[1].table.body[i][10].alignment = 'center';
                }
                var objLayout = {};
                objLayout['hLineWidth'] = function(i) {
                    return .5;
                };
                objLayout['vLineWidth'] = function(i) {
                    return .5;
                };
                objLayout['hLineColor'] = function(i) {
                    return '#aaa';
                };
                objLayout['vLineColor'] = function(i) {
                    return '#aaa';
                };
                objLayout['paddingLeft'] = function(i) {
                    return 4;
                };
                objLayout['paddingRight'] = function(i) {
                    return 4;
                };
                doc.content[0].layout = objLayout;
            }
        }) : '';
        // setting dataTables
        $.extend(true, $.fn.dataTable.defaults, {
            responsive: false,
            fixedHeader: {
                header: true,
                footer: true
            },
            paging: false,
            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Nothing found - sorry",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBfrtip',
            buttons: buttonAction
        });

        // store data to dataTables 
        $.fn.dataTable.ext.errMode = 'none';
        let check = '';
        let table = $('#katapandaTable')
            .on('error.dt', function(e) {})
            .DataTable({
                ajax: { // array
                    url: `<?= site_url() ?>api/web/v1/user-access-data`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    },
                    contentType: "application/json",
                    type: "POST",
                    data: function() {
                        return JSON.stringify({
                            id_user: $('#user').val()
                        });
                    },
                    complete: function(res) {
                        // console.log(res);
                        if (res.status == 200) {
                            let btn = `<button class="btn bg-custom btn-sm btn-block">SAVE PERMISSION</button>`;
                            $('#btnSubmit').html(btn);
                        } else {
                            $('#btnSubmit').html('');
                        }
                    }
                },
                columns: [{
                        data: "fullname",
                        className: "align-middle",
                        width: "60%",
                        responsivePriority: 1,
                        render: function(data, type, row, meta) {
                            check = `${data.toUpperCase()}`;
                            return check;
                        }
                    },
                    {
                        data: "user_group_name",
                        className: "align-middle",
                        responsivePriority: 2,
                        width: "20%",
                        render: function(data, type, row, meta) {
                            check = `${data.toUpperCase()}`;
                            return check;
                        }
                    },
                    {
                        data: "sales_ar",
                        className: "align-middle text-center",
                        width: "10%",
                    },
                    {
                        data: "access_to",
                        className: "align-middle text-center",
                        width: "10%",
                        render: function(data, type, row, meta) {
                            check = `<input type="checkbox" name="access_data" value="${row.id}" ${data != null ? 'checked' : ''}>`;
                            return check;
                        }
                    },
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
        $('#enable').on('click', function() {
            table.fixedHeader.enable();
            $('#enable').css("display", "none");
            $('#disable').css("display", "");
        });

        // Button Disable Fixed Header
        $('#disable').on('click', function() {
            table.fixedHeader.disable();
            $('#enable').css("display", "");
            $('#disable').css("display", "none");
        });

        // getter and setter data in the row to form input
        $('#katapandaTable tbody').on('click', 'tr', function() {

            var ids = $.map(table.rows(this).data(), function(item) {
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

        // submit  
        $('#btnSubmit').click(function() {
            let access_data = [];
            $("input:checkbox[name=access_data]:checked").each(function() {
                access_data.push($(this).val());
            });
            let user = $('#user').val();
            let post = {
                'access_data': access_data,
            }

            // console.log(post);
            // start loading
            loadingStart()

            // send request 
            axios({
                    method: `PUT`,
                    url: `<?= site_url() ?>api/web/v1/user-access-data/${user}`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    },
                    data: post
                })
                .then(function(response) {
                    // console.log(response);
                    let status = response.data.status;
                    let message = response.data.message;
                    let action = `update`;
                    if (status) {
                        // show message
                        notification(action, 'success', message);
                        $('#katapandaTable').DataTable().ajax.reload();
                    } else {
                        // show message
                        notification(action, 'error', message);
                    }
                })
                .catch(function(error) {
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
                .then(function() {
                    // stop loading
                    loadingStop()
                })

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
                    .then(function(response) {
                        // console.log(response);
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = id === null ? `create` : `update`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            $('#formKatapanda').modal('hide');
                            $('#katapandaTable').DataTable().ajax.reload();
                        } else {
                            // show message
                            notification(action, 'error', message);
                        }
                    })
                    .catch(function(error) {
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
                    .then(function() {
                        // stop loading
                        loadingStop()
                    })
            }
        })

        $('#user').change(function() {
            table.clear().draw();
            table.ajax.reload();
        })

        // button reset Form Input
        $('#btnResetFormInput').click(function() {
            // reset Form Input
            resetFormInput();
        })

        $.fn.digits = function() {
            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            })
        }

    });

    // reset Form
    function resetFormInput() {
        $('#form').trigger("reset");
    }

    function getUser() {
        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/user`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                $('#user').empty();
                let selected = '';
                response.data.data.forEach(element => {
                    if (<?= $id_user_group ?> == 1) {
                        // add option
                        $('#user').append('<option value="' + element.id + '">' + element.fullname.toUpperCase() + '</option><option data-divider="true"></option>')
                        if (<?= $user_id ?> == element.id) {
                            selected = element.id;
                        }
                    } else {
                        if (<?= $user_id ?> == element.id) {
                            // add option
                            $('#user').append('<option value="' + element.id + '">' + element.fullname.toUpperCase() + '</option><option data-divider="true"></option>')
                            selected = element.id;
                        }
                    }

                });
                // refresh selectpicker
                $('.selectpicker').selectpicker('refresh');
                $('#user').val(selected).trigger('change');

            })
            .catch(function(error) {
                // console.log(error);
            })
    }
</script>