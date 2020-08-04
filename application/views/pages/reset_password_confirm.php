<!-- Login Content -->
<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9" style="max-width: 500px">
            <div class="card shadow-sm my-5">
                <div class="card-header pt-4 text-center">
                    <h1 class="h4 text-gray-900 mb-0 card-title">
                        <strong class="text-custom"> <?= $title ?> </strong>
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
                                <form class="resetPasswordForm" id="resetPasswordForm">
                                    <div class="form-group">
                                        <label>New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="**********">
                                    </div>
                                    <div class="form-group">
                                        <label>Repeat Password <span class="text-danger">*</span></label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="**********">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-custom btn-block">Reset</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <a class="font-weight-bold small" href="<?= site_url('login') ?>">Back to Login Page...</a>
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
        $('#password').focus();

        $("#resetPasswordForm").validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
			},
			messages: {
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
            },
            submitHandler: function(form) {
                // start loading
                loadingStart()
                
                // bind data
                let data = {
                    id: <?= $id ?>,
                    password: $('#password').val()
                }
                
                // send request
                axios.post('<?= site_url() ?>api/web/v1/reset-password/confirm', data)
                .then(function (response) {
                    // console.log(response);
                    let status = response.data.status;
                    let message = response.data.message;
                    let action = `update`;
                    if (status) {
                        // show message
                        notification(action, 'info', message);
                        $('#resetPasswordForm').trigger("reset");
                    }else{
                        // show message
                        notification(action, 'error', message);
                    }
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
                    notification('forgot', 'error', messageError);
                })
                .then(function () {
                    // stop loading
                    loadingStop()
                })
            }
		})
    })

</script>