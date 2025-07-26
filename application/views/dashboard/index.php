<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span id="textFilterBest"></span> <i class="fas fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Select Periode</div>
                <span class="dropdown-item" id="thisMonth">This Month</span>
                <span class="dropdown-item" id="thisYear">This Year</span>
            </div>
        </div>
    </div>
    <div class="row mb-3">

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="row mb-3">

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('accardat/tagihan/klik2') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tagihan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumTagihan" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-danger mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateTagihan"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('users/activation') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Activation</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumPendingActivation" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-warning mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdatePendingActivation"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-lock fa-2x text-warning"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('ktp') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (Ktp)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumKTP" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-primary mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateKTP"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-address-card fa-2x text-primary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('npwp') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Identity Card (NPWP)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumNPWP" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-warning mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateNPWP"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-credit-card fa-2x text-warning"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('report/stock') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">STOCK</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span id="sumACCDBRG" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-secondary mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateACCDBRG"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cubes fa-2x text-secondary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('langganan') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Langganan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumACCDLGN" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-info mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateACCDLGN"></span></span>
                                        <br /><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-address-book fa-2x text-info"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php if (isset($_SESSION['auth']['group'])) {
                    if ($_SESSION['auth']['group'] == 1 || $_SESSION['auth']['group'] == 4) { ?>

                        <div class="col-xl-12 col-lg-12">
                            <div class="card mb-6">
                                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 text-xs font-weight-bold text-uppercase text-success"><i class="fas fa-user-check"></i> <span class="text-secondary">User Login</span></h6>
                                </div>
                                <div class="card-body">
                                    <div id="userLoginList"></div>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>

                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('accarbon') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">ACCARBON</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumACCARBON" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateACCARBON"></span></span>
                                        <br/><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-success"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('accardat') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">ACCARDAT</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumACCARDAT" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-dark mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateACCARDAT"></span></span>
                                        <br/><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-dark"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->

                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<?= site_url('accarbon/filter') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Penjualan Bulan Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="totalPenjualan" class="numbers"></span></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fa fa-calendar"></i> <span id="lastUpdateTotalPenjualan"></span></span>
                                        <br/><span>last update</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-info fa-2x text-success"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->

            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="row mb-3">
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 text-xs text-uppercase font-weight-bold text-primary"><i class="fas fa-box"></i> <span class="text-secondary">Best Seller</span></h6>
                        </div>
                        <div class="card-body">
                            <div id="bestSellerList"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 text-xs text-uppercase font-weight-bold text-info"><i class="fas fa-user-friends"></i> <span class="text-secondary">Best Customer</span></h6>
                        </div>
                        <div class="card-body">
                            <div id="bestBuyerList"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<script>
    $(document).ready(function() {
        // init
        var currentTime = new Date()
        var month = currentTime.getMonth() + 1
        var year = currentTime.getFullYear()

        $('#textFilterBest').text('This Month');
        getData();
        bestSeller(year, month);
        bestBuyer(year, month);
        userLogin();
        // set auto refresh every 5 minutes
        setInterval(userLogin, 300000)

        // this month select
        $('#thisMonth').click(function() {
            $('#textFilterBest').text('This Month');
            bestSeller(year, month);
            bestBuyer(year, month);
        })

        // this year select
        $('#thisYear').click(function() {
            $('#textFilterBest').text('This Year');
            bestSeller(year, null);
            bestBuyer(year, null);
        })

        $.fn.digits = function() {
            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            })
        }
    })

    // get data dashboard
    function getData() {
        $('#sumKTP').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumNPWP').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumACCDBRG').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumACCDLGN').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumACCARBON').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumACCARDAT').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumTagihan').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#totalPenjualan').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $('#sumPendingActivation').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/dashboard`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                // console.log(response);

                $('#sumKTP').text(response.data.data.ktp.total_rows + ' Data');
                $('#lastUpdateKTP').text(moment(response.data.data.ktp.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumNPWP').text(response.data.data.npwp.total_rows + ' Data');
                $('#lastUpdateNPWP').text(moment(response.data.data.npwp.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumACCDBRG').text(response.data.data.accdbrg.total_rows + ' Data');
                $('#lastUpdateACCDBRG').text(moment(response.data.data.accdbrg.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumACCDLGN').text(response.data.data.accdlgn.total_rows + ' Data');
                $('#lastUpdateACCDLGN').text(moment(response.data.data.accdlgn.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumACCARBON').text(response.data.data.accarbon.total_rows + ' Data');
                $('#lastUpdateACCARBON').text(moment(response.data.data.accarbon.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumACCARDAT').text(response.data.data.accardat.total_rows + ' Data');
                $('#lastUpdateACCARDAT').text(moment(response.data.data.accardat.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumTagihan').text(response.data.data.tagihan.total_rows + ' Data');
                $('#lastUpdateTagihan').text(moment(response.data.data.tagihan.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#sumPendingActivation').text(response.data.data.pending_activation.total_rows + ' Data');
                $('#lastUpdatePendingActivation').text(moment(response.data.data.pending_activation.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));
                $('#totalPenjualan').text('Rp.' + response.data.data.penjualan.total_penjualan_bulan_ini);
                $('#lastUpdateTotalPenjualan').text(moment(response.data.data.penjualan.last_update, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss'));

                $("span.numbers").digits();
            })
            .catch(function(error) {
                // console.log(error);
                $('#sumKTP').text('Not Found');
                $('#lastUpdateKTP').text('-');
                $('#sumNPWP').text('Not Found');
                $('#lastUpdateNPWP').text('-');
                $('#sumACCDBRG').text('Not Found');
                $('#lastUpdateACCDBRG').text('-');
                $('#sumACCDLGN').text('Not Found');
                $('#lastUpdateACCDLGN').text('-');
                $('#sumACCARBON').text('Not Found');
                $('#lastUpdateACCARBON').text('-');
                $('#sumACCARDAT').text('Not Found');
                $('#lastUpdateACCARDAT').text('-');
                $('#sumTagihan').text('Not Found');
                $('#lastUpdateTagihan').text('-');
                $('#sumPendingActivation').text('Not Found');
                $('#lastUpdatePendingActivation').text('-');
                $('#totalPenjualan').text('Not Found');
                $('#lastUpdateTotalPenjualan').text('-');
            })
    }

    function bestSeller(year = null, month = null) {

        $('#bestSellerList').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

        year = year !== null ? year : '0000';
        month = month !== null ? month : '00';

        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/dashboard/best-seller/year/${year}/month/${month}/limit/10`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {

                $('#bestSellerList').empty();
                let no = 1;

                if (response.data.data.length > 0) {
                    response.data.data.forEach(element => {
                        // console.log(element);
                        $('#bestSellerList').append(`<div class="mb-3">
                    <div class="small text-dark-500 font-weight-bold">${no++}. ${element.kode_barang}
                        <span class="h6 float-right"><b>${formatNumber(element.quantity)}</b></span>
                    </div>
                    <div class="small text-gray-500 font-weight-light">${element.nama_barang}
                    </div>
                </div>`);
                    });
                } else {
                    $('#bestSellerList').append(`<div class=""><i class="fas fa-info-circle text-danger"></i> No Transactions</div>`);
                }

            })
            .catch(function(error) {
                // console.log(error);
                $('#bestSellerList').text('Not Found');
            })
    }

    function bestBuyer(year = null, month = null) {

        $('#bestBuyerList').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

        year = year !== null ? year : '0000';
        month = month !== null ? month : '00';

        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/dashboard/best-buyer/year/${year}/month/${month}/limit/10`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {

                $('#bestBuyerList').empty();
                let no = 1;

                if (response.data.data.length > 0) {
                    response.data.data.forEach(element => {
                        // console.log(element);
                        $('#bestBuyerList').append(`<div class="mb-3">
                    <div class="small text-dark-500 font-weight-bold">${no++}. ${element.kode_langganan}
                        <span class="h6 float-right"><b>${formatNumber(element.total_purchase)}</b></span>
                    </div>
                    <div class="small text-gray-500 font-weight-light">${element.nama_toko}
                    </div>
                </div>`);
                    });
                } else {
                    $('#bestBuyerList').append(`<div class=""><i class="fas fa-info-circle text-danger"></i> No Transactions</div>`);
                }

            })
            .catch(function(error) {
                // console.log(error);
                $('#bestBuyerList').text('Not Found');
            })
    }

    function userLogin() {

        $('#userLoginList').html(`<div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);

        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/dashboard/user-login/limit/0`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {

                $('#userLoginList').empty();
                let countUserLogin = 0;
                let ipAddress = "";

                if (response.data.data.length > 0) {
                    response.data.data.forEach(element => {
                        // console.log(element);

                        if (element.logout_at == null) {
                            countUserLogin++;

                            ipAddress = element.ip_address_var !== null ? `: ${element.ip_address_var}` : "";

                            $('#userLoginList').append(`<div class="mb-3">
                    <div class="h6 text-dark-500 font-weight-bold">${countUserLogin}. ${element.fullname} <span class="font-weight-light">(${element.user_group_name})</span>
                        <span class="small float-right text-secondary">login at:<br/> <b>${moment(element.login_at, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY HH:mm:ss')}</br></span>
                    </div>
                    <div class="small text-gray-500 font-weight-light">${element.device_type} ${ipAddress}</div>
                </div>`);
                        }
                    });

                    if (countUserLogin == 0) {
                        $('#userLoginList').append(`<div class=""><i class="fas fa-info-circle text-danger"></i> No User Login</div>`);
                    }
                } else {
                    $('#userLoginList').append(`<div class=""><i class="fas fa-info-circle text-danger"></i> No User Login</div>`);
                }

            })
            .catch(function(error) {
                // console.log(error);
                $('#userLoginList').text('Not Found');
            })
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>