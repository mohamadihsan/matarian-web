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
                            <div class="form-group col-lg-4 col-md-4">
                                <label class="label-katapanda-sm" for="perusahaan">Perusahaan <i class="text-danger">*</i></label>
                                <select name="perusahaan" id="perusahaan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="periode">Masa Pajak <i class="text-danger">*</i></label>
                                <input type="text" name="periode" class="form-control form-control-sm" id="periode">
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
                                <button class="btn btn-sm btn-danger" id="deleteReport"><i class="fas fa-trash"></i> Delete</button>
                                <button class="btn btn-sm btn-primary" id="filter"><i class="fas fa-envelope-open-text"></i> Generate Report</button>
                            </div>
                        </div>
                    </div>
                    <div id="sansHidden">
                        <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">Masa Pajak</th>
                                    <th class="text-right text-nowrap">Tahun Pajak</th>
                                    <th class="text-center text-nowrap">NPWP</th>
                                    <th class="text-right text-nowrap">ID TKU Penerima Penghasilan</th>
                                    <th class="text-right text-nowrap">Fasilitas</th>
                                    <th class="text-right text-nowrap">Kode Objek Pajak</th>
                                    <th class="text-right text-nowrap">DPP</th>
                                    <th class="text-right text-nowrap">Tarif</th>
                                    <th class="text-right text-nowrap">Jenis Dok. Referensi</th>
                                    <th class="text-center text-nowrap">Nomor Dok. Referensi</th>
                                    <th class="text-center text-nowrap">Tanggal Dok. Referensi</th>
                                    <th class="text-center text-nowrap">ID TKU Pemotong</th>
                                    <th class="text-right text-nowrap">Opsi Pembayaran (IP)</th>
                                    <th class="text-right text-nowrap">Nomor SP2D (IP)</th>
                                    <th class="text-right text-nowrap">Tanggal Pemotongan</th>
                                    <th class="text-right text-nowrap">PPh</th>
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">Masa Pajak</th>
                                    <th class="text-right text-nowrap">Tahun Pajak</th>
                                    <th class="text-center text-nowrap">NPWP</th>
                                    <th class="text-right text-nowrap">ID TKU Penerima Penghasilan</th>
                                    <th class="text-right text-nowrap">Fasilitas</th>
                                    <th class="text-right text-nowrap">Kode Objek Pajak</th>
                                    <th class="text-right text-nowrap">DPP</th>
                                    <th class="text-right text-nowrap">Tarif</th>
                                    <th class="text-right text-nowrap">Jenis Dok. Referensi</th>
                                    <th class="text-center text-nowrap">Nomor Dok. Referensi</th>
                                    <th class="text-center text-nowrap">Tanggal Dok. Referensi</th>
                                    <th class="text-center text-nowrap">ID TKU Pemotong</th>
                                    <th class="text-right text-nowrap">Opsi Pembayaran (IP)</th>
                                    <th class="text-right text-nowrap">Nomor SP2D (IP)</th>
                                    <th class="text-right text-nowrap">Tanggal Pemotongan</th>
                                    <th class="text-right text-nowrap">PPh</th>
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
    <div class="modal fade" id="formUpdateReportUnifikasi" tabindex="-1" role="dialog" aria-labelledby="formUpdateReportUnifikasiTitle" aria-hidden="true">
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
                            <label class="label-katapanda-sm" for="perusahaanSelect">Nama Pemotong <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <select name="perusahaanSelect" id="perusahaanSelect" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose" readonly></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nitkuPerusahaan">ID TKU Pemotong <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <input type="text" name="nitkuPerusahaan" class="form-control form-control-sm" id="nitkuPerusahaan" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="vendor">Nama Penerima <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <select name="vendor" id="vendor" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose" readonly></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="npwpPenjual">NPWP Penerima <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <input type="text" name="npwpPenjual" class="form-control form-control-sm" id="npwpPenjual" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nitkuPenjual">ID TKU Penerima Penghasilan <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <input type="text" name="nitkuPenjual" class="form-control form-control-sm" id="nitkuPenjual" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nomorFakturPajak">Nomor Dok. Referensi <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <input type="text" name="nomorFakturPajak" class="form-control form-control-sm" id="nomorFakturPajak" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="tanggalFakturPajak">Tanggal Dok. Referensi <span class="text-sm text-secondary">(read-only)</span><span class="text-danger"></span></label>
                            <input type="text" name="tanggalFakturPajak" class="form-control form-control-sm" id="tanggalFakturPajak" placeholder="" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="masaPajak">Masa Pajak <span class="text-sm text-secondary">(read-only)</span><i class="text-danger"></i></label>
                            <input type="text" name="masaPajak" class="form-control form-control-sm" id="masaPajak" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="dppFormat">DPP <span class="text-sm text-secondary">(read-only)</span><span class="text-danger"></span></label>
                            <input type="text" class="form-control form-control-md" name="dppFormat" id="dppFormat" placeholder="0" readonly>
                            <input type="hidden" name="dpp" id="dpp" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="tarifFormat">Tarif <span class="text-sm text-secondary">(read-only)</span><span class="text-danger"></span></label>
                            <input type="text" class="form-control form-control-md" name="tarifFormat" id="tarifFormat" placeholder="0">
                            <input type="hidden" name="tarif" id="tarif" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="tanggalPemotongan">Tanggal Pemotongan <span class="text-sm text-secondary">(read-only)</span><span class="text-danger"></span></label>
                            <input type="text" name="tanggalPemotongan" class="form-control form-control-sm" id="tanggalPemotongan" placeholder="">
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="pphFormat">PPh <span class="text-sm text-secondary">(read-only)</span><span class="text-danger"></span></label>
                            <input type="text" class="form-control form-control-md" id="pphFormat" placeholder="0">
                            <input type="hidden" name="pph" id="pph" readonly>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="kodeFasilitas">Fasilitas <i class="text-danger"></i></label>
                            <select name="kodeFasilitas" id="kodeFasilitas" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="kodeObjekPajak">Kode Objek Pajak <i class="text-danger"></i></label>
                            <select name="kodeObjekPajak" id="kodeObjekPajak" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="kodeDokumen">Jenis Dok. Referensi <i class="text-danger"></i></label>
                            <select name="kodeDokumen" id="kodeDokumen" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="kodePembayaran">Opsi Pembayaran (IP) <i class="text-danger"></i></label>
                            <select name="kodePembayaran" id="kodePembayaran" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose"></select>
                        </div>

                        <div class="form-group">
                            <label class="label-katapanda-sm" for="nomorSP2D">Nomor SP2D (IP) <i class="text-danger"></i></label>
                            <input type="text" name="nomorSP2D" class="form-control form-control-sm" id="nomorSP2D" placeholder="">
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

    <script>
        $(document).ready(function() {

            // init variable
            // $('#sansHidden').css('display', 'none')
            let id = null;
            let actionUpdate = <?php echo $action_update == 1 ? 1 : 0; ?>;
            let actionExportToExcel = <?php echo $action_export_to_excel == 1 ? 1 : 0; ?>;
            let actionExportToCsv = <?php echo $action_export_to_csv == 1 ? 1 : 0; ?>;
            let actionExportToPdf = 0;
            var perusahaanName = ''

            $('#deleteReport').hide()

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
            $('#masaPajak').datepicker({
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

            // button action by user role 
            actionExportToExcel ? buttonAction.push({
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(:first-child)',
                    title: '', // kosongkan judul
                    messageTop: '', // hilangkan message di atas
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 0 || column === 1 || column === 2 || column === 3 || column === 4 || column === 5 || column === 8 || column === 11 || column === 13 || column === 12) {
                                // Masa Pajak, Tahun Pajak, NPWP, ID TKU Penerima Penghasilan, Fasilitas, Kode Objek Pajak, Jenis Dok. Referensi, ID TKU Pemotong, Opsi Pembayaran (IP), Nomor SP2D (IP)
                                return `${data}`;
                            } else if (column === 9) {
                                // Nomor Dok. Referensi
                                if (/^\d+$/.test(data)) {
                                    // Jika semua karakter numeric → tambahkan ' di depan
                                    return "'" + data;
                                }
                                return data; // kalau ada huruf/simbol, biarkan
                            } else if (column === 6 || column === 15) {
                                // DPP, PPh
                                let nominal = data?.replace(/[^\d]/g, ''); // buang semua selain angka
                                return parseInt(nominal) || 0;
                            } else if (column === 7) {
                                // Tarif
                                let nominal = data?.replace(/[^0-9.]/g, ''); // buang semua selain angka & titik
                                return parseFloat(nominal) || 0;
                            } else if (column === 10 || column === 14) {
                                // Tanggal Dok. Referensi, Tanggal Pemotongan
                                let parsedDate = moment(data, ['DD/MM/YYYY', 'YYYY-MM-DD', 'MM/DD/YYYY'], true);
                                if (parsedDate.isValid()) {
                                    return parsedDate.format('DD/MM/YYYY');
                                }
                                return data;
                            }

                            return data;
                        }
                    },
                },
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
                        let periode = $('#periode').val(); // misal: "08-2025"
                        let [bulan, tahun] = periode.split('-');
                        return JSON.stringify({
                            bulan: bulan,
                            tahun: tahun,
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
                        data: "id_penerima",
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
                        data: "dpp",
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
                    {
                        data: "id_pemotong",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "kode_pembayaran",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "nomor_sp2d",
                        className: "align-middle text-nowrap"
                    },
                    {
                        data: "tanggal_pemotongan",
                        className: "align-middle text-nowrap",
                        render: function(data, type, row, meta) {
                            let date = data !== null ? moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY') : 0;
                            return date;
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

                $('#periode').val(moment().subtract(0, 'years').format('MM-YYYY'));
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
                    let itemDPPFormat = item.dpp?.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
                    $('#dpp').val(item.dpp);
                    $('#dppFormat').val(itemDPPFormat);
                    $('#kodeDokumen').val(item.unifikasi_kode_dokumen_id).trigger('change');
                    $('#kodeFasilitas').val(item.unifikasi_kode_fasilitas_id).trigger('change');
                    $('#kodeObjekPajak').val(item.unifikasi_kode_objek_pajak_id).trigger('change');
                    $('#kodePembayaran').val(item.unifikasi_kode_pembayaran_id).trigger('change');

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

                    // set
                    id = item.id;

                    // store data to confirm delete text
                    $('#dataDelete').text(item.nomor_faktur_pajak);

                });

            });

            // modal form edit in desktop mode
            $('.edit').click(function() {
                validator.resetForm();

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formUpdateReportUnifikasi').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                // $('#formUpdateReportUnifikasi').find('input, select, textarea, button').prop('disabled', true);
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

                // kalau pakai selectpicker
                // $('#formUpdateReportUnifikasi').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
            })

            // modal form edit in tablet/mobile mode
            $('#katapandaTable tbody').on('click', '.edit', function() {
                validator.resetForm();

                $('#formTitle').html('<i class="fas fa-users"></i> Edit <?= $title ?>');
                $('#btnSubmit').show();
                $('#btnSubmit').text('Update');
                $('#formUpdateReportUnifikasi').modal({
                    backdrop: 'static'
                }, 'show');
                $('#btnResetFormInput').css("display", "block");

                // enable semua input, select, textarea, button
                // $('#formUpdateReportUnifikasi').find('input, select, textarea, button').prop('disabled', true);
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

                // kalau pakai selectpicker
                // $('#formUpdateReportUnifikasi').find('.selectpicker').prop('disabled', false).selectpicker('refresh');
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

            // validate and request add new data and update existing data 
            let validator = $('#formUpdate').validate({
                submitHandler: function(form) {
                    // start loading
                    loadingStart()

                    const requestData = {
                        fasilitas: $('#kodeFasilitas').val(),
                        objek_pajak: $('#kodeObjekPajak').val(),
                        dokumen: $('#kodeDokumen').val(),
                        pembayaran: $('#kodePembayaran').val(),
                        nomor_sp2d: $('#nomorSP2D').val(),
                    }

                    // send request 
                    axios({
                            method: `PUT`,
                            url: `<?= site_url() ?>api/web/v1/report/unifikasi/update/${id}`,
                            headers: {
                                Authorization: 'Bearer <?= $token ?>'
                            },
                            data: requestData
                        })
                        .then(function(response) {
                            // console.log(response);
                            let status = response.data.status;
                            let message = response.data.message;
                            let action = `update`;
                            if (status) {
                                // show message
                                notification(action, 'success', message);
                                $('#formUpdateReportUnifikasi').modal('hide');
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
                        $('#perusahaanSelect').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.nama + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    $('#perusahaan').val(selected).trigger('change');
                    $('#perusahaanSelect').val(selected).trigger('change');
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
                    setTimeout(
                        function() {
                            $('#filter').trigger('click');
                        }, 1000);
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
                        selected = element.id
                        // add option
                        $('#kodeFasilitas').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#kodeFasilitas').val(selected).trigger('change');
                    setTimeout(
                        function() {
                            $('#filter').trigger('click');
                        }, 1000);
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
                        $('#kodeObjekPajak').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
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
                        selected = element.id
                        // add option
                        $('#kodePembayaran').append('<option value="' + element.id + '" data-nama="' + element.nama + '">' + element.kode + '</option><option data-divider="true"></option>')
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');

                    // $('#kodePembayaran').val(selected).trigger('change');
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
            const $select = $('#status_faktur');

            // Clear existing options if needed
            $select.empty();

            // Tambahkan opsi
            $select.append('<option value="" selected>SEMUA</option>');
            $select.append('<option value="AMENDED">AMENDED</option>');
            $select.append('<option value="APPROVED">APPROVED</option>');
            $select.append('<option value="CANCELED">CANCELED</option>');
            $select.append('<option value="CREDITED">CREDITED</option>');
            $select.append('<option value="UNCREDITED">UNCREDITED</option>');

            // Refresh selectpicker (jika pakai Bootstrap Select)
            $('.selectpicker').selectpicker('refresh');

            // Set value dan trigger change
            $select.val();
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
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