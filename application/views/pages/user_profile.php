<link rel="stylesheet" href="<?= base_url('assets/css/katapanda_profile.css') ?>">

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8">
                <div class="profile-user-box card-box bg-custom">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-light waves-effect" id="changePassword"><i class="fas fa-key"></i> Change Password</button>
                                <button type="button" class="btn btn-sm btn-light waves-effect" id="updateProfile"><i class="fas fa-edit"></i> Update Profile</button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="media-body text-white">
                                <!-- <h4 class="mt-1 mb-1 font-18"><span class="fullname"></span></h4>
                                <p class="font-13 text-light"><span class="email"></span></p>
                                <p class="text-light mb-0"><span class="userGroupName"></span></p> -->
                                <h4 class="mt-1 mb-4 ml-2 font-18">User Profile</h4>
                                <!-- <span class="float-right ml-3"><img src="<?= base_url('assets/img/boy.png') ?>" alt="" class="thumb-lg rounded-circle"></span> -->
                                <img src="<?= base_url('assets/img/boy.png') ?>" alt="" class="d-none d-sm-block" style="float: right; width: 150px; padding-right: 1%">
                                <dl class="row">
                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Fullname</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="fullname"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Phone</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="nomorTelepon"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Email</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="email"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Sales AR</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="salesAR"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Username</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="username"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Privilege</dt>
                                    <dd class="col-sm-8 font-weight-light text-uppercase"><span class="userGroupName"></span></dd>

                                    <dt class="col-sm-4 font-weight-bold mb-2 ">Active Since</dt>
                                    <dd class="col-sm-8 font-weight-light"><span class="activationAt"></span></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Change Password -->
<div class="modal fade" id="formKatapandaChangePassword" tabindex="-1" role="dialog" aria-labelledby="formKatapandaChangePasswordTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formChangePassword">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="formTitleChangePassword"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="**********">
                    </div>
                    <hr />
                    <div class="form-group">
                        <label>New Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="**********">
                    </div>
                    <div class="form-group">
                        <label>Repeat Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="**********">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <!-- <button type="button" class="btn btn-secondary" id="btnResetFormInput">Reset Form</button> -->
                    <button type="submit" class="btn bg-custom" id="btnSubmitChangePassword"></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Form Update Profile -->
