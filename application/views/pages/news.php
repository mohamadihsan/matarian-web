<style>
    /* upload profile picture */
    .file-input {
        font-family: sans-serif;
        display: inline-block;
        text-align: left;
        padding: 8px 0;
        position: relative;
        width: 100%;
    }

    .file-input>[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 10;
        cursor: pointer;
    }

    .file-input>.button {
        display: inline-block;
        cursor: pointer;
        background: #ccc;
        padding: 8px 16px;
        border-radius: 2px;
        margin-right: 8px;
        font-size: 14px;
    }

    .file-input:hover>.button {
        background: #263238;
        color: #fff;
    }

    .file-input>.label {
        color: #666;
        white-space: nowrap;
        opacity: 1;
        font-size: 13px;
    }

    #preview {
        max-width: 250px;
        margin-top: 16px;
    }
</style>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Management</li>
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
                        <!-- <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Enable Fixed Header" id="enable" style="display: none"><i class="fas fa-bars"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Disable Fixed Header"  id="disable"><i class="fas fa-ban"></i></button> -->
                        <div id="actionCreate"></div>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-striped table-bordered nowrap table-md text-katapanda-sm" id="katapandaTable" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Posting Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot class="">
                            <tr>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Posting Date</th>
                                <th></th>
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

<!-- Form Add/Edit -->
<div class="modal fade" id="formKatapanda" tabindex="-1" role="dialog" aria-labelledby="formKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <label class="label-katapanda-sm" for="name">News Cover</label>
                        <div class="file-input">
                            <input class="choose" type="file" name="newsCover" id="newsCover" accept="image/*">
                            <span class="button">Choose News Cover</span>
                            <span class="label">No News Cover selected</span>
                        </div>
                        <img id="preview" src="">
                    </div>

                    <div class="form-group">
                        <label class="label-katapanda-sm" for="title">News Title <i class="text-danger">*</i></label>
                        <input type="text" name="title" class="form-control form-control-sm" id="title" placeholder="">
                    </div>

                    <div class="form-group">
                        <label class="label-katapanda-sm" for="name">News Content <i class="text-danger">*</i></label>
                        <textarea name="content" id="editorKatapanda" placeholder="Content of news"></textarea>
                    </div>

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

