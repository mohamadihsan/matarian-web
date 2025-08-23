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
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <form id="formFilter">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-4">
                                <label class="label-katapanda-sm" for="perusahaanFilter">Perusahaan <i class="text-danger">*</i></label>
                                <select name="perusahaanFilter" id="perusahaanFilter" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="periode">Masa Pajak <i class="text-danger">*</i></label>
                                <input type="text" name="periode" class="form-control form-control-sm" id="periode">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="label-katapanda-sm" for="periode2">Masa Pajak Pengkreditkan </label>
                                <input type="text" name="periode2" class="form-control form-control-sm" id="periode2">
                            </div>
                            <div class="form-group col-lg-2 col-md-2">
                                <label class="label-katapanda-sm" for="jenisDokumen">Kategori</label>
                                <select name="jenisDokumen" id="jenisDokumen" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                            <div class="form-group col-lg-2 col-md-2">
                                <label class="label-katapanda-sm" for="status_faktur">Status</label>
                                <select name="status_faktur" id="status_faktur" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                        </div>
                    </form>
                    <div class="form-row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 text-right">
                            <div class="button-group">
                                <button class="btn btn-sm btn-secondary" id="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                                <!-- <button class="btn btn-sm btn-danger" id="deleteReport"><i class="fas fa-trash"></i> Delete</button> -->
                                <button class="btn btn-sm btn-primary" id="filter"><i class="fas fa-envelope-open-text"></i> Generate Report</button>
                            </div>
                        </div>
                    </div>
                    <div id="sansHidden">
                        <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">NPWP Penjual</th>
                                    <th class="text-right text-nowrap">Nama Penjual</th>
                                    <th class="text-right text-nowrap">Cek</th>
                                    <th class="text-center text-nowrap">Nomor Faktur Pajak</th>
                                    <th class="text-center text-nowrap">Tanggal Faktur Pajak</th>
                                    <th class="text-center text-nowrap">Masa Pajak</th>
                                    <th class="text-right text-nowrap">Tahun</th>
                                    <th class="text-center text-nowrap">Masa Pajak</th>
                                    <th class="text-right text-nowrap">Tahun</th>
                                    <th class="text-right text-nowrap">Status Faktur</th>
                                    <th class="text-right text-nowrap">Harga Jual</th>
                                    <th class="text-right text-nowrap">DPP Nilai Lain</th>
                                    <th class="text-right text-nowrap">PPN</th>
                                    <th class="text-right text-nowrap">PPN</th>
                                    <th class="text-right text-nowrap">B1</th>
                                    <th class="text-right text-nowrap">B2</th>
                                    <th class="text-right text-nowrap">B3</th>
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <th colspan="13" class="text-right">Total</th>
                                    <th class="text-right" id="totalPPN"></th>
                                    <th class="text-right" id="totalPPNCondition"></th>
                                    <th class="text-right" id="totalB1"></th>
                                    <th class="text-right" id="totalB2"></th>
                                    <th class="text-right" id="totalB3"></th>
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
                            <label class="label-katapanda-sm" for="perusahaan">Perusahaan <i class="text-danger">*</i></label>
                            <select name="perusahaan" id="perusahaan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="vendor">Nama Penjual <i class="text-danger">*</i></label>
                            <select name="vendor" id="vendor" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="npwpPenjual">NPWP Penjual <i class="text-danger"></i></label>
                            <input type="text" name="npwpPenjual" class="form-control form-control-sm" id="npwpPenjual" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="cek">Cek <i class="text-danger">*</i></label>
                            <select name="cek" id="cek" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nomorFakturPajak">Nomor Faktur Pajak <i class="text-danger">*</i></label>
                            <input type="text" name="nomorFakturPajak" class="form-control form-control-sm" id="nomorFakturPajak" placeholder="">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="tanggalFakturPajak">Tanggal Faktur Pajak <span class="text-danger">*</span></label>
                            <input type="text" name="tanggalFakturPajak" class="form-control form-control-sm" id="tanggalFakturPajak" placeholder="">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="masaPajak">Masa Pajak <i class="text-danger">*</i></label>
                            <input type="text" name="masaPajak" class="form-control form-control-sm" id="masaPajak">
                        </div>
                        <div class="form-group">
                            <label class="label-katapanda-sm" for="masaPajakPengkreditkan">Masa Pajak Pengkreditkan </label>
                            <input type="text" name="masaPajakPengkreditkan" class="form-control form-control-sm" id="masaPajakPengkreditkan">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="statusFakturPajak">Status Faktur <i class="text-danger">*</i></label>
                            <select name="statusFakturPajak" id="statusFakturPajak" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="hargaJualFormat">Harga Jual <span class="text-danger"></span></label>
                            <input type="text" class="form-control form-control-md" id="hargaJualFormat" placeholder="0">
                            <input type="hidden" name="hargaJual" id="hargaJual" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="dppNilaiLainFormat">DPP Nilai Lain <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-md" name="dppNilaiLainFormat" id="dppNilaiLainFormat" placeholder="0">
                            <input type="hidden" name="dppNilaiLain" id="dppNilaiLain" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="ppnFormat">PPN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-md" name="ppnFormat" id="ppnFormat" placeholder="0">
                            <input type="hidden" name="ppn" id="ppn" readonly>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="isJasa" class="" id="isJasa">
                            <label class="label-katapanda-sm" for="isJasa">JASA <span class="text-danger"></span></label>
                        </div>

                        <div id="inputNominalJasa">
                            <div class="form-group">
                                <label class="label-katapanda-sm" for="nominalJasaFormat">Nominal Jasa <span class="text-danger"></span></label>
                                <input type="text" class="form-control form-control-md" id="nominalJasaFormat" placeholder="0">
                                <input type="hidden" name="nominalJasa" id="nominalJasa" readonly>
                            </div>
                            
                            <div class="form-group">
                                <input type="checkbox" name="isUnifikasiOnly" class="" id="isUnifikasiOnly">
                                <label class="label-katapanda-sm" for="isUnifikasiOnly"> Jadikan sebagai Laporan Unifikasi saja<span class="text-danger"></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark cancel" data-dismiss="modal">Cancel</button>
                        <!-- <button type="button" class="btn btn-secondary" id="btnResetFormInput">Reset Form</button> -->
                        <button type="submit" class="btn bg-custom" id="btnSubmit"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Per Row -->
    <div class="modal fade" id="confirmKatapanda" tabindex="-1" role="dialog" aria-labelledby="confirmKatapandaTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form id="confirmDeletePerRow">
                <div class="modal-content">
                    <div class="modal-header bg-custom">
                        <h6 class="modal-title" id="confirmTitle"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus data faktur pajak: <span class="font-weight-bold" id="dataDelete"></span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn bg-custom" id="submitDeleteRow">Yes, delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Per Periode -->
    <div class="modal fade" id="confirmDeleteReport" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteReportTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form id="confirm">
                <div class="modal-content">
                    <div class="modal-header bg-custom">
                        <h6 class="modal-title" id="confirmDeleteReportTitle"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><span class="" id="descriptionDeleteReport"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn bg-custom" id="submitDelete">Yes, delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // init variable
            // $('#sansHidden').css('display', 'none')
            let id = null;
            let actionCreate = <?php echo $action_create == 1 ? 1 : 0; ?>;
            let actionUpdate = <?php echo $action_update == 1 ? 1 : 0; ?>;
            let actionDelete = <?php echo $action_delete == 1 ? 1 : 0; ?>;
            let actionExportToExcel = <?php echo $action_export_to_excel == 1 ? 1 : 0; ?>;
            let actionExportToCsv = <?php echo $action_export_to_csv == 1 ? 1 : 0; ?>;
            let actionExportToPdf = 0;
            var perusahaanName = ''

            actionCreate ? $('#actionCreate').html('<button class="btn btn-sm btn-outline-primary" id="newData"><i class="fas fa-plus"></i> New Data</button>') : '';

            $('#deleteReport').hide()
            $('#inputNominalJasa').hide();

            // button default for action datatables
            let buttonAction = ['copyHtml5']; // add button to copy data
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";
            $('#periode').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker('update', moment().format('MM-YYYY'));
            $('#periode2').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker();
            $('#masaPajak').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker('update', moment().format('MM-YYYY'));
            $('#masaPajakPengkreditkan').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker();
            $('#tanggalFakturPajak').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker('update', moment(new Date()).format('DD-MM-YYYY'));

            $('#hargaJualFormat').on('input', function() {
                // Ambil nilai murni hanya angka
                let rawValue = $(this).val().replace(/\D/g, '');

                // Format ribuan
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Set tampilan format ke input text
                $(this).val(formattedValue);

                // Simpan nilai asli ke hidden input
                $('#hargaJual').val(rawValue);
            });

            $('#dppNilaiLainFormat').on('input', function() {
                // Ambil nilai murni hanya angka
                let rawValue = $(this).val().replace(/\D/g, '');

                // Format ribuan
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Set tampilan format ke input text
                $(this).val(formattedValue);

                // Simpan nilai asli ke hidden input
                $('#dppNilaiLain').val(rawValue);
            });

            $('#ppnFormat').on('input', function() {
                // Ambil nilai murni hanya angka
                let rawValue = $(this).val().replace(/\D/g, '');

                // Format ribuan
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Set tampilan format ke input text
                $(this).val(formattedValue);

                // Simpan nilai asli ke hidden input
                $('#ppn').val(rawValue);
            });

            $('#nominalJasaFormat').on('input', function() {
                // Ambil nilai murni hanya angka
                let rawValue = $(this).val().replace(/\D/g, '');

                // Format ribuan
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Set tampilan format ke input text
                $(this).val(formattedValue);

                // Simpan nilai asli ke hidden input
                $('#nominalJasa').val(rawValue);
            });

            $('#isJasa').change(function() {
                if ($(this).is(':checked')) {
                    $('#inputNominalJasa').show();
                } else {
                    $('#inputNominalJasa').hide();
                }
            });

            // store to select
            getPerusahaan();
            getVendor();
            getStatusFaktur();
            getStatusFakturFilter();
            getJenisDokumen();
            getCek();

            // button action by user role 
            actionExportToExcel ? buttonAction.push({
                extend: 'excelHtml5',
                exportOptions: {
                    // exclude column[0]
                    columns: ':not(:first-child):not(:nth-child(2)):not(:nth-child(7)):not(:nth-child(8)):not(:nth-child(13)):not(:nth-child(14))',
                    title: '', // kosongkan judul
                    messageTop: '', // hilangkan message di atas
                    footer: true, // <<-- penting biar footer ikut diexport
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 2) {
                                // Nomor Faktur Pajak
                                if (/^\d+$/.test(data)) {
                                    // Jika semua karakter numeric → tambahkan ' di depan
                                    return "'" + data;
                                }
                                return data; // kalau ada huruf/simbol, biarkan
                            } else if (column === 3) {
                                // Tanggal Faktur Pajak
                                let parsedDate = moment(data, ['DD/MM/YYYY', 'YYYY-MM-DD', 'MM/DD/YYYY'], true);
                                if (parsedDate.isValid()) {
                                    return parsedDate.format('DD/MM/YYYY');
                                }
                                return data;
                            } else if (column >= 7 && column <= 11) {
                                // Nominal (hilangkan titik)
                                let nominal = data?.replace(/\./g, '');
                                return nominal;
                            }
                            return data;
                        },
                        footer: function(data, row, column, node) {
                            // Format footer juga (total)
                            if (column >= 7 && column <= 11) {
                                return data?.replace(/\./g, '');
                            }
                            return data;
                        }
                    },
                },
                customizeData: function(data) {
                    // Jaga-jaga, kalau Excel masih detect angka panjang di kolom faktur
                    for (let i = 0; i < data.body.length; i++) {
                        data.body[i][2] = data.body[i][2].toString();
                    }
                }
            }) : ''; // button export to excel
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
                    doc.styles.tableHeader.alignment = 'center';
                    doc.pageMargins = [20, 60, 20, 30];
                    doc.content[1].table.widths = ['10%', '10%', '10%', '20%', '20%', '15%', '15%'];
                    var rowCount = doc.content[1].table.body.length;
                    for (i = 1; i < rowCount; i++) {
                        doc.content[1].table.body[i][0].alignment = 'center';
                        doc.content[1].table.body[i][1].alignment = 'center';
                        doc.content[1].table.body[i][2].alignment = 'center';
                        doc.content[1].table.body[i][3].alignment = 'left';
                        doc.content[1].table.body[i][4].alignment = 'left';
                        doc.content[1].table.body[i][5].alignment = 'left';
                        doc.content[1].table.body[i][6].alignment = 'right';
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
                buttons: buttonAction,
            });

            $.extend(true, $.fn.dataTable.Buttons.defaults, {
                title: '',
                messageTop: ''
            });

            // store data to dataTables 
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#katapandaTable').DataTable({
                processing: true,
                ajax: { // array
                    url: '<?= site_url() ?>api/web/v1/report/ppn',
                    contentType: "application/json",
                    type: "POST",
                    data: function() {
                        let periode = $('#periode').val(); // misal: "08-2025"
                        let periode2 = $('#periode2').val(); // misal: "08-2025"
                        let [bulan, tahun] = periode.split('-');
                        let [bulanPengkreditkan, tahunPengkreditkan] = periode2.split('-');
                        return JSON.stringify({
                            bulan: bulan,
                            tahun: tahun,
                            bulan_pengkreditkan: bulanPengkreditkan,
                            tahun_pengkreditkan: tahunPengkreditkan,
                            perusahaan: $('#perusahaanFilter').val(),
                            status_faktur: $('#status_faktur').val(),
                            jenis_dokumen: $('#jenisDokumen').val(),
                        });
                    },
                    complete: function(res) {

                        $('#totalPPN').text("");
                        $('#totalPPNCondition').text("");
                        $('#totalB1').text("");
                        $('#totalB2').text("");
                        $('#totalB3').text("");

                        let response = res?.responseJSON
                        if (response?.status && response?.total_rows > 0) {
                            if (actionDelete) {
                                $('#deleteReport').show()
                            }

                            let totalPPN = response.total_ppn !== null ? formatNumber(res.responseJSON.total_ppn) : "";
                            let totalPPNCondition = response.total_ppn_condition !== null ? formatNumber(res.responseJSON.total_ppn_condition) : "";
                            let totalB1 = response.total_b1 !== null ? formatNumber(res.responseJSON.total_b1) : "";
                            let totalB2 = response.total_b2 !== null ? formatNumber(res.responseJSON.total_b2) : "";
                            let totalB3 = response.total_b3 !== null ? formatNumber(res.responseJSON.total_b3) : "";
                            $('#totalPPN').text(totalPPN);
                            $('#totalPPNCondition').text(totalPPNCondition);
                            $('#totalB1').text(totalB1);
                            $('#totalB2').text(totalB2);
                            $('#totalB3').text(totalB3);
                        } else {
                            $('#deleteReport').hide()
                        }

                    },
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                },
                order: [],
                columns: [{
                        data: "id",
                        className: "align-middle text-center",
                        responsivePriority: 2,
                        render: function(data, type, row, meta) {
                            // set by role
                            let action = `<div class="btn-group"><button class="btn btn-sm btn-outline-info detail" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-info-circle"></i></button>`;
                            actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning d-none d-sm-block edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                            actionDelete ? action += `<button class="btn btn-sm btn-outline-danger d-none d-sm-block delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : '';
                            action += `</div>`;
                            return action;
                        }
                    },
                    {
                        data: "npwp_penjual",
                        className: "align-middle text-nowrap",
                        responsivePriority: 1
                    },
                    {
                        data: "nama_penjual",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "cek",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "nomor_faktur_pajak",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "tanggal_faktur_pajak",
                        className: "align-middle text-nowrap",
                        render: function(data, type, row, meta) {
                            let date = data !== null ? moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY') : 0;
                            return date;
                        }
                    },
                    {
                        data: "masa_pajak",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "tahun_pajak",
                        className: "align-middle text-nowrap",
                        responsivePriority: 2
                    },
                    {
                        data: "masa_pajak_pengkreditkan",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "tahun_pajak_pengkreditkan",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "status_faktur_pajak",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "harga_jual",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "dpp_nilai_lain",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "ppn",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "ppn_condition",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "b1",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "b2",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "b3",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                ],
                language: {
                    loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
                    processing: `<p class="font-weight-bold text-primary">Generating Report...</p>`
                }
            }).columns.adjust();
            table.fixedHeader.adjust();

            $('#filter').click(function() {
                // $('#sansHidden').css('display', '')
                table.clear().draw();
                table.ajax.reload();
            })

            $('#reset').click(function() {
                $('#formFilter').trigger("reset");

                $('#periode').val(moment().subtract(0, 'years').format('MM-YYYY'));
                $('#periode2').val();
                $('.selectpicker').selectpicker('refresh');
                $('#perusahaanFilter').val().change();
                $('#status_faktur').val().change();
                $('#jenisDokumen').val().change();
            })

            $('#perusahaanFilter').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let selectedName = selectedOption.data('nama');

                if (selectedName) {
                    perusahaanName = selectedName
                } else {
                    perusahaanName = ''
                }
            });

            $('#vendor').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let selectedNPWP = selectedOption.data('npwp');
                let selectedCek = selectedOption.data('cek');

                $('#npwpPenjual').val(selectedNPWP)
                $('#cek').val(selectedCek).trigger("change")
            });

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
                    // console.log('Edit');
                    // console.log(JSON.stringify(item));

                    // Format ribuan
                    let itemDppNilaiLainFormat = item.dpp_nilai_lain?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let itemHargaJualFormat = item.harga_jual?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let itemPpnFormat = item.ppn?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let itemNominalJasaFormat = item.nominal_jasa?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    // store data to input
                    $('#perusahaan').val(item.master_perusahaan_id).trigger('change');
                    $('#vendor').val(item.master_vendor_id).trigger('change');
                    $('#npwpPenjual').val(item.npwp_penjual);
                    $('#cek').val(item.cek).trigger('change');
                    $('#nomorFakturPajak').val(item.nomor_faktur_pajak);
                    $('#tanggalFakturPajak').datepicker().datepicker('update', moment(new Date(item.tanggal_faktur_pajak)).format('DD-MM-YYYY'));
                    $('#statusFakturPajak').val(item.status_faktur_pajak).trigger('change');
                    $('#hargaJual').val(item.harga_jual);
                    $('#hargaJualFormat').val(itemHargaJualFormat);
                    $('#dppNilaiLain').val(item.dpp_nilai_lain);
                    $('#dppNilaiLainFormat').val(itemDppNilaiLainFormat);
                    $('#ppn').val(item.ppn);
                    $('#ppnFormat').val(itemPpnFormat);
                    $('#nominalJasaFormat').val(itemNominalJasaFormat);
                    $('#nominalJasa').val(item.nominal_jasa);

                    const masaPajakClicked = bulanToNumber(item.masa_pajak)
                    let masaTahunPajakClicked = ''
                    if (item.masa_pajak && item.tahun_pajak) {
                        masaTahunPajakClicked = `${masaPajakClicked}-${item.tahun_pajak}`
                        $('#masaPajak').datepicker().datepicker('update', moment(masaTahunPajakClicked, 'MM-YYYY').format('MM-YYYY'));
                    }

                    const masaPajakPengkreditkanClicked = bulanToNumber(item.masa_pajak_pengkreditkan)
                    let masaTahunPajakPengkreditkanClicked = ''
                    if (item.masa_pajak_pengkreditkan && item.tahun_pajak_pengkreditkan) {
                        masaTahunPajakPengkreditkanClicked = `${masaPajakPengkreditkanClicked}-${item.tahun_pajak_pengkreditkan}`
                        $('#masaPajakPengkreditkan').datepicker().datepicker('update', moment(masaTahunPajakPengkreditkanClicked, 'MM-YYYY').format('MM'));
                    }

                    if (item.is_jasa == true) {
                        $('#isJasa').prop('checked', true)
                        $('#inputNominalJasa').show();
                    } else {
                        $('#isJasa').prop('checked', false)
                        $('#inputNominalJasa').hide();
                    }

                    if (item.is_nofikasi == true) {
                        $('#isUnifikasiOnly').prop('checked', true)
                    } else {
                        $('#isUnifikasiOnly').prop('checked', false)
                    }

                    // set
                    id = item.id;

                    // store data to confirm delete text
                    $('#dataDelete').text(item.nomor_faktur_pajak);

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
                $('#formKatapanda').modal({
                    backdrop: 'static'
                }, 'show')
                $('#btnResetFormInput').css("display", "");
            })

            // modal form edit in desktop mode
            $('.edit').click(function() {
                validator.resetForm();

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formKatapanda').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                $('#formKatapanda').find('input, select, textarea, button').prop('disabled', false);

                // kalau pakai selectpicker
                $('#formKatapanda').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
            })

            // modal form edit in tablet/mobile mode
            $('#katapandaTable tbody').on('click', '.edit', function() {
                validator.resetForm();

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formKatapanda').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                $('#formKatapanda').find('input, select, textarea, button').prop('disabled', false);

                // kalau pakai selectpicker
                $('#formKatapanda').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
            })

            // modal form edit in desktop mode
            $('.detail').click(function() {
                // reset validator in the form
                validator.resetForm();

                // show modal
                $('#formTitle').html('<i class="fas fa-users"></i> Detail <?= $title ?>');
                $('#btnSubmit').hide();
                $('#btnSubmit').text('Update');
                $('#formKatapanda').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "none");

                // disable semua input, select, textarea, checkbox
                $('#formKatapanda').find('input, select, textarea, button').prop('disabled', true);

                // kalau mau button close modal tetap bisa diklik, enable lagi:
                $('#formKatapanda').find('.close').prop('disabled', false);
                $('#formKatapanda').find('.cancel').prop('disabled', false);
            })

            // modal form detail in tablet/mobile mode
            $('#katapandaTable tbody').on('click', '.detail', function() {
                // reset validator in the form
                validator.resetForm();

                // show modal
                $('#formTitle').html('<i class="fas fa-users"></i> Detail <?= $title ?>');
                $('#btnSubmit').hide();
                $('#btnSubmit').text('Update');
                $('#formKatapanda').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "none");

                // disable semua input, select, textarea, checkbox
                $('#formKatapanda').find('input, select, textarea, button').prop('disabled', true);

                // kalau mau button close modal tetap bisa diklik, enable lagi:
                $('#formKatapanda').find('.close').prop('disabled', false);
                $('#formKatapanda').find('.cancel').prop('disabled', false);

            })

            // confirm delete 
            $('#katapandaTable tbody').on('click', '.delete', function() {
                // show confirm
                $('#confirmTitle').html('<i class="fas fa-users"></i> Delete <?= $title ?>');
                $('#confirmKatapanda').modal('show')
            })

            $('#deleteReport').click(function() {
                // show confirm
                $('#confirmDeleteReportTitle').html(`<i class="far fa-credit-card"></i> Delete Document`);
                $('#descriptionDeleteReport').html(`Apakah anda yakin akan menghapus semua data <b>${perusahaanName}</b> periode <b>${$('#periode').val()}</b> ? </br></br> Data dihapus berdasarkan <b>Masa Pajak & Perusahaan</b>`);
                $('#confirmDeleteReport').modal('show')
            })

            // delete
            $('#submitDelete').click(function() {
                let periodeDelete = $('#periode').val(); // hasil: '05-2025'
                let [bulanDelete, tahunDelete] = periodeDelete.split('-');
                let perusahaanDelete = $('#perusahaanFilter').val()

                // send request 
                axios({
                        method: `DELETE`,
                        url: `<?= site_url() ?>api/web/v1/report/ppn/${bulanDelete}/${tahunDelete}/${perusahaanDelete}`,
                        headers: {
                            Authorization: 'Bearer <?= $token ?>'
                        }
                    })
                    .then(function(response) {
                        // console.log(response);
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = `delete`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            $('#confirmDeleteReport').modal('hide');
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
                        notification('delete', 'error', messageError);
                    })
                    .then(function() {
                        table.clear().draw();
                        table.ajax.reload();
                    })
            })

            $('#submitDeleteRow').click(function() {

                // send request 
                axios({
                        method: `DELETE`,
                        url: `<?= site_url() ?>api/web/v1/report/ppn/${id}`,
                        headers: {
                            Authorization: 'Bearer <?= $token ?>'
                        }
                    })
                    .then(function(response) {
                        // console.log(response);
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = `delete`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            $('#confirmKatapanda').modal('hide');
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
                        notification('delete', 'error', messageError);
                    })
                    .then(function() {
                        table.clear().draw();
                        table.ajax.reload();
                    })
            })

            // validate and request add new data and update existing data 
            let validator = $('#form').validate({
                rules: {
                    perusahaan: "required",
                    vendor: "required",
                    cek: "required",
                    nomorFakturPajak: "required",
                    tanggalFakturPajak: "required",
                    masaPajak: "required",
                    statusFakturPajak: "required",
                    dppNilaiLainFormat: "required",
                    ppnFormat: "required",
                },
                messages: {
                    perusahaan: "Please select perusahaan",
                    vendor: "Please select vendor",
                    cek: "Please select cek",
                    nomorFakturPajak: "Nomor Faktur Pajak is required",
                    tanggalFakturPajak: "Tanggal Faktur Pajak is required",
                    masaPajak: "Masa Pajak is required",
                    statusFakturPajak: "Status Faktur Pajak is required",
                    dppNilaiLainFormat: "DPP Nilai Lain is required",
                    ppnFormat: "PPN is required",
                },
                submitHandler: function(form) {
                    // start loading
                    loadingStart()

                    const monthNames = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];

                    const [bulanPajakNum, tahunPajak] = $('#masaPajak').val()?.split("-");
                    const [bulanPajakPengkreditkanNum, tahunPajakPengkreditkan] = $('#masaPajakPengkreditkan').val()?.split("-");

                    // ubah bulan angka ke nama bulan
                    const bulanPajak = monthNames[parseInt(bulanPajakNum, 10) - 1];
                    const bulanPajakPengkreditkan = monthNames[parseInt(bulanPajakPengkreditkanNum, 10) - 1];

                    const tanggalFakturPajak = moment($('#tanggalFakturPajak').val(), "DD-MM-YYYY").format("YYYY-MM-DD");

                    const requestData = {
                        perusahaan: $('#perusahaan').val(),
                        vendor: $('#vendor').val(),
                        cek: $('#cek').val(),
                        nomor_faktur_pajak: $('#nomorFakturPajak').val(),
                        tanggal_faktur_pajak: tanggalFakturPajak,
                        masa_pajak: bulanPajak,
                        tahun_pajak: tahunPajak,
                        masa_pajak_pengreditkan: bulanPajakPengkreditkan ? bulanPajakPengkreditkan : null,
                        tahun_pajak_pengreditkan: tahunPajakPengkreditkan ? tahunPajakPengkreditkan : null,
                        status_faktur_pajak: $('#statusFakturPajak').val(),
                        harga_jual: $('#hargaJual').val(),
                        dpp_nilai_lain: $('#dppNilaiLain').val(),
                        ppn: $('#ppn').val(),
                        is_jasa: $("#isJasa").is(":checked"),
                        nominal_jasa: $('#nominalJasa').val(),
                        is_unifikasi_only: $("#isUnifikasiOnly").is(":checked"),
                    }

                    // send request 
                    axios({
                            method: id === null ? `POST` : `PUT`,
                            url: id === null ? `<?= site_url() ?>api/web/v1/report/ppn/create` : `<?= site_url() ?>api/web/v1/report/ppn/update/${id}`,
                            headers: {
                                Authorization: 'Bearer <?= $token ?>'
                            },
                            data: requestData
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
                            notification(null, 'error', messageError);
                        })
                        .then(function() {
                            // stop loading
                            loadingStop()
                        })
                }
            })

        });

        // get perusahaan
        function getPerusahaan() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/master/perusahaan`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        selected = element.id
                        // add option
                        $('#perusahaan').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.nama + '</option><option data-divider="true"></option>')
                        $('#perusahaanFilter').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.nama + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    $('#perusahaanFilter').val(selected).trigger('change');
                    setTimeout(
                        function() {
                            $('#filter').trigger('click');
                        }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        // get vendor
        function getVendor() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/master/vendor`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        selected = element.id
                        // add option
                        $('#vendor').append('<option value="' + element.id + '" data-nama="' + element.nama + '" data-npwp="' + element.new_npwp + '" data-cek="' + element.cek + '">' + element.nama + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#vendor').val(selected).trigger('change');
                    setTimeout(
                        function() {
                            $('#filter').trigger('click');
                        }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        async function getStatusFaktur() {
            const $selectStatusFaktur = $('#statusFakturPajak');

            // Clear existing options if needed
            $selectStatusFaktur.empty();

            // Tambahkan opsi
            $selectStatusFaktur.append('<option value="AMENDED">AMENDED</option>');
            $selectStatusFaktur.append('<option value="APPROVED">APPROVED</option>');
            $selectStatusFaktur.append('<option value="CANCELED">CANCELED</option>');
            $selectStatusFaktur.append('<option value="CREDITED" selected>CREDITED</option>');
            $selectStatusFaktur.append('<option value="UNCREDITED">UNCREDITED</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            $selectStatusFaktur.val();
        }

        async function getStatusFakturFilter() {
            const $selectStatusFakturFilter = $('#status_faktur');

            // Clear existing options if needed
            // $selectStatusFakturFilter.empty();

            // Tambahkan opsi
            $selectStatusFakturFilter.append('<option value="" selected>SEMUA</option>');
            $selectStatusFakturFilter.append('<option value="AMENDED">AMENDED</option>');
            $selectStatusFakturFilter.append('<option value="APPROVED">APPROVED</option>');
            $selectStatusFakturFilter.append('<option value="CANCELED">CANCELED</option>');
            $selectStatusFakturFilter.append('<option value="CREDITED">CREDITED</option>');
            $selectStatusFakturFilter.append('<option value="UNCREDITED">UNCREDITED</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            $selectStatusFakturFilter.val();
        }

        async function getJenisDokumen() {
            const $selectJenisDokumen = $('#jenisDokumen');

            // Clear existing options if needed
            // $selectJenisDokumen.empty();

            // Ambil query string dari URL
            let params = new URLSearchParams(window.location.search);

            // Ambil parameter "cek"
            let cek = params.get("cek");

            $selectJenisDokumen.append('<option value="" selected>SEMUA</option>');    
            $selectJenisDokumen.append('<option value="PPN MASUKKAN">PPN MASUKKAN</option>');    
            $selectJenisDokumen.append('<option value="DOKUMEN LAIN">DOKUMEN LAIN</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            if (cek == 'fp') {
                $selectJenisDokumen.val("PPN MASUKKAN").trigger("change");
            } else if (cek == 'dl') {
                $selectJenisDokumen.val("DOKUMEN LAIN").trigger("change");
            }
        }

        async function getCek() {
            const $selectCek = $('#cek');

            // Clear existing options if needed
            $selectCek.empty();

            // Tambahkan opsi
            $selectCek.append('<option value="FP" selected>FP</option>');
            $selectCek.append('<option value="DL1">DL1</option>');
            $selectCek.append('<option value="DL2">DL2</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            $selectCek.val();
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        // reset Form
        function resetFormInput() {
            $('#form').trigger("reset");
            $('#perusahaan').val('').selectpicker('refresh');
            $('#perusahaanFilter').val('').selectpicker('refresh');
            $('#vendor').val('').selectpicker('refresh');
            $('#inputNominalJasa').hide();
        }

        function bulanToNumber(bulanStr) {
            const bulanMap = {
                'januari': '01',
                'februari': '02',
                'maret': '03',
                'april': '04',
                'mei': '05',
                'juni': '06',
                'juli': '07',
                'agustus': '08',
                'september': '09',
                'oktober': '10',
                'november': '11',
                'desember': '12'
            };

            return bulanMap[bulanStr?.toLowerCase()] || null;
        }
    </script>