<div class="modal fade" id="formKatapanda" tabindex="-1" role="dialog" aria-labelledby="formKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="formTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="label-katapanda-sm" for="fullname">Fullname <i class="text-danger">*</i></label>
                        <input type="text" name="fullname" class="form-control form-control-sm" id="fullname" placeholder="">
                    </div>

                    <div class="form-group">
                        <label class="label-katapanda-sm" for="nomorTelepon">Nomor Telepon</label>
                        <input type="text" name="nomorTelepon" class="form-control form-control-sm" id="nomorTelepon" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="label-katapanda-sm" for="email">Email <i class="text-danger">*</i></label>
                        <input type="email" name="email" class="form-control form-control-sm" id="email" placeholder="">
                    </div>

                    <div class="file-input">
                        <input class="choose" type="file" name="profilePicture" id="profilePicture" accept="image/*">
                        <span class="button">Choose Profile Picture</span>
                        <span class="label">No profile picture selected</span>
                    </div>
                    <img id="preview" src="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <!-- <button type="button" class="btn btn-secondary" id="btnResetFormInput">Reset Form</button> -->
                    <button type="submit" class="btn bg-custom" id="btnSubmit"></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        // init variable
        let id = null;

        // init function
        getProfile();

        // validate and request add new data and update existing data 
        $("#formChangePassword").validate({
            rules: {
                oldPassword: {
                    required: true,
                    minlength: 5
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
            },
            messages: {
                oldPassword: {
                    required: "Please provide a current password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password: {
                    required: "Please provide a new password",
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

                // send request
                axios({
                        method: `PUT`,
                        url: '<?= site_url() ?>api/web/v1/profile/change-password',
                        headers: {
                            Authorization: 'Bearer <?= $token ?>'
                        },
                        data: {
                            username: "<?= $username ?>",
                            old_password: $('#oldPassword').val(),
                            password: $('#password').val()
                        }
                    })
                    .then(function(response) {
                        // console.log(response);
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = `update`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            $('#formKatapandaChangePassword').modal('hide');
                            $('#formChangePassword').trigger("reset");
                        } else {
                            // show message
                            notification(action, 'error', message);
                        }
                    })
                    .catch(function(error) {
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
                    .then(function() {
                        // stop loading
                        loadingStop()
                    })
            }
        })

        // update profile
        $("#form").validate({
            rules: {
                fullname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                fullname: "Please enter your fullname",
                email: "Please enter a valid email address"
            },
            submitHandler: function(form) {
                // start loading
                loadingStart()
                let picture = new FormData();
                picture.append('profile_picture', $('#profilePicture')[0].files[0]);
                // send request
                axios({
                        method: `PUT`,
                        url: '<?= site_url() ?>api/web/v1/profile/update',
                        headers: {
                            Authorization: 'Bearer <?= $token ?>',
                            // contentType: false,
                            'Content-Type': 'multipart/form-data'
                        },
                        data: {
                            username: "<?= $username ?>",
                            fullname: $('#fullname').val(),
                            nomor_telepon: $('#nomorTelepon').val(),
                            email: $('#email').val(),
                            profile_picture: picture
                        }
                    })
                    .then(function(response) {
                        // console.log(response);
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = `update`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            getProfile();
                            $('#formKatapanda').modal('hide');
                            $('#formKatapanda').trigger("reset");
                        } else {
                            // show message
                            notification(action, 'error', 'Username or Email already exists');
                        }
                    })
                    .catch(function(error) {
                        let messageError;
                        let err = error.response;

                        if (err.status === 404) {
                            messageError = 'Request Failed. Please check your connection!';
                        } else {
                            messageError = err.statusText;
                        }

                        // show message
                        notification('update', 'error', messageError);
                    })
                    .then(function() {
                        // stop loading
                        loadingStop()
                    })
            }
        })

        // modal form update profile  
        $('#updateProfile').click(function() {
            // reset Form
            resetFormInput();
            $('#preview').attr('src', '')
            $('.label').text('')

            // show modal
            $('#formTitle').html('<i class="fas fa-edit"></i> Update Profile');
            $('#btnSubmit').text('Update');
            $('#formKatapanda').modal({
                backdrop: 'static'
            }, 'show')
            $('#btnResetFormInput').css("display", "");

            getProfile();
        })

        // modal form change password  
        $('#changePassword').click(function() {
            // reset Form
            resetFormInput();

            // show modal
            $('#formTitleChangePassword').html('<i class="fas fa-key"></i> Change Password');
            $('#btnSubmitChangePassword').text('Change');
            $('#formKatapandaChangePassword').modal({
                backdrop: 'static'
            }, 'show')
            $('#btnResetFormInput').css("display", "");
        })

        // button reset Form Input
        $('#btnResetFormInput').click(function() {
            // reset Form Input
            resetFormInput();
        })

        $.fn.digits = function() {
            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            })
        }

    });

    // reset Form
    function resetFormInput() {
        $('#form').trigger("reset");
    }

    function getProfile() {
        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/profile`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                // console.log(response);
                let data = response.data.data[0];
                $('.fullname').html(data.fullname);
                $('.email').html(data.email);
                $('.userGroupName').html(data.user_group_name);
                $('.nomorTelepon').html(data.nomor_telepon);
                $('.salesAR').html(data.sales_ar);
                $('.username').html(data.username);
                $('.activationAt').html(moment(data.activation_at, 'YYYY-MM-DD').format('DD-MM-YYYY'));

                $('#fullname').val(data.fullname);
                $('#nomorTelepon').val(data.nomor_telepon);
                $('#email').val(data.email);
            })
            .catch(function(error) {
                console.log(error);
            })
    }
</script>

<script>
    const readURL = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }
    $('.choose').on('change', function() {
        readURL(this)
        let i
        if ($(this).val().lastIndexOf('\\')) {
            i = $(this).val().lastIndexOf('\\') + 1
        } else {
            i = $(this).val().lastIndexOf('/') + 1
        }
        const fileName = $(this).val().slice(i)
        $('.label').text(fileName)
    })
</script>