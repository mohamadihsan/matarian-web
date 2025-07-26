<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Back to Previous Page" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i></button>
                    <h6 class="m-0 font-weight-bold text-dark"><?= SITE_NAME . ' - ' . $title ?></h6>
                    <div class="flex-row-reverse">
                        <!-- <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Enable Fixed Header" id="enable" style="display: none"><i class="fas fa-bars"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Disable Fixed Header"  id="disable"><i class="fas fa-ban"></i></button> -->
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <div id="dataLangganan"></div>
                    <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Nota</th>
                                <th>Tanggal Nota</th>
                                <th class="text-right">DPP</th>
                                <th class="text-right">PPn</th>
                                <th class="text-right">Nilai Nota</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th colspan="5" class="text-center">TOTAL</th>
                                <th class="text-right" id="totalNota"></th>
                                <th class="text-center"></th>
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

        // button action by user role 
        actionExportToExcel ? buttonAction.push({
            extend: 'excelHtml5',
            exportOptions: {
                format: {
                    body: function(data, row, column, node) {
                        if (column === 6) {
                            data = '';
                        } else if (column === 3 || column === 4 || column === 5) {
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
                doc.styles.tableHeader.alignment = 'right';
                doc.pageMargins = [20, 60, 20, 30];
                doc.content[1].table.widths = ['5%', '15%', '35%', '15%', '15%', '15%', '0%'];
                var rowCount = doc.content[1].table.body.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'right';
                    doc.content[1].table.body[i][1].alignment = 'right';
                    doc.content[1].table.body[i][2].alignment = 'right';
                    doc.content[1].table.body[i][3].alignment = 'right';
                    doc.content[1].table.body[i][4].alignment = 'right';
                    doc.content[1].table.body[i][5].alignment = 'right';
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

        actionExportToPdf ? buttonAction.push({ // button export to pdf
            text: 'PDF Custom',
            action: function(e, dt, node, config) {
                window.open(`${window.location.href}/export`, '_blank');
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
        let no = 1;
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#katapandaTable').DataTable({
            processing: true,
            ajax: { // array
                url: '<?= site_url() ?>api/web/v1/accardat/tagihan/nota',
                contentType: "application/json",
                type: "POST",
                data: function() {
                    return JSON.stringify({
                        from_date: `<?= $from_date ?>`,
                        end_date: `<?= $end_date ?>`,
                        sales_ar: `<?= $sales_ar ?>`,
                        kode_ar: `<?= $kode_langganan ?>`
                    });
                },
                complete: function(res) {
                    let number = res.responseJSON.total !== null ? formatNumber(res.responseJSON.total) : "";
                    $('#totalNota').text(number);

                    no = 1;
                },
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            },
            order: [],
            columns: [{
                    data: "id",
                    className: "align-middle",
                    responsivePriority: 1,
                    width: "10px",
                    render: function(data, type, row, meta) {
                        return no++;
                    }
                },
                {
                    data: "nomor_nota",
                    className: "align-middle"
                },
                {
                    data: "tanggal_nota",
                    className: "align-middle",
                    responsivePriority: 1,
                    render: function(data, type, row, meta) {
                        let date = data !== null ? moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY') : 0;
                        return date;
                    }
                },
                {
                    data: "dpp",
                    className: "align-middle text-right",
                    responsivePriority: 3,
                    render: function(data, type, row, meta) {
                        if (row.nomor_nota == 'BAYAR' || row.nomor_nota == 'LEBIH' || row.nomor_nota == 'TITIP') {
                            return '-';
                        } else {
                            let number = data !== null ? formatNumber(data) : 0;
                            return number;
                        }
                    }
                },
                {
                    data: "ppn",
                    className: "align-middle text-right",
                    responsivePriority: 4,
                    render: function(data, type, row, meta) {
                        if (row.nomor_nota == 'BAYAR' || row.nomor_nota == 'LEBIH' || row.nomor_nota == 'TITIP') {
                            return '-';
                        } else {
                            let number = data !== null ? formatNumber(data) : 0;
                            return number;
                        }
                    }
                },
                {
                    data: "nilai_nota",
                    className: "align-middle text-right",
                    responsivePriority: 5,
                    render: function(data, type, row, meta) {
                        let number = data !== null ? formatNumber(data) : 0;
                        return number;
                    }
                },
                {
                    data: "nomor_nota",
                    className: "align-middle text-center",
                    responsivePriority: 2,
                    width: "5%",
                    render: function(data, type, row, meta) {

                        $('#dataLangganan').html(`<p class="font-weight-bolder text-dark text-left mb-0">${row.nama_langganan} <span class="font-weight-lighter"></span></p>
                                        <p class="font-weight-bolder text-dark text-left mb-3">${row.alamat_langganan} <span class="font-weight-lighter"></span></p>`)
                        let action = `<div class="btn-group">
                        <a href="<?= site_url('accardat/tagihan/klik4/') ?>${data}" class="btn btn-sm btn-outline-info detail" data-toggle="tooltip" data-placement="top" title="Nota">
                            <i class="fas fa-file-invoice"></i></a>
                    </div>`;
                        return action;
                    }
                },
            ],
            language: {
                loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
                processing: `<p class="font-weight-bold text-primary">Collecting Tagihan...</p>`
            }
        }).columns.adjust();

        $('#filter').click(function() {
            table.clear().draw();
            table.ajax.reload();
        })

        $('#reset').click(function() {
            $('#form').trigger("reset");
            $('.selectpicker').selectpicker('refresh');
        })

    });

    function goBack() {
        // window.history.back();
        window.close();
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>