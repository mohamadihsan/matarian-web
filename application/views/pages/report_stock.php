
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    
    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?= $title ?> <span id="lastUpdate"></span></h6>
                    <div class="flex-row-reverse">
                        <!-- <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Enable Fixed Header" id="enable" style="display: none"><i class="fas fa-bars"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Disable Fixed Header"  id="disable"><i class="fas fa-ban"></i></button> -->
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="label-katapanda-sm" for="kodeBarang">By Barang</label>
                            <select name="kodeBarang" id="kodeBarang" class="selectpicker form-control form-control-sm" data-live-search="true" title="Choose">
                                <option value="" selected>All Barang</option>
                                <option data-divider="true"></option>
                            </select>
                        </div> 
                        <div class="form-group col-md-3">
                            <label class="label-katapanda-sm text-white" for="kodeBarang">By Barang</label>
                            <div class="button-group">
                                <button class="btn btn-sm btn-primary" id="filter"><i class="fas fa-filter"></i> Filter Barang</button>
                            </div>
                        </div> 
                    </div>  
                    <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-right">Satuan</th>
                                <th class="text-right">A</th>
                                <th class="text-right">B</th>
                                <th class="text-right">C</th>
                                <th class="text-right">D</th>
                                <th class="text-right">E</th>
                                <th class="text-right">F</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-right">Satuan</th>
                                <th class="text-right">A</th>
                                <th class="text-right">B</th>
                                <th class="text-right">C</th>
                                <th class="text-right">D</th>
                                <th class="text-right">E</th>
                                <th class="text-right">F</th>
                                <th class="text-right">Total</th>
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

$(document).ready( function () {
    
    // init variable
    let id = null;
    let actionExportToExcel = <?php echo $action_export_to_excel != '' ? 1 : 0; ?>;
    let actionExportToCsv = <?php echo $action_export_to_csv != '' ? 1 : 0; ?>;
    let actionExportToPdf = <?php echo $action_export_to_pdf != '' ? 1 : 0; ?>;
    
    // button default for action datatables
    let buttonAction = ['copyHtml5']; // add button to copy data

    // store to select
    getBarang();

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
        customize: function (doc) {
            doc.defaultStyle.fontSize = 6;
            doc.styles.tableHeader.fontSize = 7;
            doc.styles.tableFooter.fontSize = 7;
            doc.styles.tableHeader.alignment = 'center';
            doc.pageMargins = [20,60,20,30];
            doc.content[1].table.widths = [ '5%', '15%', '35%', '10%', '5%', '5%', '5%', '5%', '5%', '5%', '5%' ];
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'center';
                doc.content[1].table.body[i][1].alignment = 'left';
                doc.content[1].table.body[i][2].alignment = 'left';
                doc.content[1].table.body[i][3].alignment = 'center';
                doc.content[1].table.body[i][4].alignment = 'right';
                doc.content[1].table.body[i][5].alignment = 'right';
                doc.content[1].table.body[i][6].alignment = 'right';
                doc.content[1].table.body[i][7].alignment = 'right';
                doc.content[1].table.body[i][8].alignment = 'right';
                doc.content[1].table.body[i][9].alignment = 'right';
                doc.content[1].table.body[i][10].alignment = 'right';
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
    let no = 1;
    var table = $('#katapandaTable').DataTable({
        processing: true,
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/report/stock',
            contentType: "application/json",
            type: "POST",
            data: function () {
                return JSON.stringify({
                    kode_barang: $('#kodeBarang').val() 
                });
            },
            complete: function(res) {
                no = 1;
            },
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        columns: [
            { data: "id", className: "align-middle text-right", orderable: false, searchable: false, render : function ( data, type, row, meta ) {
                return no++;
            }},
            { data: "kode_barang", className: "align-middle font-weight-bold" },
            { data: "nama_barang", className: "align-middle font-weight-bold", responsivePriority: 1 },
            { data: "satuan", className: "align-middle text-center" },
            { data: "gudang_a", className: "align-middle text-right", responsivePriority: 3, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "gudang_b", className: "align-middle text-right", responsivePriority: 4, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "gudang_c", className: "align-middle text-right", responsivePriority: 5, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "gudang_d", className: "align-middle text-right", responsivePriority: 6, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "gudang_e", className: "align-middle text-right", responsivePriority: 7, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "gudang_f", className: "align-middle text-right", responsivePriority: 8, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "jumlah_stok", className: "align-middle text-right font-weight-bold", responsivePriority: 2, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return `<span class="font-weight-bold">${number}</span>`;
            }},
        ],
        language: {
            loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
            processing: `<p class="font-weight-bold text-primary">Gathering Stock...</p>`
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

// get Barang
function getBarang() {
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/accdbrg`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kodeBarang').append('<option value="'+element.kode_barang+'">'+element.nama_barang+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');

        if (response.data.last_update !== null) {
            $('#lastUpdate').html(` <span class="font-weight-lighter text-sm text-primary">(Updated: ${moment(response.data.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss')})</span>`);
        }
        
    })
    .catch(function (error) {
        // console.log(error);
    })
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
</script>
