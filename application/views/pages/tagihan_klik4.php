
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
                    <div id="dataNota"></div>
                    <table class="table table-striped table-bordered table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th colspan="5" class="text-right"></th>
                                <th class="text-right"></th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right" style="border-bottom: 0; border-top: 0">Dasar Pengenaan Pajak</th>
                                <th class="text-right" id="dpp" style="border-bottom: 0; border-top: 0">></th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right" style="border-bottom: 0; border-top: 0">PPn (10%)</th>
                                <th class="text-right" id="ppn" style="border-bottom: 0; border-top: 0">></th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right" style="border-bottom: 0; border-top: 0">Total</th>
                                <th class="text-right" id="total" style="border-bottom: 0; border-top: 0">></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="footerTagihan"></div>
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
    let namaLangganan = '';
    let kotaLangganan = '';
    let nomorNota = '';
    let tanggalNota = '';
    let dpp = '';
    let ppn = '';
    let total = '';
    let actionExportToExcel = <?php echo $action_export_to_excel != '' ? 1 : 0; ?>;
    let actionExportToCsv = <?php echo $action_export_to_csv != '' ? 1 : 0; ?>;
    let actionExportToPdf = <?php echo $action_export_to_pdf != '' ? 1 : 0; ?>;
    
    // button default for action datatables
    let buttonAction = ['copyHtml5']; // add button to copy data

    // button action by user role 
    actionExportToExcel ? buttonAction.push({
        extend: 'excelHtml5',
        exportOptions: {
            format: {
                body: function (data, row, column, node ) {
                    if (column === 4 || column === 5) {
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
        customize: function (doc) {
            doc.watermark = {text: 'Belum Lunas', color: 'blue', opacity: 0.1};
            doc.defaultStyle.fontSize = 9;
            doc.styles.tableHeader.fontSize = 9;
            doc.styles.tableFooter.fontSize = 9;
            doc.styles.tableHeader.alignment = 'center';
            doc.pageMargins = [20,60,20,30];
            doc.content[1].table.widths = [ '5%', '15%', '35%', '10%', '15%', '20%' ];
            var rowCount = doc.content[1].table.body.length;
            for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'center';
                doc.content[1].table.body[i][1].alignment = 'left';
                doc.content[1].table.body[i][2].alignment = 'left';
                doc.content[1].table.body[i][3].alignment = 'right';
                doc.content[1].table.body[i][4].alignment = 'right';
                doc.content[1].table.body[i][5].alignment = 'right';
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
            doc.content.splice(1, 0, 
                {
                    text: [
                        {
                            text: `${namaLangganan} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'right'
                        }, 
                        {
                            text: `${kotaLangganan} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'right'
                        }, 
                        {
                            text: `No.Nota : ${nomorNota} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'left'
                        },
                        {
                            text: `Tgl.Nota : ${tanggalNota} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'left'
                        },
                        {
                            text: `Dasar Pengenaan Pajak :\t ${dpp} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'right'
                        },
                        {
                            text: `PPn :\t ${ppn} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'right'
                        },
                        {
                            text: `Total :\t ${total} \n`,
                            bold: true,
                            fontSize: 10,
                            alignment: 'right'
                        } 
                    ],
                    margin: [0, 0, 0, 10]
                }
            );
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
            footer: false
        },
        language: {
            lengthMenu: "Display _MENU_ records per page",
            zeroRecords: "Nothing found - sorry",
            info: "Showing page _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)"
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 50,
        dom: 'lBfrtip',
        buttons: buttonAction
    } );
    
    // store data to dataTables 
    let no = 1;
    $.fn.dataTable.ext.errMode = 'none';
    var table = $('#katapandaTable').DataTable({
        processing: true,
        ajax: { // array
            url: '<?= site_url() ?>api/web/v1/accardat/tagihan/nota/detail',
            contentType: "application/json",
            type: "POST",
            data: function () {
                return JSON.stringify({
                    nomor_nota: `<?= $nomor_nota ?>` 
                });
            },
            complete: function(res) {
                dpp = res.responseJSON.dpp !== null ? formatNumber(res.responseJSON.dpp) : "";
                ppn = res.responseJSON.ppn !== null ? formatNumber(Math.ceil(res.responseJSON.ppn)) : "";
                total = res.responseJSON.total !== null ? formatNumber(Math.ceil(res.responseJSON.total)) : "";
                // $('#footerTagihan').html(`<p class="font-weight-bolder text-dark text-right mt-5 mb-0"><span class="font-weight-lighter text-muted">Dasar Pengenaan Pajak</span> : ${dpp}</p>
                //             <p class="font-weight-bolder text-dark text-right mb-0"><span class="font-weight-lighter text-muted">PPn (10%)</span> : ${ppn}</p>
                //             <p class="font-weight-bolder text-dark text-right mb-0"><span class="font-weight-lighter text-muted">Total</span> : ${total}</p>`);
               $('#dpp').text(dpp);
               $('#ppn').text(ppn);
               $('#total').text(total);
                        
               no = 1;
            },
            headers: {
                Authorization: 'Bearer <?= $token ?>' 
            }
        },
        columns: [
            { data: "kode_barang", className: "align-middle text-right", width: "10px", render : function ( data, type, row, meta ) {
                return no++;
            }},
            { data: "kode_barang", className: "align-middle", responsivePriority: 1 },
            { data: "nama_barang", className: "align-middle" },
            { data: "quantity", className: "align-middle text-right", responsivePriority: 3, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "harga_satuan", className: "align-middle text-right", responsivePriority: 4, render : function ( data, type, row, meta ) {
                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }},
            { data: "jumlah", className: "align-middle text-right", responsivePriority: 2, render : function ( data, type, row, meta ) {
                
                namaLangganan = row.nama_langganan;
                kotaLangganan = row.alamat_langganan;
                nomorNota = row.nomor_nota;
                tanggalNota = moment(row.tanggal_nota, 'YYYY-MM-DD').format('DD-MM-YYYY');
                $('#dataLangganan').html(`<p class="font-weight-bolder text-dark text-right mb-0">${row.nama_langganan} </p>
                                        <p class="font-weight-bolder text-dark text-right mb-0">${row.alamat_langganan} </p>`)
                $('#dataNota').html(`<p class="font-weight-bolder text-dark text-left mb-0"><span class="font-weight-lighter text-muted">No. Nota</span> : ${row.nomor_nota}</p>
                <p class="font-weight-bolder text-dark text-left mb-3"><span class="font-weight-lighter text-muted">Tgl. Nota</span> : ${moment(row.tanggal_nota, 'YYYY-MM-DD').format('DD-MM-YYYY')}</p>`)

                let number = data !== null ? formatNumber(data) : 0;
                return number;
            }}
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
    window.history.back();
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
</script>
