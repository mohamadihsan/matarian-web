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
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <form id="form">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="fromDate">From Date</label>
                                <input type="text" name="fromDate" class="form-control form-control-sm" id="fromDate">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="endDate">To Date</label>
                                <input type="text" name="endDate" class="form-control form-control-sm" id="endDate">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="kodeLangganan">By Langganan</label>
                                <select name="kodeLangganan" id="kodeLangganan" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                    <option value="" selected>All Langganan</option>
                                    <option data-divider="true"></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="kodeBarang">By Barang</label>
                                <select name="kodeBarang" id="kodeBarang" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                    <option value="" selected>All Barang</option>
                                    <option data-divider="true"></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <div class="button-group">
                                <button class="btn btn-sm btn-secondary" id="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                                <button class="btn btn-sm btn-primary" id="filter"><i class="fas fa-envelope-open-text"></i> Generate Report</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-left text-nowrap">Nomor Nota</th>
                                <th class="text-left text-nowrap">Tanggal Nota</th>
                                <th class="text-center text-nowrap">Kode Langganan</th>
                                <th class="text-left text-nowrap">Nama Langganan</th>
                                <th class="text-left text-nowrap">Kode Barang</th>
                                <th class="text-left text-nowrap">Nama Barang</th>
                                <th class="text-right text-nowrap">Qty</th>
                                <th class="text-right text-nowrap" width="100">Harga Satuan</th>
                                <th class="text-right text-nowrap" width="100">Total</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th colspan="8" class="text-right">Total</th>
                                <th class="text-right" id="totalFaktur"></th>
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
        let id = null;
        let actionExportToExcel = <?php echo $action_export_to_excel == 1 ? 1 : 0; ?>;
        let actionExportToCsv = <?php echo $action_export_to_csv == 1 ? 1 : 0; ?>;
        let actionExportToPdf = <?php echo $action_export_to_pdf == 1 ? 1 : 0; ?>;

        // button default for action datatables
        let buttonAction = ['copyHtml5']; // add button to copy data
        $.fn.datepicker.defaults.format = "dd-mm-yyyy";
        $('#fromDate').datepicker({
            autoclose: true,
            todayHighlight: true,
            clearBtn: true
        }).datepicker('update', moment().subtract(0, 'years').startOf('year').format('DD-MM-YYYY'));
        $('#endDate').datepicker({
            autoclose: true,
            todayHighlight: true,
            clearBtn: true
        }).datepicker('update', moment(new Date()).format('DD-MM-YYYY'));


        // $('#fromDate').val(moment().subtract(0, 'years').startOf('year').format('YYYY-MM-DD'));
        // $('#endDate').val(moment(new Date()).format('YYYY-MM-DD'));

        // store to select
        getLangganan();
        getBarang();

        // button action by user role 
        actionExportToExcel ? buttonAction.push({
            extend: 'excelHtml5',
            exportOptions: {
                format: {
                    body: function(data, row, column, node) {
                        if (column === 6 || column === 7 || column === 8) {
                            data = data.split('.').join("");
                        }
                        return data;
                    }
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
                doc.content[1].table.widths = ['10%', '10%', '15%', '14%', '13%', '13%', '3%', '11%', '11%'];
                var rowCount = doc.content[1].table.body.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'center';
                    doc.content[1].table.body[i][1].alignment = 'center';
                    doc.content[1].table.body[i][2].alignment = 'left';
                    doc.content[1].table.body[i][3].alignment = 'left';
                    doc.content[1].table.body[i][4].alignment = 'left';
                    doc.content[1].table.body[i][5].alignment = 'left';
                    doc.content[1].table.body[i][6].alignment = 'right';
                    doc.content[1].table.body[i][7].alignment = 'right';
                    doc.content[1].table.body[i][8].alignment = 'right';
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
        // $.fn.dataTable.ext.errMode = 'none';
        var table = $('#katapandaTable').DataTable({
            processing: true,
            ajax: { // array
                url: '<?= site_url() ?>api/web/v1/report/sales/by-barang-langganan',
                contentType: "application/json",
                type: "POST",
                data: function() {
                    return JSON.stringify({
                        from_date: moment($('#fromDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD'),
                        end_date: moment($('#endDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD'),
                        kode_barang: $('#kodeBarang').val(),
                        kode_langganan: $('#kodeLangganan').val()
                    });
                },
                complete: function(res) {
                    console.log(res.statusCode);
                    if (res.statusCode != false) {
                        let number = res.responseJSON.total !== null ? formatNumber(res.responseJSON.total) : "";
                        $('#totalFaktur').text(number);
                    }
                },
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            },
            order: [],
            columns: [{
                    data: "nomor_nota",
                    className: "align-middle",
                    width: "80px",
                    responsivePriority: 1,
                    render: function(data, type, row, meta) {
                        // let explode = data.split(',');

                        return `<span class="font-weight-bold text-md">${data.replace(/,/g, '<br/>')}<span>`;
                    }
                },
                {
                    data: "tanggal_nota",
                    className: "align-middle",
                    width: "80px",
                    responsivePriority: 4,
                    render: function(data, type, row, meta) {
                        // let explode = data.split(',');

                        return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                    }
                },
                {
                    data: "kode_langganan",
                    className: "align-middle",
                    width: "100px",
                    responsivePriority: 3
                },
                {
                    data: "nama_langganan",
                    className: "align-middle"
                },
                {
                    data: "kode_barang",
                    className: "align-middle"
                },
                {
                    data: "nama_barang",
                    className: "align-middle"
                },
                {
                    data: "quantity",
                    className: "align-middle text-right",
                    render: function(data, type, row, meta) {
                        return formatNumber(data);
                    }
                },
                {
                    data: "harga_satuan",
                    className: "align-middle text-right",
                    width: "50px",
                    render: function(data, type, row, meta) {
                        return formatNumber(data);
                    }
                },
                {
                    data: "total",
                    className: "align-middle text-right",
                    width: "80px",
                    responsivePriority: 2,
                    render: function(data, type, row, meta) {
                        return formatNumber(data);
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

        $('#filter').click(function() {
            table.clear().draw();
            table.ajax.reload();
        })

        $('#reset').click(function() {
            $('#form').trigger("reset");
            $('#fromDate').val(moment().subtract(0, 'years').startOf('year').format('DD-MM-YYYY'));
            $('#endDate').val(moment(new Date()).format('DD-MM-YYYY'));
            $('.selectpicker').selectpicker('refresh');
        })

    });

    // get Langganan
    function getLangganan() {
        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/accdlgn`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                response.data.data.forEach(element => {
                    // add option
                    $('#kodeLangganan').append('<option value="' + element.kode_langganan + '">' + element.kode_langganan + '</option>')
                });
                // refresh selectpicker
                $('.selectpicker').selectpicker('refresh');
            })
            .catch(function(error) {
                // console.log(error);
            })
    }

    // get Barang
    function getBarang() {
        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/accdbrg`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                response.data.data.forEach(element => {
                    // add option
                    $('#kodeBarang').append('<option value="' + element.kode_barang + '">' + element.nama_barang + '</option>')
                });
                // refresh selectpicker
                $('.selectpicker').selectpicker('refresh');
            })
            .catch(function(error) {
                // console.log(error);
            })
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>