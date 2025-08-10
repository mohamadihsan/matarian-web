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
                                <button class="btn btn-sm btn-danger" id="deleteReport"><i class="fas fa-trash"></i> Delete</button>
                                <button class="btn btn-sm btn-primary" id="filter"><i class="fas fa-envelope-open-text"></i> Generate Report</button>
                            </div>
                        </div>
                    </div>
                    <div id="sansHidden">
                        <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                            <thead class="thead-light">
                                <tr>
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

    <script>
        $(document).ready(function() {

            // init variable
            // $('#sansHidden').css('display', 'none')
            let id = null;
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
                minViewMode: 1,          // 1 = Bulan, 2 = Tahun
                autoclose: true,
                todayHighlight: true,
                clearBtn: true
            }).datepicker('update', moment().format('MM-YYYY'));

            // store to select
            getPerusahaan();

            // button action by user role 
            actionExportToExcel ? buttonAction.push({
                extend: 'excelHtml5',
                exportOptions: {
                    format: {
                        body: function(data, row, column, node) {
                            if (column === 0) {
                                // NPWP Penjua;
                                return `${data}`;
                            } else if (column === 1) {
                                // Nama Penjual
                                return `${data}`;
                            } else if (column === 2) {
                                // Cek
                                return `${data}`;
                            } else if (column === 3) {
                                // Nomor Faktur Pajak
                                return `${data}`;
                            } else if (column === 4) {
                                // Tanggal Faktur Pajak
                                let parsedDate = moment(data, ['DD/MM/YYYY', 'YYYY-MM-DD', 'MM/DD/YYYY'], true);
                                if (parsedDate.isValid()) {
                                    return parsedDate.format('DD/MM/YYYY');
                                }
                                return data;
                            } else if (column === 5) {
                                // masa Pajak
                                return `${data}`;
                            } else if (column === 6) {
                                // Tahun Pajak
                                return `${data}`;
                            } else if (column === 7) {
                                // masa Pajak Pengkreditkan
                                return `${data}`;
                            } else if (column === 8) {
                                // Tahun Pajak Pengkreditkan
                                return `${data}`;
                            } else if (column === 9) {
                                // Status Faktur
                                return `${data}`;
                            } else if (column === 10 || column === 11 || column === 12 || column === 13 || column === 14 || column === 15 || column === 16) {
                                // Harga Jual, DPP Nilai Lain, PPN, PPN Condition, B1, B2, B3
                                let nominal = data?.replace(/[^\d]/g, ''); // buang semua selain angka
                                return parseInt(nominal) || 0;
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
                columns: [
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

                $('#periode').val(moment().subtract(0, 'years').format('MM-YYYY'));
                $('.selectpicker').selectpicker('refresh');
                $('#perusahaan').val().change();
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
                    });
                    // refresh selectpicker
                    $('.selectpicker').selectpicker('refresh');
                    
                    $('#perusahaan').val(selected).trigger('change');
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
    </script>