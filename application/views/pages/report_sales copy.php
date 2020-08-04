
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
                                <input type="date" name="fromDate" class="form-control form-control-sm" id="fromDate">
                            </div>  
                            <div class="form-group col-md-3">
                                <label class="label-katapanda-sm" for="endDate">To Date</label>
                                <input type="date" name="endDate" class="form-control form-control-sm" id="endDate">
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
                                <th class="text-center">Nama Langganan</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-right">Jumlah Nota</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th class="text-center">Nama Langganan</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-right">Jumlah Nota</th>
                                <th class="text-right">Quantity</th>
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
    getLangganan();
    getBarang();

    // button action by user role 
    actionExportToExcel ? buttonAction.push('excelHtml5') : ''; // button export to excel 
    actionExportToCsv ? buttonAction.push('csvHtml5') : ''; // button export to csv
    actionExportToPdf ? buttonAction.push('pdfHtml5') : ''; // button export to pdf

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
    var table = $('#katapandaTable').DataTable({
        processing: true,
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/report/sales',
            contentType: "application/json",
            type: "POST",
            data: function () {
                return JSON.stringify({
                    from_date: $('#fromDate').val(),
                    end_date: $('#endDate').val(),
                    kode_barang: $('#kodeBarang').val(),
                    kode_langganan: $('#kodeLangganan').val() 
                });
            },
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        columns: [
            { data: "nama_langganan", className: "align-middle", responsivePriority: 1 },
            { data: "nama_barang", className: "align-middle" },
            { data: "jumlah_transaksi", className: "align-middle text-right", render : function ( data, type, row, meta ) {
                return formatNumber(data);
            }},
            { data: "quantity", className: "align-middle text-right", render : function ( data, type, row, meta ) {
                return formatNumber(data);
            }},
            { data: "total", className: "align-middle text-right", render : function ( data, type, row, meta ) {
                return formatNumber(data);
            }},
        ],
        language: {
            loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
            processing: `<p class="font-weight-bold text-primary">Generating Report...</p>`
        }
    });

    $('#filter').click(function() {
        table.clear().draw();
        table.ajax.reload();
    })

    $('#reset').click(function() {
        $('#form').trigger("reset");
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
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kodeLangganan').append('<option value="'+element.kode_langganan+'">'+element.nama_toko+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
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
    .then(function (response) {
        response.data.data.forEach(element => {
            // add option
            $('#kodeBarang').append('<option value="'+element.kode_barang+'">'+element.nama_barang+'</option>')
        });
        // refresh selectpicker
        $('.selectpicker').selectpicker('refresh');
    })
    .catch(function (error) {
        // console.log(error);
    })
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
</script>
