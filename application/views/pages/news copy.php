<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row"></div>
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
                <form action="[URL]" method="post">
                    <textarea name="content" id="editorKatapanda">
                        &lt;p&gt;This is some sample content.&lt;/p&gt;
                    </textarea>
                    <p><input type="button" id="submit" value="Submit"></p>
                </form>
                <!-- <div id="editor">
                    <h1>Hello world!</h1>
                    <p>I'm an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>
                </div> -->
            </div>
        </div>
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->


<script src="<?= base_url('assets/'); ?>vendor/ckeditor/ckeditor.js"></script>
<script>
    // $(document).ready(function() {
    //     let editor;

    //     ClassicEditor
    //         .create(document.querySelector('#editor'))
    //         .then(newEditor => {
    //             editor = newEditor;
    //         })
    //         .catch(error => {
    //             console.error(error);
    //         });

    //     $('#submit').click(function() {
    //         const editorData = editor.getData();
    //         console.log(editorData);
    //     })
    // });
    $(document).ready(function() {
        initSample();

        $('#submit').click(function() {
            const editorData = CKEDITOR.instances.editorKatapanda.getData();
            console.log(editorData);
        })
    });

    /**
     * Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
     * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
     */

    /* exported initSample */

    if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
        CKEDITOR.tools.enableHtml5Elements(document);

    // The trick to keep the editor in the sample quite small
    // unless user specified own height.
    CKEDITOR.config.height = 300;
    CKEDITOR.config.width = 'auto';

    CKEDITOR.replace('editor', {
        uiColor: '#CCEAEE'
    });


    var initSample = (function() {
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
                CKEDITOR.replace('editorKatapanda');
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