<!-- Login Content -->
<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-header pt-4 text-center">
                    <h1 class="h4 text-gray-900 mb-0 card-title">
                        <strong class="text-custom"> <?= $title ?> </strong>
                        <img src="<?= base_url('assets/'); ?>img/logo/logo-dark.png" alt="logo" width="40px"> 
                        <?= SITE_NAME ?>
                    </h1>
                    <hr />
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <!-- <img src="<?= base_url('assets/'); ?>img/logo/logo.jpg" style="max-height: 80px;" class="mb-3"> -->
                                    <!-- <h1 class="h4 text-gray-900 mb-4">Login CMP Panel</h1> -->
                                </div>
                                <form class="loginForm" id="loginForm">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Username *">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password *">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                            <input type="checkbox" name="rememberMe" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-custom btn-block">Login</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <a class="font-weight-bold small" href="<?= site_url('register') ?>">Create an Account!</a>
                                    </div>
                                    <div class="p-2">
                                        <a class="font-weight-bold small" href="<?= site_url('resetpassword') ?>">Forgot Password?</a>
                                    </div>
                                </div>    
                                <div class="d-flex justify-content-center">
                                    <span class="text-xs text-gray-600" id="version-katapanda"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Content -->

<script>

    $().ready(function() {

        // input focus
        $('#username').focus();

        $("#loginForm").validate({
			rules: {
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				}
            },
            submitHandler: function(form) {
                // start loading
                loadingStart()
                
                // bind data
                let data = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    remember_me: $('#rememberMe:checked').val() === 'on' ? true : false,
                    device_type: navigator.appVersion,
                    ip_address: null
                }
                console.log(data);
                
                // send request
                axios.post('/api/web/v1/login', data)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    let messageError;
                    let err = error.response;

                    if (err.status === 404) {
                        messageError = 'Request Failed. Please check your connection!';
                    } else {
                        messageError = err.statusText;
                    }
                    
                    // show message
                    notification('login', 'error', messageError);
                })
                .then(function () {
                    // stop loading
                    loadingStop()
                })
            }
		})
    })

</script>