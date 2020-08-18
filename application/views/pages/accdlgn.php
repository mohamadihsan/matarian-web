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
                    <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-left">Kode Langganan</th>
                                <th class="text-left">Nama Langganan</th>
                                <th class="text-left">Alamat</th>
                                <th class="text-left">Kota</th>
                                <th class="text-left">Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th class="text-left">Kode Langganan</th>
                                <th class="text-left">Nama Langganan</th>
                                <th class="text-left">Alamat</th>
                                <th class="text-left">Kota</th>
                                <th class="text-left">Nomor Telepon</th>
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
                doc.content[1].table.widths = ['15%', '30%', '30%', '15%', '15%'];
                var rowCount = doc.content[1].table.body.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'left';
                    doc.content[1].table.body[i][1].alignment = 'left';
                    doc.content[1].table.body[i][2].alignment = 'left';
                    doc.content[1].table.body[i][3].alignment = 'left';
                    doc.content[1].table.body[i][4].alignment = 'left';
                }
                doc['footer'] = (function(page, pages) {
                    return {
                        columns: [
                            'exported at ' + moment(new Date()).format('YYYY-MM-DD hh:mm:ss'),
                            {
                                alignment: 'right',
                                text: ['page ', {
                                    text: page.toString()
                                }, ' of ', {
                                    text: pages.toString()
                                }]
                            }
                        ],
                        margin: [20, 10]
                    }
                });
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
                url: '<?= site_url() ?>api/web/v1/accdlgn',
                contentType: "application/json",
                type: "GET",
                data: function() {},
                complete: function(res) {
                    // console.log(res.statusCode);
                },
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            },
            columns: [{
                    data: "kode_langganan",
                    className: "align-middle",
                    responsivePriority: 1
                },
                {
                    data: "nama_toko",
                    className: "align-middle",
                    responsivePriority: 2
                },
                {
                    data: "alamat",
                    className: "align-middle"
                },
                {
                    data: "kota",
                    className: "align-middle"
                },
                {
                    data: "telepon",
                    className: "align-middle"
                }
            ],
            language: {
                loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
                processing: `<p class="font-weight-bold text-primary">Please wait...</p>`
            }
        }).columns.adjust();

    });

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>