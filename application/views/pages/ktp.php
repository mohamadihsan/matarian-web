
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (KTP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumKTP" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateKTP"></span><br/>
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
                <a href="<?= site_url('npwp') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (NPWP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumNPWP" class="numbers"></span></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i></span>
                                <span id="lastUpdateNPWP"></span><br/>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-credit-card fa-2x text-warning"></i>
                        </div>
                    </div>
                </a>
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
                <div class="table-responsive p-3">
                <table class="table table-striped table-bordered table-sm text-katapanda-sm" id="katapandaTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center text-nowrap">NIK</th>
                            <th class="text-center text-nowrap">Nama</th>
                            <th class="text-center text-nowrap">Alamat</th>
                            <th class="text-center text-nowrap">Kelurahan</th>
                            <th class="text-center text-nowrap">Kecamatan</th>
                            <th class="text-center text-nowrap">Kabupaten</th>
                            <th class="text-center text-nowrap">Provinsi</th>
                            <th class="text-center text-nowrap">Kode Pos</th>
                            <th class="text-center text-nowrap"></th>
                        </tr>
                    </thead>
                    <tfoot class="">
                        <tr>
                            <th class="text-center text-nowrap">NIK</th>
                            <th class="text-center text-nowrap">Nama</th>
                            <th class="text-center text-nowrap">Alamat</th>
                            <th class="text-center text-nowrap">Kelurahan</th>
                            <th class="text-center text-nowrap">Kecamatan</th>
                            <th class="text-center text-nowrap">Kabupaten</th>
                            <th class="text-center text-nowrap">Provinsi</th>
                            <th class="text-center text-nowrap">Kode Pos</th>
                            <th class="text-center text-nowrap"></th>
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
                                <input type="text" name="tanggalLahir" class="form-control form-control-sm" id="tanggalLahir" placeholder="Tanggal Lahir">
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
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-katapanda-sm" for="golonganDarah">Golongan Darah</label>
                                <select name="golonganDarah" id="golonganDarah" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
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
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label class="label-katapanda-sm" for="jalan">Jalan <span class="text-danger">*</span></label>
                                <input type="text" name="jalan" class="form-control form-control-sm" id="jalan" placeholder="">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="rt">RT</label>
                                <input type="text" name="rt" class="form-control form-control-sm" id="rt">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="rw">RW</label>
                                <input type="text" name="rw" class="form-control form-control-sm" id="rw">
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
                        <div class="form-group d-none">
                            <label class="label-katapanda-sm" for="kewarganegaraan">Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan" class="form-control form-control-sm" id="kewarganegaraan" placeholder="WNI" value="WNI">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <!-- <button type="button" class="btn btn-secondary" id="btnResetFormInput">Reset Form</button> -->
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

<!-- Detail -->
<div class="modal fade" id="detailKatapanda" tabindex="-1" role="dialog" aria-labelledby="detailKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-custom">
                <h6 class="modal-title" id="detailTitle"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="dataLengkap"></div>
            </div>
        </div> 
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
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('#tanggalLahir').datepicker({
        autoclose: true, 
        todayHighlight: true,
        clearBtn: true
    }).datepicker();
    
    // init function
    sumKTP();
    sumNPWP();
    getProvinsi();
    
    $('#nik').mask('0000000000000000', {placeholder: "________________"});
    
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
            doc.content[1].table.widths = [ '15%', '20%', '15%', '10%', '10%', '10%', '12%', '7%', '0%' ];
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'left';
                doc.content[1].table.body[i][1].alignment = 'left';
                doc.content[1].table.body[i][2].alignment = 'left';
                doc.content[1].table.body[i][3].alignment = 'left';
                doc.content[1].table.body[i][4].alignment = 'left';
                doc.content[1].table.body[i][5].alignment = 'left';
                doc.content[1].table.body[i][6].alignment = 'left';
                doc.content[1].table.body[i][7].alignment = 'center';
            }
            doc['footer']=(function(page, pages) {
                return {
                    columns: [
                        'exported at ' + moment(new Date()).format('YYYY-MM-DD hh:mm:ss'),
                        {
                            alignment: 'right',
                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                        }
                    ],
                    margin: [20, 10]
                }
            });
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
    let table = $('#katapandaTable').DataTable({
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/ktp',
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        columns: [
            { data: "nik", className: "align-middle", responsivePriority: 1 },
            { data: "nama", className: "align-middle", responsivePriority: 3 },
            { data: "alamat", className: "align-middle", responsivePriority: 5 },
            { data: "kelurahan", className: "align-middle", responsivePriority: 6 },
            { data: "kecamatan", className: "align-middle", responsivePriority: 7 },
            { data: "kabupaten", className: "align-middle", responsivePriority: 8 },
            { data: "provinsi", className: "align-middle", responsivePriority: 9 },
            { data: "kodepos", className: "align-middle", visible: false, responsivePriority: 4 },
            { data: "id", className: "align-middle text-center", responsivePriority: 2, render : function ( data, type, row, meta ) {
                // set by role
                let action = `<div class="btn-group"><button class="btn btn-sm btn-outline-info detail" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button>`;
                // actionApproval ? action += `<button class="btn btn-sm btn-outline-success approval" data-toggle="tooltip" data-placement="top" title="Approval"><i class="far fa-clipboard"></i></button>` : '';
                actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning d-none d-sm-block edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                actionDelete ? action += `<button class="btn btn-sm btn-outline-danger d-none d-sm-block delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : ''; 
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

    new $.fn.dataTable.FixedHeader( table );


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
        
        var ids = $.map(table.rows(this).data(), async function (item) {
            // alert(JSON.stringify(item))
            // console.log('Edit');
            // console.log(JSON.stringify(item));

            let tempProvinsi = item.provinsi;
            let tempKabupaten = item.kabupaten;
            let tempKecamatan = item.kecamatan;
            let tempKelurahan = item.kelurahan;
            let tempKodePos = item.kodePos;
            
            await getWilayah(tempProvinsi, tempKabupaten, tempKecamatan, tempKelurahan, tempKodePos);

            // store data to input
            $('#nik').val(item.nik);
            $('#nama').val(item.nama);
            $('#tempatLahir').val(item.tempat_lahir);
            // $('#tanggalLahir').val(item.tgl_lahir);
            $('#tanggalLahir').datepicker({
                autoclose: true, 
                todayHighlight: true,
                clearBtn: true
            }).datepicker('update', moment(new Date(item.tgl_lahir)).format('DD-MM-YYYY'));
            // $('#jenisKelamin').val(item.jenis_kelamin);
            item.jenis_kelamin.toLowerCase() == 'laki-laki' ? $('#jenisKelamin').prop('checked',true) : $('#jenisKelamin2').prop('checked',true);
            $('#jalan').val(item.alamat);
            $('#rt').val(item.rt);
            $('#rw').val(item.rw);
            $('#golonganDarah').val(item.golongan_darah).trigger('change');
            item.status_perkawinan.toLowerCase() == 'kawin' ? $('#statusPerkawinan').prop('checked',true) : $('#statusPerkawinan2').prop('checked',true);
            $('#agama').val(item.agama).trigger('change');
            $('#pekerjaan').val(item.pekerjaan);
            $('#kewarganegaraan').val(item.kewarganegaraan);

            id = item.id; 

            // store data to confirm delete text
            $('#dataDelete').text(item.nik);
            
            // store data to approval text
            $('#dataApproval').text(item.nik);

            // store to detail
            let imageSource;

            if (item.jenis_kelamin.toLowerCase() == 'laki-laki') {
                imageSource = `<?= base_url('assets/img/boy.png') ?>`;
            } else if (item.jenis_kelamin.toLowerCase() == 'perempuan') {
                imageSource = `<?= base_url('assets/img/girl.png') ?>`;
            } else {
                imageSource = `<?= base_url('assets/img/default.png') ?>`;
            }
            let template = `<div class="h6 text-center font-weight-bold mb-3">PROVINSI ${item.provinsi !== null ? item.provinsi : '-' } <br/> ${item.kabupaten !== null ? item.kabupaten : '-' }</div>
                <img src="${imageSource}" alt="" class="d-none d-sm-block" style="float: right; width: 250px; padding-right: 10%">
                <dl class="row">
                    <dt class="col-sm-3 font-weight-bold">NIK</dt>
                    <dd class="col-sm-9 font-weight-bold mb-2 text-uppercase">${item.nik !== null ? item.nik : '-' }</dd>

                    <dt class="col-sm-4" style="font-size: 13px">Nama</dt>
                    <dd class="col-sm-8 text-uppercase" style="font-size: 13px">${item.nama !== null ? item.nama : '-' }</dd>

                    <dt class="col-sm-4" style="font-size: 13px">Tempat/Tgl Lahir</dt>
                    <dd class="col-sm-8 text-uppercase" style="font-size: 13px">${item.tempat_lahir !== null ? item.tempat_lahir : '-' }, ${item.tgl_lahir !== null ? moment(item.tgl_lahir, 'YYYY-MM-DD').format('DD-MM-YYYY') : '-' }</dd>

                    <dt class="col-sm-4" style="font-size: 13px">Jenis Kelamin</dt>
                    <dd class="col-sm-3 text-uppercase" style="font-size: 13px">${item.jenis_kelamin !== null ? item.jenis_kelamin : '-' }</dd>

                    <dt class="col-sm-3 text-uppercase" style="font-size: 13px">Gol. Darah : ${item.golongan_darah !== null ? item.golongan_darah : '-' }</dt>

                    <dt class="col-sm-4 text-katapanda-sm" style="font-size: 13px">Alamat</dt>
                    <dd class="col-sm-7 text-uppercase text-katapanda-sm" style="font-size: 13px">${item.alamat !== null ? item.alamat : '-' }</dd>
                    
                    <dt class="col-sm-4 text-katapanda-sm ml-4" style="font-size: 13px">RT/RW</dt>
                    <dd class="col-sm-7 text-uppercase text-katapanda-sm" style="margin-left: -25px; font-size: 13px">${item.rt !== null ? item.rt : '-' } / ${item.rw !== null ? item.rw : '-' }</dd>
                    
                    <dt class="col-sm-4 text-katapanda-sm ml-4" style="font-size: 13px">Kel/Desa</dt>
                    <dd class="col-sm-7 text-uppercase text-katapanda-sm" style="margin-left: -25px; font-size: 13px">${item.kelurahan !== null ? item.kelurahan : '-' }</dd>
                    
                    <dt class="col-sm-4 text-katapanda-sm ml-4" style="font-size: 13px">Kecamatan</dt>
                    <dd class="col-sm-7 text-uppercase text-katapanda-sm" style="margin-left: -25px; font-size: 13px">${item.kecamatan !== null ? item.kecamatan : '-' }</dd>
                    
                    <dt class="col-sm-4" style="font-size: 13px">Agama</dt>
                    <dd class="col-sm-8 text-uppercase" style="font-size: 13px">${item.agama !== null ? item.agama : '-' }</dd>
                    
                    <dt class="col-sm-4" style="font-size: 13px">Status Perkawinan</dt>
                    <dd class="col-sm-8 text-uppercase" style="font-size: 13px">${item.status_perkawinan !== null ? item.status_perkawinan : '-' }</dd>
                    
                    <dt class="col-sm-4" style="font-size: 13px">Pekerjaan</dt>
                    <dd class="col-sm-8 text-uppercase" style="font-size: 13px">${item.pekerjaan !== null ? item.pekerjaan : '-' }</dd>
                    
                    <dt class="col-sm-4" style="font-size: 13px">Kewarganegaraan</dt>
                    <dd class="col-sm-3 text-uppercase" style="font-size: 13px">${item.kewarganegaraan !== null ? item.kewarganegaraan : '-' }</dd>
                
                    <dt class="col-sm-5 text-uppercase" style="font-size: 13px">Kode Pos : ${item.kodepos !== null ? item.kodepos : '-' }</dt>
                </dl>`;
            $('#dataLengkap').html(template);    
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
    
    // detail 
    $('#katapandaTable tbody').on( 'click', '.detail', function () {
        // show 
        $('#detailTitle').html('<i class="far fa-address-card"></i> Detail <?= $title ?>');
        $('#detailKatapanda').modal('show')
    })

    // validate and request add new data and update existing data 
    let validator = $('#form').validate({
        rules: {
            nik: {
                required: true,
                minlength: 16,
                maxlength: 16
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
                maxlength: 3
            },
            rw: {
                maxlength: 3
            }
        },
        messages: {
            nik: {
                required: "Please enter NIK",
                minlength: "Your NIK must consist of at least 16 characters",
                maxlength: "Your NIK must consist of at least 16 characters"
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
                maxlength: "RT maximum of 3 characters"
            },
            rw: {
                maxlength: "RW maximum of 3 characters"
            }
        },
        submitHandler: function(form) {
            // start loading
            loadingStart()
            
            // send request 
            axios({
                method: id === null ? `POST` : `PUT`,
                url: id === null ? `<?= site_url() ?>api/web/v1/ktp` : `<?= site_url() ?>api/web/v1/ktp/${id}`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>' 
                },
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
                    rt: $('#rt').val(),
                    rw: $('#rw').val(),
                    status_perkawinan: $('input[name="statusPerkawinan"]:checked').val(),
                    agama: $('#agama').val(),
                    pekerjaan: $('#pekerjaan').val(),
                    kewarganegaraan: $('#kewarganegaraan').val()
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
                    sumKTP();
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
        // alert('Approve : ' + `<?= site_url() ?>api/web/v1/ktp/${id}`)
        
        // start loading
        loadingStart()
        // send request 
        axios({
            method: `GET`,
            url: `<?= site_url() ?>api/web/v1/ktp/${id}/approve`,
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        })
        .then(function (response) {
            // console.log(response);
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
            url: `<?= site_url() ?>api/web/v1/ktp/${id}/reject`,
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        })
        .then(function (response) {
            // console.log(response);
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
            url: `<?= site_url() ?>api/web/v1/ktp/${id}`,
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
                sumKTP();
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
    })

    // store data kode pos to select
    $('#kelurahan').change(function() {
        $('#kodePos').empty();
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

        // console.log(data);
        
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
    $('.selectpicker').selectpicker('refresh');

    $('#jenisKelamin').prop("checked", true);
    $('#jenisKelamin2').prop("checked", false);
    $('#statusPerkawinan').prop("checked", false);
    $('#statusPerkawinan2').prop("checked", true);
}

// get sum KTP
function sumKTP() {
    $('#sumKTP').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/ktp/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumKTP').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateKTP').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumKTP').text('Not Found');
        $('#lastUpdateKTP').text('-');
    })
}

// get sum NPWP
function sumNPWP() {
    $('#sumNPWP').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/npwp/count`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        $('#sumNPWP').text(response.data.data.total_rows + ' Data');
        $('#lastUpdateNPWP').text(moment(response.data.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));

        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
        $('#sumNPWP').text('Not Found');
        $('#lastUpdateNPWP').text('-');
    })
}

// get Wilayah
async function getWilayah(provinsi, kabupaten, kecamatan, kelurahan, kodePos) {
    
    await axios({
        method: `POST`,
        url: `<?= site_url() ?>api/wilayah`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        },
        data: {
            provinsi: provinsi,
            kabupaten: kabupaten,
            kecamatan: kecamatan,
            kelurahan: kelurahan
        }
    })
    .then(function (response) {
        if (response.data.data.length > 0) {
            response.data.data.forEach(element => {
                // console.log('prov id: '+element.id_provinsi);
                getProvinsi(element.id_provinsi);
                getKabupaten(element.id_provinsi, element.id_kabupaten);
                getKecamatan(element.id_kabupaten, element.id_kecamatan);
                getKelurahan(element.id_kecamatan, element.id_kelurahan);
                getKodePos(element.id_kelurahan, kodePos);

            });  
        } else {
            getProvinsi();
        }
        
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// get Provinsi
async function getProvinsi(id = null) {
    
    await axios({
        method: `GET`,
        url: `<?= site_url() ?>api/provinsi`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            let selected = '';
            if (element.id == id) {
                selected = 'selected';
            }
            // add option
            $('#provinsi').append('<option value="'+element.id+'" '+selected+'>'+element.provinsi.toUpperCase()+'</option>')
            // $('#provinsi').append(`<option value="${element.id}" ${element.provinsi.toUpperCase() == name.toUpperCase() ? 'selected' : ''}>${element.provinsi.toUpperCase()}</option>`)
            // element.provinsi == name ? $('#provinsi').val(element.id).trigger('change') : '';
            // element.provinsi.toUpperCase() == name.toUpperCase() ? console.log('mantap') : console.log(element.provinsi+'-'+name);
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// get Kabupaten
async function getKabupaten(idProvinsi, id = null) {
    await axios({
        method: `GET`,
        url: id == null ? `<?= site_url() ?>api/kabupaten/${idProvinsi}` : `<?= site_url() ?>api/kabupaten/${idProvinsi}/${id}`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            let selected = '';
            if (element.id == id) {
                selected = 'selected';
            }
            // add option
            $('#kabupaten').append('<option value="'+element.id+'" '+selected+'>'+element.kabupaten_kota.toUpperCase()+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// get Kecamatan
async function getKecamatan(idKabupaten, id = null) {
    await axios({
        method: `GET`,
        url: id == null ? `<?= site_url() ?>api/kecamatan/${idKabupaten}` : `<?= site_url() ?>api/kecamatan/${idKabupaten}/${id}`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            let selected = '';
            if (element.id == id) {
                selected = 'selected';
            }
            // add option
            $('#kecamatan').append('<option value="'+element.id+'" '+selected+'>'+element.kecamatan.toUpperCase()+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// get Kelurahan
async function getKelurahan(idKecamatan, id = null) {
    await axios({
        method: `GET`,
        url: id == null ? `<?= site_url() ?>api/kelurahan/${idKecamatan}` : `<?= site_url() ?>api/kelurahan/${idKecamatan}/${id}`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            let selected = '';
            if (element.id == id) {
                selected = 'selected';
            }
            // add option
            $('#kelurahan').append('<option value="'+element.id+'" '+selected+'>'+element.kelurahan.toUpperCase()+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

// get KodePos
async function getKodePos(idKecamatan, id = null) {
    await axios({
        method: `GET`,
        url: id == null ? `<?= site_url() ?>api/kode-pos/${idKecamatan}` : `<?= site_url() ?>api/kode-pos/${idKecamatan}/${id}`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        let kodePOS = "";
        response.data.data.forEach(element => {
            // add option
            $('#kodePos').append('<option value="'+element.kd_pos+'">'+element.kd_pos+'</option>')
            kodePOS = element.kd_pos;
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
        $('#kodePos').val(kodePOS).trigger('change');
    })
    .catch(function (error) {
        // console.log(error);
    })
}
</script>
