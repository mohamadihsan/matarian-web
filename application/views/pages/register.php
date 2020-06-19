<!-- Register Content -->
<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-header bg-custom text-center">
                    <h1 class="h4 text-white mb-0 card-title"><i class="fa fa-user"></i> Form Register</h1>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                
                                <form id="registerForm">
                                    <div class="form-group">
                                        <label>Fullname <span class="text-danger">*</span></label>
                                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Fullname">
                                    </div>
                                    <div class="form-group">
                                        <label>Nickname <span class="text-danger">*</span></label>
                                        <input type="text" name="nickname" class="form-control" id="nickname" placeholder="Enter Nickname">
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Repeat Password <span class="text-danger">*</span></label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Repeat Password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-custom btn-block">Register</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <a class="font-weight-bold small" href="<?= site_url('login') ?>">Already have an account?</a>
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
<!-- Register Content -->

<script>
    $().ready(function() {
        
        $("#registerForm").validate({
			rules: {
				fullname: "required",
				nickname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				fullname: "Please enter your fullname",
				nickname: "Please enter your nickname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address"
			},
            submitHandler: function(form) {
                // start loading
                loadingStart()

                // bind data
                let data = {
                    username: $('#username').val(),
                    password: $('#password').val()
                }
                // send request
                axios.post('/api/web/v1/register', data)
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