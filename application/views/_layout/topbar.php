<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->
                <?php if (isset($_SESSION['auth']['group'])) {
                    if ($_SESSION['auth']['group'] == 1) { ?>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter" id="countPending"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Pending activation notice
                                </h6>
                                <div id="userPending"></div>
                                <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('users/activation') ?>">Show All</a>
                            </div>
                        </li>

                <?php }
                } ?>

                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= base_url(isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] . '?' . time() : 'assets/upload/picture/boy.png'); ?>" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small"><?= $_SESSION['auth']['fullname'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= site_url('users/profile') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" id="logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Topbar -->


        <script>
            $(document).ready(function() {

                $('#userPending').empty();

                axios({
                        method: `GET`,
                        url: `<?= site_url() ?>api/web/v1/user/activation`,
                        headers: {
                            Authorization: 'Bearer <?= $_SESSION['auth']['token'] ?>'
                        }
                    })
                    .then(function(response) {

                        let count = response.data.data.length;
                        $('#countPending').text(count);

                        response.data.data.forEach(element => {
                            let template = `<a href="<?= site_url('users/activation') ?>" class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-secondary">
                                <i class="fas fa-user-lock text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">${element.created_at}</div>
                            <span class="font-weight-bold">${element.fullname}</span>
                            <div class="small text-gray-500">${element.email}</div>
                        </div>
                    </a>`;

                            $('#userPending').append(template)
                        });
                    })
                    .catch(function(error) {
                        // console.log(error.response.status);
                        if (error.response.status == "401") {
                            tokenExpired(`<?= site_url() ?>`, `<?= $_SESSION['auth']['token'] ?>`)
                        }
                    })

                $('#logout').click(function() {

                    axios({
                            method: `POST`,
                            url: `<?= site_url() ?>api/web/v1/logout`,
                            headers: {
                                Authorization: 'Bearer <?= $_SESSION['auth']['token'] ?>'
                            }
                        })
                        .then(function(response) {
                            window.location.replace('<?= site_url() ?>');
                        })
                        .catch(function(error) {
                            console.log(error);
                        })
                })

            })
        </script>