<!-- Confirm Delete -->
<div class="modal fade" id="confirmKatapanda" tabindex="-1" role="dialog" aria-labelledby="confirmKatapandaTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="confirm">
            <div class="modal-content">
                <div class="modal-header bg-custom">
                    <h6 class="modal-title" id="confirmTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data: <span class="text-custom" id="dataDelete"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-custom" id="submitDelete">Yes, delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/'); ?>vendor/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function() {

        // init variable
        let id = null;
        let actionCreate = <?php echo $action_create == 1 ? 1 : 0; ?>;
        let actionUpdate = <?php echo $action_update == 1 ? 1 : 0; ?>;
        let actionDelete = <?php echo $action_delete == 1 ? 1 : 0; ?>;
        let actionApproval = <?php echo $action_approval == 1 ? 1 : 0; ?>;
        let actionExportToExcel = <?php echo $action_export_to_excel == 1 ? 1 : 0; ?>;
        let actionExportToCsv = <?php echo $action_export_to_csv == 1 ? 1 : 0; ?>;
        let actionExportToPdf = <?php echo $action_export_to_pdf == 1 ? 1 : 0; ?>;

        // init function
        initEditor();

        // button default for action datatables
        let buttonAction = ['copyHtml5']; // add button to copy data

        // button action by user role 
        actionCreate ? $('#actionCreate').html('<button class="btn btn-sm btn-outline-primary" id="newData"><i class="fas fa-plus"></i> Create News</button>') : '';
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
            customize: function(doc) {
                doc.defaultStyle.fontSize = 6;
                doc.styles.tableHeader.fontSize = 7;
                doc.styles.tableFooter.fontSize = 7;
                doc.styles.tableHeader.alignment = 'left';
                doc.pageMargins = [20, 60, 20, 30];
                doc.content[1].table.widths = ['15%', '25%', '15%', '45%', '0%'];
                var rowCount = doc.content[1].table.body.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'left';
                    doc.content[1].table.body[i][1].alignment = 'left';
                    doc.content[1].table.body[i][2].alignment = 'left';
                    doc.content[1].table.body[i][3].alignment = 'left';
                }
                var objLayout = {};
                objLayout['hLineWidth'] = function(i) {
                    return .5;
                };
                objLayout['vLineWidth'] = function(i) {
                    return .5;
                };
                objLayout['hLineColor'] = function(i) {
                    return '#aaa';
                };
                objLayout['vLineColor'] = function(i) {
                    return '#aaa';
                };
                objLayout['paddingLeft'] = function(i) {
                    return 4;
                };
                objLayout['paddingRight'] = function(i) {
                    return 4;
                };
                doc.content[0].layout = objLayout;
            }
        }) : '';
        // setting dataTables
        $.extend(true, $.fn.dataTable.defaults, {
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
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBfrtip',
            buttons: buttonAction
        });

        // store data to dataTables 
        $.fn.dataTable.ext.errMode = 'none';
        let table = $('#katapandaTable')
            .on('error.dt', function(e) {})
            .DataTable({
                // data: data, // data
                // ajax: 'https://jsonplaceholder.typicode.com/posts', //array object
                ajax: { // array
                    url: '<?= site_url() ?>api/web/v1/news',
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                },
                columns: [{
                        data: "cover",
                        className: "align-middle text-center",
                        width: "15%",
                        render: function(data, type, row, meta) {
                            let image = `<img src="<?= base_url() ?>${data}" width="100px" />`;
                            return image;
                        }
                    },
                    {
                        data: "title",
                        className: "align-middle"
                    },
                    {
                        data: "created_at",
                        className: "align-middle text-center",
                        width: "10%",
                        render: function(data, type, row, meta) {
                            return moment(data, 'YYYY-MM-DD HH:mm').format('DD-MM-YYYY HH:mm');
                        }
                    },
                    {
                        data: "id",
                        className: "align-middle text-center",
                        width: "10%",
                        responsivePriority: 2,
                        render: function(data, type, row, meta) {
                            // set by role
                            let action = `<div class="btn-group">`;
                            action += `<a class="btn btn-sm btn-outline-dark" href="<?= base_url() ?>news/${data}" target="_blank" data-toggle="tooltip" data-placement="top" title="Preview"><i class="fas fa-eye"></i></a>`;
                            actionUpdate ? action += `<button class="btn btn-sm btn-outline-warning d-none d-sm-block edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>` : '';
                            actionDelete ? action += `<button class="btn btn-sm btn-outline-danger d-none d-sm-block delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>` : '';
                            action += `</div>`;
                            return action;
                        }
                    },
                ],
                language: {
                    loadingRecords: `<div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`,
                    processing: `<div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Processing...</span>
                        </div>`
                }
            }).columns.adjust();

        // Button Enable Fixed Header
        $('#enable').on('click', function() {
            table.fixedHeader.enable();
            $('#enable').css("display", "none");
            $('#disable').css("display", "");
        });

        // Button Disable Fixed Header
        $('#disable').on('click', function() {
            table.fixedHeader.disable();
            $('#enable').css("display", "");
            $('#disable').css("display", "none");
        });

        // getter and setter data in the row to form input
        $('#katapandaTable tbody').on('click', 'tr', function() {

            var ids = $.map(table.rows(this).data(), function(item) {
                // alert(JSON.stringify(item))
                // console.log('Edit');
                console.log(JSON.stringify(item));

                // store data to input
                $('#title').val(item.title);
                $('#content').val(item.content);
                CKEDITOR.instances.editorKatapanda.setData(item.content);

                // set
                id = item.id;

                // store data to confirm delete text
                $('#dataDelete').text(item.title);
            });

        });

        // modal form add Create News  
        $('#newData').click(function() {
            // reset ID
            id = null;
            // reset validator in the form
            validator.resetForm()
            // reset Form
            resetFormInput();
            $('#preview').attr('src', '')
            $('.label').text('')
            CKEDITOR.instances.editorKatapanda.setData('');

            // show modal
            $('#formTitle').html('<i class="fas fa-newspaper"></i> Create <?= $title ?>');
            $('#btnSubmit').text('Save');
            $('#formKatapanda').modal({
                backdrop: 'static'
            }, 'show')
            $('#btnResetFormInput').css("display", "");
        })

        // modal form edit in desktop mode
        $('.edit').click(function() {
            // reset validator in the form
            validator.resetForm()

            // show modal
            $('#formTitle').html('<i class="fas fa-newspaper"></i> Edit <?= $title ?>');
            $('#btnSubmit').text('Update');
            $('#formKatapanda').modal({
                backdrop: 'static'
            }, 'show')
            $('#btnResetFormInput').css("display", "none");
        })

        // modal form edit in tablet/mobile mode
        $('#katapandaTable tbody').on('click', '.edit', function() {
            // reset validator in the form
            validator.resetForm()
            // show modal
            $('#formTitle').html('<i class="fas fa-newspaper"></i> Edit <?= $title ?>');
            $('#btnSubmit').text('Update');
            $('#formKatapanda').modal({
                backdrop: 'static'
            }, 'show')
            $('#btnResetFormInput').css("display", "none");
        })

        // confirm delete 
        $('#katapandaTable tbody').on('click', '.delete', function() {
            // show confirm
            $('#confirmTitle').html('<i class="fas fa-newspaper"></i> Delete <?= $title ?>');
            $('#confirmKatapanda').modal('show')
        })

        // validate and request add Create News and update existing data 
        let validator = $('#form').validate({
            rules: {
                title: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "title can't empty"
                }
            },
            submitHandler: function(form) {
                // start loading
                loadingStart()
                let formData = new FormData();
                let imagefile = document.querySelector('#newsCover');
                formData.append("cover", imagefile.files[0]);
                formData.append("title", $('#title').val());
                formData.append("content", CKEDITOR.instances.editorKatapanda.getData());

                // send request 
                axios({
                        method: id === null ? `POST` : `POST`,
                        url: id === null ? `<?= site_url() ?>api/web/v1/news` : `<?= site_url() ?>api/web/v1/news/${id}`,

                        headers: {
                            Authorization: 'Bearer <?= $token ?>',
                            // contentType: false,
                            'Content-Type': 'multipart/form-data'
                        },
                        data: formData
                    })
                    .then(function(response) {
                        let status = response.data.status;
                        let message = response.data.message;
                        let action = id === null ? `create` : `update`;
                        if (status) {
                            // show message
                            notification(action, 'success', message);
                            $('#formKatapanda').modal('hide');
                            $('#katapandaTable').DataTable().ajax.reload();
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
                        notification('login', 'error', messageError);
                    })
                    .then(function() {
                        // stop loading
                        loadingStop()
                    })
            }
        })

        // delete
        $('#submitDelete').click(function() {
            // alert('Delete : ' + `<?= site_url() ?>api/web/v1/news/${id}`)

            // start loading
            loadingStart()
            // send request 
            axios({
                    method: `DELETE`,
                    url: `<?= site_url() ?>api/web/v1/news/${id}`,
                    headers: {
                        Authorization: 'Bearer <?= $token ?>'
                    }
                })
                .then(function(response) {
                    // console.log(response);
                    let status = response.data.status;
                    let message = response.data.message;
                    let action = `delete`;
                    if (status) {
                        // show message
                        notification(action, 'success', message);
                        $('#confirmKatapanda').modal('hide');
                        $('#katapandaTable').DataTable().ajax.reload();
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
                    notification('delete', 'error', messageError);
                })
                .then(function() {
                    // stop loading
                    loadingStop()
                })
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

    // Editor
    if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
        CKEDITOR.tools.enableHtml5Elements(document);

    // The trick to keep the editor in the sample quite small
    // unless user specified own height.
    CKEDITOR.config.height = 350;
    CKEDITOR.config.width = 'auto';
    // CKEDITOR.config.removePlugins = 'easyimage, cloudservices';

    var initEditor = (function() {
        var wysiwygareaAvailable = isWysiwygareaAvailable(),
            isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

        return function() {
            var editorElement = CKEDITOR.document.getById('editor');

            // :(((
            if (isBBCodeBuiltIn) {
                editorElement.setHtml(
                    'Hello world!\n\n' +
                    'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
                );
            }

            // Depending on the wysiwygarea plugin availability initialize classic or inline editor.
            if (wysiwygareaAvailable) {
                // CKEDITOR.replace('editorKatapanda');
                CKEDITOR.replace('editorKatapanda', {
                    extraPlugins: 'easyimage',
                    cloudServices_tokenUrl: 'https://matarian.com/unit/news/cs-token-endpoint',
                    cloudServices_uploadUrl: 'https://matarian.com/unit/news/easyimage/upload/'
                });
            } else {
                editorElement.setAttribute('contenteditable', 'true');
                CKEDITOR.inline('editorKatapanda');

                // TODO we can consider displaying some info box that
                // without wysiwygarea the classic editor may not work.
            }
        };

        function isWysiwygareaAvailable() {
            // If in development mode, then the wysiwygarea must be available.
            // Split REV into two strings so builder does not replace it :D.
            if (CKEDITOR.revision == ('%RE' + 'V%')) {
                return true;
            }

            return !!CKEDITOR.plugins.get('wysiwygarea');
        }
    })();
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