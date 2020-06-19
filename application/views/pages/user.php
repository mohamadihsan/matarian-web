<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (KTP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i> <?= date('d-m-Y') ?></span>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-address-card fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card h-100 ml-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">IDentity Card (NPWP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">80</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-success mr-2"><i class="far fa-calendar"></i> <?= date('d-m-Y') ?></span>
                                <span>last update</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-credit-card fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item">Identity Card</li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?= $title ?></h6>
                    <div class="flex-row-reverse">
                        <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Enable Fixed Header" id="enable" style="display: none"><i class="fas fa-bars"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Disable Fixed Header"  id="disable"><i class="fas fa-ban"></i></button>
                        <button class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Export to Excel" id="exportToExcel"><i class="far fa-file-excel"></i></button>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> New Data</button>
                    </div>
                </div>
                <div class="p-3">
                    <table class="table nowrap table-md text-katapanda-sm" id="katapandaTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table nowrap table-md text-katapanda-sm" id="katapandaTable2">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn</th>
                                <th>Start date</th>
                                <th>Salary</th>
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

    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
    
    // setting dataTables
    $.extend( true, $.fn.dataTable.defaults, {
        responsive: true,
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
        select: {
            style: 'multi'
        }
    } );

    // store data to dataTables 
    let table = $('table.table').DataTable({
        data: data,
        columns: [
            { data: "name" },
            { data: "position" },
            { data: "office" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary" }
        ]
    });

    $('#katapandaTable2').DataTable().search( 'London' ).draw();

    // Button Enable Fixed Header
    $('#enable').on( 'click', function () {
        table.fixedHeader.enable();
        $('#enable').css("display", "none");
        $('#disable').css("display", "");
    } );
 
    // Button Disable Fixed Header
    $('#disable').on( 'click', function () {
        table.fixedHeader.disable();
        $('#enable').css("display", "");
        $('#disable').css("display", "none");
    } );

    // get data after click row
    $('#katapandaTable tbody').on( 'click', 'tr', function () {
        // let data = table.rows(this).data()
        // console.log(data);
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var ids = $.map(table.rows(this).data(), function (item) {
            // alert(JSON.stringify(item))
            console.log(JSON.stringify(item));
        });
        
        $(this).toggleClass('selected');
    } );
    
} );
</script>
