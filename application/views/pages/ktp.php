
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (KTP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i> <?= date('d-m-Y') ?></span>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-address-card fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card h-100 ml-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (NPWP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">80</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i> <?= date('d-m-Y') ?></span>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-credit-card fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item">Identity Card</li>
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
                <div class="p-3">
                <table class="table nowrap table-md text-katapanda-sm" id="katapandaTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot class="">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn</th>
                            <th>Start date</th>
                            <th>Salary</th>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <label class="label-katapanda-sm" for="nik">NIK <i class="text-danger">*</i></label>
                            <input type="text" name="nik" class="form-control form-control-sm" id="nik" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control form-control-sm" id="nama" placeholder="">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="tempatLahir">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempatLahir" class="form-control form-control-sm" id="tempatLahir" placeholder="Tempat Lahir">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="tanggalLahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggalLahir" class="form-control form-control-sm" id="tanggalLahir" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="nama">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="custom-control custom-radio ">
                                    <input type="radio" id="jenisKelamin" name="jenisKelamin" value="laki-laki" class="custom-control-input">
                                    <label class="custom-control-label text-katapanda-sm" for="jenisKelamin">Laki-Laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="jenisKelamin2" name="jenisKelamin" value="perempuan" class="custom-control-input">
                                    <label class="custom-control-label text-katapanda-sm" for="jenisKelamin2">Perempuan</label>
                                </div>
                            </div>   
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="golonganDarah">Golongan Darah</label>
                                <select name="golonganDarah" id="golonganDarah" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div> 
                        </div>  
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="provinsi">Alamat <span class="text-danger">*</span></label>
                            <select name="provinsi" id="provinsi" class="selectpicker form-control form-control-sm" data-live-search="true" title="Provinsi">
                                    
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kabupaten" id="kabupaten" class="selectpicker form-control form-control-sm" data-live-search="true" title="Kabupaten">
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kecamatan" id="kecamatan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Kecamatan">
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <select name="kelurahan" id="kelurahan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Kelurahan/Desa">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="kodePos" id="kodePos" class="selectpicker form-control form-control-sm" data-live-search="true" title="Kode POS">
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label class="label-katapanda-sm" for="jalan">Jalan <span class="text-danger">*</span></label>
                                <input type="text" name="jalan" class="form-control form-control-sm" id="jalan" placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="rt">RT <span class="text-danger">*</span></label>
                                <input type="text" name="rt" class="form-control form-control-sm" id="rt">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="rw">RW <span class="text-danger">*</span></label>
                                <input type="text" name="rw" class="form-control form-control-sm" id="rw">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="nama">Status Perkawinan</label>
                                <div class="custom-control custom-radio ">
                                    <input type="radio" id="statusPerkawinan" name="statusPerkawinan" value="kawin" class="custom-control-input">
                                    <label class="custom-control-label text-katapanda-sm" for="statusPerkawinan">Kawin</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="statusPerkawinan2" name="statusPerkawinan" value="belum kawin" class="custom-control-input">
                                    <label class="custom-control-label text-katapanda-sm" for="statusPerkawinan2">Belum Kawin</label>
                                </div>
                            </div> 
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="agama">Agama</label>
                                <select name="agama" id="agama" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="protestan">Protestan</option>
                                    <option value="budha">Budha</option>
                                    <option value="hindu">Hindu</option>
                                </select>
                            </div>  
                        </div> 
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control form-control-sm" id="pekerjaan" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="kewarganegaraan">Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan" class="form-control form-control-sm" id="kewarganegaraan" placeholder="WNI" value="WNI">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-secondary" id="tes">Tes</button>
                    <button type="button" class="btn btn-outline-secondary" id="btnResetFormInput">Reset Form</button>
                    <button type="submit" class="btn bg-custom">Save changes</button>
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
    $('#jenisKelamin').prop("checked", true);
    $('#jenisKelamin2').prop("checked", false);
    $('#statusPerkawinan').prop("checked", false);
    $('#statusPerkawinan2').prop("checked", true);
    getProvinsi();
    
    // button default for action datatables
    let buttonAction = ['copyHtml5']; // add button to copy data

    // button action by user role 
    actionCreate ? $('#actionCreate').html('<button class="btn btn-sm btn-outline-primary" id="newData"><i class="fas fa-plus"></i> New Data</button>') : '';
    actionExportToExcel ? buttonAction.push('excelHtml5') : ''; // button export to excel 
    actionExportToCsv ? buttonAction.push('csvHtml5') : ''; // button export to csv
    actionExportToPdf ? buttonAction.push('pdfHtml5') : ''; // button export to pdf
    
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
    let table = $('#katapandaTable').DataTable({
        data: data, // data
        // ajax: 'https://jsonplaceholder.typicode.com/posts', //array object
        // ajax: { // array
        //     url: 'https://jsonplaceholder.typicode.com/posts',
        //     dataSrc: ''
        // },
        columns: [
            { data: "name" },
            { data: "position" },
            { data: "office" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary" },
            { data: "id" , render : function ( data, type, row, meta ) {
                // set by role
                let action = `<div class="btn-group">`;
                actionApproval ? action += `<button class="btn btn-sm btn-outline-success approval" data-toggle="tooltip" data-placement="top" title="Approval"><i class="far fa-clipboard"></i></button>` : '';
                actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                actionDelete ? action += `<button class="btn btn-sm btn-outline-danger delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : ''; 
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
    });

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
            $('#nik').val(item.id);
            $('#nama').val(item.name);
            $('#tempatLahir').val(item.office);
            id = item.id; 

            // store data to confirm delete text
            $('#dataDelete').text(item.name);
            
            // store data to approval text
            $('#dataApproval').text(item.name);
        });
    
    });

    // modal form add new data  
    $('#newData').click(function() {
        // reset ID
        id = null;
        // reset validator in the form
        validator.resetForm()
        // reset Form
        // resetFormInput();

        // show modal
        $('#formTitle').html('<i class="far fa-address-card"></i> New <?= $title ?>');
        $('#btnSubmit').text('Save');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "");
    })

    // modal form edit in desktop mode
    $('.edit').click(function() {
        // reset validator in the form
        validator.resetForm()

        // show modal
        $('#formTitle').html('<i class="far fa-address-card"></i> Edit <?= $title ?>');
        $('#btnSubmit').text('Update');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "none");
    })

    // modal form edit in tablet/mobile mode
    $('#katapandaTable tbody').on( 'click', '.edit', function () {
        // reset validator in the form
        validator.resetForm()
        // show modal
        $('#formTitle').html('<i class="far fa-address-card"></i> Edit <?= $title ?>');
        $('#btnSubmit').text('Update');
        $('#formKatapanda').modal({ backdrop: 'static' }, 'show')
        $('#btnResetFormInput').css("display", "none");
    })

    // confirm delete 
    $('#katapandaTable tbody').on( 'click', '.delete', function () {
        // show confirm
        $('#confirmTitle').html('<i class="far fa-address-card"></i> Delete <?= $title ?>');
        $('#confirmKatapanda').modal('show')
    })

    // approval 
    $('#katapandaTable tbody').on( 'click', '.approval', function () {
        // show confirm
        $('#approvalTitle').html('<i class="far fa-address-card"></i> Approval <?= $title ?>');
        $('#approvalKatapanda').modal('show')
    })

    // validate and request add new data and update existing data 
    let validator = $('#form').validate({
        rules: {
            nik: {
                required: true,
                minlength: 2
            },
            nama: {
                required: true,
                minlength: 2
            },
            tempatLahir: {
                required: true
            },
            tanggalLahir: {
                required: true
            },
            jenisKelamin: {
                required: true
            },
            provinsi: {
                required: true
            },
            kabupaten: {
                required: true
            },
            kecamatan: {
                required: true
            },
            kelurahan: {
                required: true
            },
            jalan: {
                required: true
            },
            rt: {
                required: true,
                maxlength: 3
            },
            rw: {
                required: true,
                maxlength: 3
            }
        },
        messages: {
            nik: {
                required: "Please enter NIK",
                minlength: "Your NIK must consist of at least 2 characters"
            },
            nama: {
                required: "Please enter Nama",
                minlength: "Your Nama must consist of at least 2 characters"
            },
            tempatLahir: {
                required: "Please enter Tempat Lahir",
            },
            tanggalLahir: {
                required: "Please enter Tanggal Lahir",
            },
            jenisKelamin: {
                required: "Please select Jenis Kelamin",
            },
            provinsi: {
                required: "Please select Provinsi",
            },
            kabupaten: {
                required: "Please select Kabupaten",
            },
            kecamatan: {
                required: "Please select Kecamatan",
            },
            kelurahan: {
                required: "Please select Kelurahan",
            },
            jalan: {
                required: "Please enter Jalan",
            },
            rt: {
                required: "Please enter RT",
                maxlength: "RT maximum of 3 characters"
            },
            rw: {
                required: "Please enter RW",
                maxlength: "RW nik maximum of 3 characters"
            }
        },
        submitHandler: function(form) {
            // start loading
            loadingStart()
            
            // send request 
            axios({
                method: id === null ? `POST` : `PUT`,
                url: id === null ? `<?= site_url() ?>api/web/v1/ktp` : `<?= site_url() ?>api/web/v1/ktp/${id}`,
                data: {
                    nik: $('#nik').val(),
                    nama: $('#nama').val(),
                    tempat_lahir: $('#tempatLahir').val(),
                    tgl_lahir: $('#tanggalLahir').val(),
                    jenis_kelamin: $('input[name="jenisKelamin"]:checked').val(),
                    golongan_darah: $('#golonganDarah').val(),
                    provinsi: $('#provinsi option:selected').text(),
                    kabupaten: $('#kabupaten option:selected').text(),
                    kecamatan: $('#kecamatan option:selected').text(),
                    kelurahan: $('#kelurahan option:selected').text(),
                    kodepos: $('#kodePos option:selected').text(),
                    alamat: $('#jalan').val(),
                    rt: $('#nama').val(),
                    rw: $('#rw').val(),
                    status_perkawinan: $('input[name="statusPerkawinan"]:checked').val(),
                    agama: $('#agama').val(),
                    pekerjaan: $('#pekerjaan').val(),
                    kewarganegaraan: $('#kewarganegaraan').val()
                }
            })
            .then(function (response) {
                console.log(response);
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
        // alert('Approve : ' + `<?= site_url() ?>api/web/v1/ktp/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `GET`,
            url: `<?= site_url() ?>api/web/v1/ktp/${id}/approve`
        })
        .then(function (response) {
            console.log(response);
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
        // alert('Reject : ' + `<?= site_url() ?>api/web/v1/ktp/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `GET`,
            url: `<?= site_url() ?>api/web/v1/ktp/${id}/reject`
        })
        .then(function (response) {
            console.log(response);
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
        // alert('Delete : ' + `<?= site_url() ?>api/web/v1/ktp/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `DELETE`,
            url: `<?= site_url() ?>api/web/v1/ktp/${id}`
        })
        .then(function (response) {
            console.log(response);
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

    // store data kabupaten to select
    $('#provinsi').change(function() {
        $('#kabupaten').empty();
        $('#kecamatan').empty();
        $('#kelurahan').empty();
        $('#kodePos').empty();
        getKabupaten(this.value);
    })

    // store data kecamatan to select
    $('#kabupaten').change(function() {
        $('#kecamatan').empty();
        $('#kelurahan').empty();
        $('#kodePos').empty();
        getKecamatan(this.value);
    })
    
    // store data kelurahan to select
    $('#kecamatan').change(function() {
        $('#kelurahan').empty();
        $('#kodePos').empty();
        getKelurahan(this.value);
        getKodePos(this.value);
    })

    $('#tes').click(function() {
        let data = {
            nik: $('#nik').val(),
            nama: $('#nama').val(),
            tempat_lahir: $('#tempatLahir').val(),
            tgl_lahir: $('#tanggalLahir').val(),
            jenis_kelamin: $('input[name="jenisKelamin"]:checked').val(),
            golongan_darah: $('#golonganDarah').val(),
            provinsi: $('#provinsi option:selected').text(),
            kabupaten: $('#kabupaten option:selected').text(),
            kecamatan: $('#kecamatan option:selected').text(),
            kelurahan: $('#kelurahan option:selected').text(),
            kodepos: $('#kodePos option:selected').text(),
            alamat: $('#jalan').val(),
            rt: $('#nama').val(),
            rw: $('#rw').val(),
            status_perkawinan: $('input[name="statusPerkawinan"]:checked').val(),
            agama: $('#agama').val(),
            pekerjaan: $('#pekerjaan').val(),
            kewarganegaraan: $('#kewarganegaraan').val()
        }

        console.log(data);
        
    })

} );

// reset Form
function resetFormInput() {
    $('#form').trigger("reset");
    $('.selectpicker').selectpicker('refresh');
}

// get Provinsi
function getProvinsi() {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/provinsi`,
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MX0.kIAAEvot-QVTM_uFWtQtISAhZGxs6GUCtjMWIssCprU' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#provinsi').append('<option value="'+element.id+'">'+element.provinsi+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.log(error);
    })
}

// get Kabupaten
function getKabupaten(idProvinsi) {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/kabupaten/${idProvinsi}`,
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MX0.kIAAEvot-QVTM_uFWtQtISAhZGxs6GUCtjMWIssCprU' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kabupaten').append('<option value="'+element.id+'">'+element.kabupaten_kota+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.log(error);
    })
}

// get Kecamatan
function getKecamatan(idKabupaten) {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/kecamatan/${idKabupaten}`,
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MX0.kIAAEvot-QVTM_uFWtQtISAhZGxs6GUCtjMWIssCprU' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kecamatan').append('<option value="'+element.id+'">'+element.kecamatan+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.log(error);
    })
}

// get Kelurahan
function getKelurahan(idKecamatan) {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/kelurahan/${idKecamatan}`,
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MX0.kIAAEvot-QVTM_uFWtQtISAhZGxs6GUCtjMWIssCprU' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kelurahan').append('<option value="'+element.id+'">'+element.kelurahan+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.log(error);
    })
}

// get KodePos
function getKodePos(idKecamatan) {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/kode-pos/${idKecamatan}`,
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MX0.kIAAEvot-QVTM_uFWtQtISAhZGxs6GUCtjMWIssCprU' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kodePos').append('<option value="'+element.kd_pos+'">'+element.kd_pos+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        console.log(error);
    })
}
</script>
