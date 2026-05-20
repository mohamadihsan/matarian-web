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
                    <form id="form">
                        <div class="form-row">
                            <div class="form-group col-lg-3 col-md-3">
                                <label class="label-katapanda-sm" for="perusahaan">Perusahaan <i class="text-danger">*</i></label>
                                <select name="perusahaan" id="perusahaan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                            <div class="form-group col-lg-2 col-md-2">
                                <label class="label-katapanda-sm" for="periode_awal">Masa Pajak (Start) <i class="text-danger">*</i></label>
                                <input type="text" id="periode_awal" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-lg-2 col-md-2">
                                <label class="label-katapanda-sm" for="periode_akhir">Masa Pajak (End) <i class="text-danger">*</i></label>
                                <input type="text" id="periode_akhir" class="form-control form-control-sm">
                            </div>
                            <!-- <div class="form-group col-lg-2 col-md-2">
                                <label class="label-katapanda-sm" for="status_faktur">Status</label>
                                <select name="status_faktur" id="status_faktur" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div> -->
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
                                    <th class="text-left text-nowrap">Masa Pajak</th>
                                    <th class="text-left text-nowrap">Tahun Pajak</th>
                                    <th class="text-left text-nowrap">NPWP</th>
                                    <th class="text-left text-nowrap">Nama Vendor</th>
                                    <th class="text-left text-nowrap">Fasilitas</th>
                                    <th class="text-left text-nowrap">Kode Objek Pajak</th>
                                    <th class="text-right text-nowrap">DPP</th>
                                    <th class="text-right text-nowrap">Tarif</th>
                                    <th class="text-right text-nowrap">PPh</th>
                                    <th class="text-left text-nowrap">Jenis Dok. Referensi</th>
                                    <th class="text-left text-nowrap">Nomor Dok. Referensi</th>
                                    <th class="text-left text-nowrap">Tanggal Dok. Referensi</th>
                                    <!-- <th class="text-center text-nowrap">ID TKU Pemotong</th>
                                    <th class="text-right text-nowrap">Opsi Pembayaran (IP)</th>
                                    <th class="text-right text-nowrap">Nomor SP2D (IP)</th>
                                    <th class="text-right text-nowrap">Tanggal Pemotongan</th> -->
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-left text-nowrap">Masa Pajak</th>
                                    <th class="text-left text-nowrap">Tahun Pajak</th>
                                    <th class="text-left text-nowrap">NPWP</th>
                                    <th class="text-left text-nowrap">Nama Vendor</th>
                                    <th class="text-left text-nowrap">Fasilitas</th>
                                    <th class="text-left text-nowrap">Kode Objek Pajak</th>
                                    <th class="text-right text-nowrap">DPP</th>
                                    <th class="text-right text-nowrap">Tarif</th>
                                    <th class="text-right text-nowrap">PPh</th>
                                    <th class="text-left text-nowrap">Jenis Dok. Referensi</th>
                                    <th class="text-left text-nowrap">Nomor Dok. Referensi</th>
                                    <th class="text-left text-nowrap">Tanggal Dok. Referensi</th>
                                    <!-- <th class="text-center text-nowrap">ID TKU Pemotong</th>
                                    <th class="text-right text-nowrap">Opsi Pembayaran (IP)</th>
                                    <th class="text-right text-nowrap">Nomor SP2D (IP)</th>
                                    <th class="text-right text-nowrap">Tanggal Pemotongan</th> -->
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

    <!-- Form Edit -->
    <div class="modal fade" id="formReportUnifikasi" tabindex="-1" role="dialog" aria-labelledby="formUpdateReportUnifikasiTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formUpdate">
                <div class="modal-content">
                    <div class="modal-header bg-custom">
                        <h6 class="modal-title" id="formTitle"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="perusahaanSelect">Nama Pemotong <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <select name="perusahaanSelect" id="perusahaanSelect" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group" hidden>
                            <label class="label-katapanda-sm" for="nitkuPerusahaan">ID TKU Pemotong <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <input type="text" name="nitkuPerusahaan" class="form-control form-control-sm" id="nitkuPerusahaan" placeholder="">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="vendor">Nama Penerima <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <select name="vendor" id="vendor" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="npwpPenjual">NPWP Penerima <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <input type="text" name="npwpPenjual" class="form-control form-control-sm" id="npwpPenjual" placeholder="">
                        </div>

                        <div class="form-group" hidden>
                            <label class="label-katapanda-sm" for="nitkuPenjual">ID TKU Penerima Penghasilan <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <input type="text" name="nitkuPenjual" class="form-control form-control-sm" id="nitkuPenjual" placeholder="">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="kodeFasilitas">Fasilitas <i class="text-danger"></i></label>
                                <select name="kodeFasilitas" id="kodeFasilitas" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="kodeDokumen">Jenis Dok. Referensi <i class="text-danger"></i></label>
                                <select name="kodeDokumen" id="kodeDokumen" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="kodePembayaran">Opsi Pembayaran (IP) <i class="text-danger"></i></label>
                                <select name="kodePembayaran" id="kodePembayaran" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="nomorSP2D">Nomor SP2D (IP) <i class="text-danger"></i></label>
                                <input type="text" name="nomorSP2D" class="form-control form-control-sm" id="nomorSP2D" placeholder="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="kodeObjekPajak">Kode Objek Pajak <i class="text-danger"></i></label>
                                <select name="kodeObjekPajak" id="kodeObjekPajak" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="tarifFormat">Tarif <span class="text-sm text-secondary readonly-text"></span></span></label>
                                <input type="text" class="form-control form-control-sm" name="tarifFormat" id="tarifFormat" placeholder="0">
                                <input type="hidden" name="tarif" id="tarif">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="dppFormat">DPP <span class="text-sm text-secondary readonly-text"></span></label>
                                <input type="text" class="form-control form-control-sm" name="dppFormat" id="dppFormat" placeholder="0">
                                <input type="hidden" name="dpp" id="dpp">
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="pphFormat">PPh <span class="text-sm text-secondary readonly-text"></span></label>
                                <input type="text" class="form-control form-control-sm" id="pphFormat" placeholder="0">
                                <input type="hidden" name="pph" id="pph">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="masaPajak">Masa Pajak <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                                <input type="text" name="masaPajak" class="form-control form-control-sm" id="masaPajak">
                            </div>

                            <div class="form-group col-lg-6 col-md-6">
                                <label class="label-katapanda-sm" for="tanggalPemotongan">Tanggal Pemotongan <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                                <input type="text" name="tanggalPemotongan" class="form-control form-control-sm" id="tanggalPemotongan" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="statusFakturPajak">Status Faktur <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <select name="statusFakturPajak" id="statusFakturPajak" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nomorFakturPajak">Nomor Dok. Referensi <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <input type="text" name="nomorFakturPajak" class="form-control form-control-sm" id="nomorFakturPajak" placeholder="">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="tanggalFakturPajak">Tanggal Dok. Referensi <span class="text-sm text-secondary readonly-text"></span><span class="field-required text-danger"></span></label>
                            <input type="text" name="tanggalFakturPajak" class="form-control form-control-sm" id="tanggalFakturPajak" placeholder="">
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
                        <p>Apakah anda yakin akan menghapus data unifikasi dengan nomor dok. <span class="font-weight-bold" id="dataDelete"></span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn bg-custom" id="submitDeleteRow">Yes, delete</button>
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

            // $('#deleteReport').hide()

            // button default for action datatables
            let buttonAction = ['copyHtml5']; // add button to copy data
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";
            $('#periode_awal').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // Bulan
                autoclose: true,
                clearBtn: true
            }).on('changeDate', function(e) {
                let start = moment(e.date);
                let maxEnd = moment(start).add(3, 'months').endOf('month'); // +3 bulan
                let minEnd = moment(start).startOf('month');

                // Set range untuk periode akhir
                $('#periode_akhir').datepicker('setStartDate', minEnd.toDate());
                $('#periode_akhir').datepicker('setEndDate', maxEnd.toDate());

                // Jika periode akhir kosong, auto set ke sama dengan awal
                $('#periode_akhir').datepicker('update', start.format('MM-YYYY'));
            }).datepicker('update', moment().format('MM-YYYY'));

            $('#periode_akhir').datepicker({
                format: "mm-yyyy",
                minViewMode: 1,
                autoclose: true,
                clearBtn: true
            }).datepicker('update', moment().format('MM-YYYY'));
            $('#masaPajak').datepicker({
                format: "mm-yyyy",
                minViewMode: 1, // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).on('changeDate', function(e) {
                let masaPajak = $(this).val(); // contoh: "09-2025"
                if (masaPajak) {
                    let [bulan, tahun] = masaPajak.split('-');

                    // hitung tanggal akhir bulan
                    let lastDate = new Date(tahun, bulan, 0); // triknya: day = 0 => last day prev month
                    let dd = String(lastDate.getDate()).padStart(2, '0');
                    let mm = String(lastDate.getMonth() + 1).padStart(2, '0');
                    let yyyy = lastDate.getFullYear();

                    // format ke dd-mm-yyyy
                    let formatted = yyyy + '-' + mm + '-' + dd;

                    $('#tanggalPemotongan').val(formatted);
                }
            });
            $('#tanggalFakturPajak').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker();
            $('#tanggalPemotongan').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker();

            // store to select
            getPerusahaan();
            getVendor();
            getKodeDokumen();
            getKodeFasilitas();
            getKodeObjekPajak();
            getKodePembayaran();
            getStatusFaktur();

            // button action by user role 
            // actionExportToExcel ? buttonAction.push({
            //     extend: 'excelHtml5',
            //     exportOptions: {
            //         columns: ':not(:first-child)',
            //         title: '', // kosongkan judul
            //         messageTop: '', // hilangkan message di atas
            //         format: {
            //             body: function(data, row, column, node) {
            //                 if (column === 0 || column === 1 || column === 2 || column === 3 || column === 4 || column === 5 || column === 8 || column === 11 || column === 13 || column === 12) {
            //                     // Masa Pajak, Tahun Pajak, NPWP, ID TKU Penerima Penghasilan, Fasilitas, Kode Objek Pajak, Jenis Dok. Referensi, ID TKU Pemotong, Opsi Pembayaran (IP), Nomor SP2D (IP)
            //                     return `${data}`;
            //                 } else if (column === 9) {
            //                     // Nomor Dok. Referensi
            //                     if (/^\d+$/.test(data)) {
            //                         // Jika semua karakter numeric → tambahkan ' di depan
            //                         return "'" + data;
            //                     }
            //                     return data; // kalau ada huruf/simbol, biarkan
            //                 } else if (column === 6 || column === 15) {
            //                     // DPP, PPh
            //                     let nominal = data?.replace(/[^\d]/g, ''); // buang semua selain angka
            //                     return parseInt(nominal) || 0;
            //                 } else if (column === 7) {
            //                     // Tarif
            //                     let nominal = data?.replace(/[^0-9.]/g, ''); // buang semua selain angka & titik
            //                     return parseFloat(nominal) || 0;
            //                 } else if (column === 10 || column === 14) {
            //                     // Tanggal Dok. Referensi, Tanggal Pemotongan
            //                     let parsedDate = moment(data, ['DD/MM/YYYY', 'YYYY-MM-DD', 'MM/DD/YYYY'], true);
            //                     if (parsedDate.isValid()) {
            //                         return parsedDate.format('DD/MM/YYYY');
            //                     }
            //                     return data;
            //                 }

            //                 return data;
            //             }
            //         },
            //     },
            // }) : ''; // button export to excel

            actionExportToExcel ? buttonAction.push({
                text: 'Excel Custom',
                action: function(e, dt, node, config) {
                    // Ambil parameter dari input/filter
                    let periode_awal = $('#periode_awal').val(); // misal: "08-2025"
                    let periode_akhir = $('#periode_akhir').val(); // misal: "08-2025"

                    let [bulanAwal, tahunAwal] = periode_awal.split('-');
                    let [bulanAkhir, tahunAkhir] = periode_akhir.split('-');

                    // Buat query string
                    var params = $.param({
                        bulan_awal: bulanAwal,
                        tahun_awal: tahunAwal,
                        bulan_akhir: bulanAkhir,
                        tahun_akhir: tahunAkhir,
                        perusahaan: $('#perusahaan').val(),
                    });

                    // Trigger download file Excel dari server (PHPExcel)
                    window.location.href = "<?php echo base_url('report/unifikasi'); ?>?" + params;
                }
            }) : ''; // button export to excel

            actionExportToCsv ? buttonAction.push('csvHtml5') : ''; // button export to csv
            actionExportToPdf ? buttonAction.push({ // button export to pdf
                text: 'PDF',
                extend: 'pdfHtml5',
                orientation: 'portrait', //landscape
                pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                exportOptions: {
                    columns: ':visible:not(:first-child)',
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
                buttons: buttonAction
            });

            // store data to dataTables 
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#katapandaTable').DataTable({
                processing: true,
                ajax: { // array
                    url: '<?= site_url() ?>api/web/v1/report/unifikasi',
                    contentType: "application/json",
                    type: "POST",
                    data: function() {
                        let periode_awal = $('#periode_awal').val(); // misal: "08-2025"
                        let periode_akhir = $('#periode_akhir').val(); // misal: "08-2025"
                        let [bulanAwal, tahunAwal] = periode_awal.split('-');
                        let [bulanAkhir, tahunAkhir] = periode_akhir.split('-');
                        return JSON.stringify({
                            bulan_awal: bulanAwal,
                            tahun_awal: tahunAwal,
                            bulan_akhir: bulanAkhir,
                            tahun_akhir: tahunAkhir,
                            perusahaan: $('#perusahaan').val(),
                        });
                    },
                    complete: function(res) {
                        let response = res.responseJSON
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
                            let action = `<div class="btn-group">`;
                            actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning d-none d-sm-block edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                            actionDelete ? action += `<button class="btn btn-sm btn-outline-danger d-none d-sm-block delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : '';
                            action += `</div>`;
                            return action;
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
                        data: "npwp_penjual",
                        className: "align-middle text-nowrap",
                        responsivePriority: 1
                    },
                    {
                        data: "nama_penjual",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "fasilitas",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "kode_objek_pajak",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "nominal_jasa",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "tarif",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "pph",
                        className: "align-middle text-nowrap text-right",
                        responsivePriority: 3,
                        render: function(data, type, row, meta) {
                            return data ? formatNumber(data) : data;
                        }
                    },
                    {
                        data: "kode_dokumen",
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
                    // {
                    //     data: "id_pemotong",
                    //     className: "align-middle text-nowrap"
                    // },
                    // {
                    //     data: "kode_pembayaran",
                    //     className: "align-middle text-nowrap"
                    // },
                    // {
                    //     data: "nomor_sp2d",
                    //     className: "align-middle text-nowrap"
                    // },
                    // {
                    //     data: "tanggal_pemotongan",
                    //     className: "align-middle text-nowrap",
                    //     render: function(data, type, row, meta) {
                    //         let date = data !== null ? moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY') : 0;
                    //         return date;
                    //     }
                    // },
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
                $('#form').trigger("reset");
                $('#formUpdate').trigger("reset");

                $('#periode_awal').val(moment().subtract(0, 'years').format('MM-YYYY'));
                $('.selectpicker').selectpicker('refresh');
                $('#perusahaan').val().change();
            })

            // getter and setter data in the row to form input
            $('#katapandaTable tbody').on('click', 'tr', function() {

                var ids = $.map(table.rows(this).data(), function(item) {
                    // alert(JSON.stringify(item))
                    // console.log('Edit');
                    // console.log(JSON.stringify(item));

                    // Format ribuan
                    let itemPPhFormat = item.pph?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let itemDPPFormat = item.nominal_jasa?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let itemTarifFormat = item.tarif?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    // store data to input
                    $('#perusahaan').val(item.master_perusahaan_id).trigger('change');
                    $('#nitkuPerusahaan').val(item.id_pemotong);
                    $('#vendor').val(item.master_vendor_id).trigger('change');
                    $('#npwpPenjual').val(item.npwp_penjual);
                    $('#nitkuPenjual').val(item.id_penerima);
                    $('#cek').val(item.cek).trigger('change');
                    $('#nomorFakturPajak').val(item.nomor_faktur_pajak);
                    $('#tanggalFakturPajak').datepicker().datepicker('update', moment(new Date(item.tanggal_faktur_pajak)).format('DD-MM-YYYY'));
                    $('#tanggalPemotongan').datepicker().datepicker('update', moment(new Date(item.tanggal_pemotongan)).format('DD-MM-YYYY'));
                    $('#nomorSP2D').val(item.nomor_sp2d);
                    $('#pph').val(item.pph);
                    $('#pphFormat').val(itemPPhFormat);
                    $('#tarif').val(item.tarif);
                    $('#tarifFormat').val(itemTarifFormat);
                    $('#dpp').val(item.nominal_jasa);
                    $('#dppFormat').val(itemDPPFormat);
                    $('#kodeDokumen').val(item.unifikasi_kode_dokumen_id).trigger('change');
                    $('#kodeFasilitas').val(item.unifikasi_kode_fasilitas_id).trigger('change');
                    $('#kodeObjekPajak').val(item.unifikasi_kode_objek_pajak_id).trigger('change');
                    $('#kodePembayaran').val(item.unifikasi_kode_pembayaran_id).trigger('change');
                    $('#statusFakturPajak').val(item.status_faktur_pajak).trigger('change');

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
                        $('#masaPajakPengkreditkan').datepicker().datepicker('update', moment(masaTahunPajakPengkreditkanClicked, 'MM-YYYY').format('MM-YYYY'));
                    }

                    if (item.is_jasa == true) {
                        $('#isJasa').prop('checked', true)
                        $('#inputNominalJasa').show();
                    } else {
                        $('#isJasa').prop('checked', false)
                        $('#inputNominalJasa').hide();
                    }

                    // set
                    id = item.id;

                    // store data to confirm delete text
                    $('#dataDelete').text(item.nomor_faktur_pajak);

                });

            });

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
                        table.ajax.reload(null, false);
                    })
            })

            // confirm delete 
            $('#katapandaTable tbody').on('click', '.delete', function() {
                // show confirm
                $('#confirmTitle').html('<i class="fas fa-users"></i> Delete <?= $title ?>');
                $('#confirmKatapanda').modal('show')
            })

            // modal form add new data  
            $('#newData').click(function() {
                $('.admin-hide').show();

                $('.readonly-text').text('')
                $('.field-required').text('*');
                // reset ID
                id = null;
                // reset validator in the form
                validator.resetForm()
                // reset Form
                resetFormInput();

                // show modal
                $('#formTitle').html('<i class="fas fa-users"></i> New <?= $title ?>');
                $('#btnSubmit').text('Save');
                $('#formReportUnifikasi').modal({
                    backdrop: 'static'
                }, 'show')
                // $('#btnResetFormInput').css("display", "");
            })

            // modal form edit in desktop mode
            $('.edit').click(function() {
                validator.resetForm();

                $('.readonly-text').text('(read-only)')
                $('.field-required').text('');

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formReportUnifikasi').modal({
                    backdrop: 'static'
                }, 'show');
                // $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                // $('#formReportUnifikasi').find('input, select, textarea, button').prop('disabled', true);
                $('#perusahaanSelect').prop('disabled', true);
                $('#perusahaanSelect').selectpicker('refresh');
                $('#nitkuPerusahaan').prop('disabled', true);
                $('#vendor').prop('disabled', true);
                $('#vendor').selectpicker('refresh');
                $('#npwpPenjual').prop('disabled', true);
                $('#nitkuPenjual').prop('disabled', true);
                $('#nomorFakturPajak').prop('disabled', true);
                $('#tanggalFakturPajak').prop('disabled', true);
                $('#masaPajak').prop('disabled', true);
                $('#dppFormat').prop('disabled', true);
                $('#tarifFormat').prop('disabled', true);
                $('#tanggalPemotongan').prop('disabled', true);
                $('#pphFormat').prop('disabled', true);
                $('#statusFakturPajak').prop('disabled', true);
                $('#statusFakturPajak').selectpicker('refresh');

                // kalau pakai selectpicker
                // $('#formReportUnifikasi').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
            })

            // modal form edit in tablet/mobile mode
            $('#katapandaTable tbody').on('click', '.edit', function() {
                validator.resetForm();

                $('.readonly-text').text('(read-only)')
                $('.field-required').text('');

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formReportUnifikasi').modal({
                    backdrop: 'static'
                }, 'show');
                // $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                // $('#formReportUnifikasi').find('input, select, textarea, button').prop('disabled', true);
                $('#perusahaanSelect').prop('disabled', true);
                $('#perusahaanSelect').selectpicker('refresh');
                $('#nitkuPerusahaan').prop('disabled', true);
                $('#vendor').prop('disabled', true);
                $('#vendor').selectpicker('refresh');
                $('#npwpPenjual').prop('disabled', true);
                $('#nitkuPenjual').prop('disabled', true);
                $('#nomorFakturPajak').prop('disabled', true);
                $('#tanggalFakturPajak').prop('disabled', true);
                $('#masaPajak').prop('disabled', true);
                $('#dppFormat').prop('disabled', true);
                $('#tarifFormat').prop('disabled', true);
                $('#tanggalPemotongan').prop('disabled', true);
                $('#pphFormat').prop('disabled', true);
                $('#statusFakturPajak').prop('disabled', true);
                $('#statusFakturPajak').selectpicker('refresh');

                // kalau pakai selectpicker
                // $('#formReportUnifikasi').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
            })

            $('#perusahaan').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let selectedName = selectedOption.data('nama');

                if (selectedName) {
                    perusahaanName = selectedName
                } else {
                    perusahaanName = ''
                }
            });

            $('#perusahaanSelect').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let idTKUPemotong = selectedOption.data('nitku');

                if (idTKUPemotong) {
                    $('#nitkuPerusahaan').val(idTKUPemotong)
                } else {
                    $('#nitkuPerusahaan').val()
                }
            });

            $('#vendor').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let npwpPenerima = selectedOption.data('npwp');
                let idTKUPenerima = selectedOption.data('nitku');
                let kodeObjekPajak = selectedOption.data('pajak');
                let kodeFasilitas = selectedOption.data('fasilitas');
                
                console.log('Fasilitas:', kodeObjekPajak);

                $('#npwpPenjual').val(npwpPenerima)
                $('#nitkuPenjual').val(idTKUPenerima)
                $('#kodeObjekPajak').val(kodeObjekPajak).trigger('change');
                $('#kodeFasilitas').val(kodeFasilitas).trigger('change');
            });

            $('#kodeObjekPajak').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let tarif = selectedOption.data('tarif');
                $('#tarifFormat').val(tarif)
                $('#tarif').val(tarif)

                let dpp = $('#dpp').val() ? parseInt($('#dpp').val()) : 0
                let pph = (parseFloat(tarif) / 100) * dpp
                let pphFormatted = pph.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                $('#pph').val(pph)
                $('#pphFormat').val(pphFormatted)
            });

            $('#dppFormat').on('input', function() {
                // Ambil nilai murni hanya angka
                let rawValue = $(this).val().replace(/\D/g, '');

                // Format ribuan
                let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Set tampilan format ke input text
                $(this).val(formattedValue);

                // Simpan nilai asli ke hidden input
                $('#dpp').val(rawValue);

                let tarif = $('#tarif').val() ? $('#tarif').val() : 0
                let pph = parseInt(rawValue) * (parseFloat(tarif) / 100)
                let pphFormatted = pph.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                $('#pph').val(pph)
                $('#pphFormat').val(pphFormatted)
            });

            // validate and request add new data and update existing data 
            let validator = $('#formUpdate').validate({
                rules: {
                    perusahaanSelect: {
                        required: true,
                    },
                    vendor: {
                        required: true,
                    },
                    kodeFasilitas: {
                        required: true,
                    },
                    nomorFakturPajak: {
                        required: true
                    },
                    tanggalFakturPajak: {
                        required: true
                    },
                    masaPajak: {
                        required: true
                    },
                    statusFakturPajak: {
                        required: true
                    },
                    cek: {
                        required: true
                    },
                },
                messages: {
                    perusahaanSelect: {
                        required: "Please select perusahaan",
                    },
                    vendor: {
                        required: "Please select vendor",
                    },
                    nomorFakturPajak: {
                        required: "Please enter nomor dok",
                    },
                    tanggalFakturPajak: {
                        required: "Please enter tanggal dok",
                    },
                    masaPajak: {
                        required: "Please enter masa pajak",
                    },
                    statusFakturPajak: {
                        maxlength: "Please select status pajak"
                    },
                    cek: {
                        required: "Please select Cek",
                    },
                },
                submitHandler: function(form) {
                    // start loading
                    loadingStart()

                    const monthNames = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];

                    const [bulanPajakNum, tahunPajak] = $('#masaPajak').val()?.split("-");

                    // ubah bulan angka ke nama bulan
                    const bulanPajak = monthNames[parseInt(bulanPajakNum, 10) - 1];

                    const tanggalFakturPajak = moment($('#tanggalFakturPajak').val(), "DD-MM-YYYY").format("YYYY-MM-DD");

                    // default request for create
                    let requestData = {
                        perusahaan: $('#perusahaanSelect').val(),
                        vendor: $('#vendor').val(),
                        fasilitas: $('#kodeFasilitas').val(),
                        objek_pajak: $('#kodeObjekPajak').val(),
                        dokumen: $('#kodeDokumen').val(),
                        pembayaran: $('#kodePembayaran').val(),
                        nomor_sp2d: $('#nomorSP2D').val(),
                        nominal_jasa: $('#dpp').val() ? $('#dpp').val() : 0,
                        ppn: $('#pph').val(),
                        masa_pajak: bulanPajak,
                        tahun_pajak: tahunPajak,
                        tanggal_pemotongan: $('#tanggalPemotongan').val(),
                        nomor_faktur_pajak: $('#nomorFakturPajak').val(),
                        tanggal_faktur_pajak: tanggalFakturPajak,
                        is_unifikasi_only: true,
                        is_jasa: true,
                        status_faktur_pajak: null,
                        cek: null,
                        status_faktur_pajak: $('#statusFakturPajak').val(),
                    }

                    if (id) {
                        // request for update
                        requestData = {
                            fasilitas: $('#kodeFasilitas').val(),
                            objek_pajak: $('#kodeObjekPajak').val(),
                            dokumen: $('#kodeDokumen').val(),
                            pembayaran: $('#kodePembayaran').val(),
                            nomor_sp2d: $('#nomorSP2D').val(),
                        }
                    }

                    // send request 
                    axios({
                            method: id === null ? `POST` : `PUT`,
                            url: id === null ? `<?= site_url() ?>api/web/v1/report/unifikasi/create` : `<?= site_url() ?>api/web/v1/report/unifikasi/update/${id}`,
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
                                $('#formReportUnifikasi').modal('hide');
                                $('#katapandaTable').DataTable().ajax.reload(null, false);
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

            // Pastikan selectpicker di-refresh setelah modal tampil
            $('#formReportUnifikasi').on('shown.bs.modal', function() {
                if (id === null) {
                    getPerusahaan();
                }
            });

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
                    const $perusahaan = $('#perusahaan');
                    const $perusahaanSelect = $('#perusahaanSelect');
                    $perusahaan.empty(); // hapus isi lama
                    $perusahaanSelect.empty(); // hapus isi lama

                    response.data.data.forEach(element => {
                        // add option
                        $perusahaan.append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.new_npwp + ' - ' + element.nama + '</option><option data-divider="true"></option>')
                        $perusahaanSelect.append('<option value="' + element.id + '" data-nama="' + element.nama + '" data-nitku="' + element.nitku + element.nitku_digit + '">' + element.new_npwp + ' - ' + element.nama + '</option><option data-divider="true"></option>')
                    });

                    // refresh setelah opsi masuk
                    $perusahaan.selectpicker('refresh');
                    $perusahaanSelect.selectpicker('refresh');

                    // refresh selectpicker
                    // $('.selectpicker').selectpicker('refresh');

                    // set default value pakai selectpicker API
                    const selected = response.data.data[0]?.id || '';
                    $perusahaan.selectpicker('val', selected);
                    $perusahaanSelect.selectpicker('val', selected);

                    // $('#perusahaan').val(selected).trigger('change');
                    // $('#perusahaanSelect').val(selected).trigger('change');

                    if (selected) {
                        let idTKUPemotong = element.nitku + element.nitku_digit;
                        if (idTKUPemotong) {
                            $('#nitkuPerusahaan').val(idTKUPemotong)
                        } else {
                            $('#nitkuPerusahaan').val()
                        }
                    }

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
                        $('#vendor').append('<option value="' + element.id + '" data-nama="' + element.nama + '" data-npwp="' + element.new_npwp + '" data-nitku="' + element.nitku + element.nitku_digit + '" data-cek="' + element.cek + '" data-pajak="' + element.unifikasi_kode_objek_pajak_id + '" data-fasilitas="' + element.unifikasi_kode_fasilitas_id + '">' + element.nama + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#vendor').val(selected).trigger('change');
                    // setTimeout(
                    //     function() {
                    //         $('#filter').trigger('click');
                    //     }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        // get kode dokumen
        function getKodeDokumen() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/unifikasi/kode-dokumen`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        selected = element.id
                        // add option
                        $('#kodeDokumen').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#kodeDokumen').val(selected).trigger('change');
                    // setTimeout(
                    //     function() {
                    //         $('#filter').trigger('click');
                    //     }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        // get kode Fasilitas
        function getKodeFasilitas() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/unifikasi/kode-fasilitas`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        if (element.id == 1) {
                            selected = element.id
                        }

                        // add option
                        $('#kodeFasilitas').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    $('#kodeFasilitas').val(selected).trigger('change');
                    // setTimeout(
                    //     function() {
                    //         $('#filter').trigger('click');
                    //     }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        // get kode ObjekPajak
        function getKodeObjekPajak() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/unifikasi/kode-objek-pajak`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        selected = element.id
                        // add option
                        $('#kodeObjekPajak').append('<option value="' + element.id + '" data-nama="' + element.nama + '" data-tarif="' + element.tarif + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#kodeObjekPajak').val(selected).trigger('change');
                    setTimeout(
                        function() {
                            $('#filter').trigger('click');
                        }, 1000);
                })
                .catch(function(error) {
                    // console.log(error);
                })
        }

        // get kode Pembayaran
        function getKodePembayaran() {
            axios({
                    method: `GET`,
                    url: `<?= site_url() ?>api/web/v1/unifikasi/kode-pembayaran`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    let selected = '';
                    response.data.data.forEach(element => {
                        if (element.id == 1) {
                            selected = element.id
                        }

                        // add option
                        $('#kodePembayaran').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    $('#kodePembayaran').val(selected).trigger('change');
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
            $selectStatusFaktur.append('<option value="CREDITED">CREDITED</option>');
            $selectStatusFaktur.append('<option value="UNCREDITED">UNCREDITED</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            $selectStatusFaktur.val();
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        // reset Form
        function resetFormInput() {
            $('#form').trigger("reset");
            // $('#perusahaan').val('').selectpicker('refresh');
            // $('#perusahaanSelect').val('').selectpicker('refresh');
            $('#vendor').val('').selectpicker('refresh');
            $('#inputNominalJasa').hide();

            $('#vendor').val('').selectpicker('refresh');
            $('#npwpPenjual').val('');
            $('#nitkuPenjual').val('');
            $('#kodeObjekPajak').val('').selectpicker('refresh');
            $('#kodeDokumen').val(12).selectpicker('refresh');
            $('#kodePembayaran').val(1).selectpicker('refresh');
            $('#nomorFakturPajak').val('');
            $('#tanggalFakturPajak').val('');
            $('#masaPajak').val('');
            $('#dppFormat').val('');
            $('#tarifFormat').val('');
            $('#tanggalPemotongan').val('');
            $('#pphFormat').val('');

            $('#perusahaanSelect').prop('disabled', false);
            $('#perusahaanSelect').selectpicker('refresh');
            $('#nitkuPerusahaan').prop('disabled', true);
            $('#vendor').prop('disabled', false);
            $('#vendor').selectpicker('refresh');
            $('#npwpPenjual').prop('disabled', true);
            $('#nitkuPenjual').prop('disabled', true);
            $('#nomorFakturPajak').prop('disabled', false);
            $('#tanggalFakturPajak').prop('disabled', false);
            $('#masaPajak').prop('disabled', false);
            $('#dppFormat').prop('disabled', false);
            $('#tarifFormat').prop('disabled', true);
            $('#tanggalPemotongan').prop('disabled', true);
            $('#pphFormat').prop('disabled', true);
            $('#statusFakturPajak').val('').selectpicker('refresh');
            $('#statusFakturPajak').prop('disabled', false);
            $('#statusFakturPajak').selectpicker('refresh');
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