<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
.files input {
    /* outline: 2px dashed #92b0b3; */
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 75px;
    right: 0;
    height: 75px;
    content: "";
    background-image: url(<?= base_url('assets/img/upload.png')?>);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#ffffff;}
.files:before {
    position: absolute;
    bottom: 0px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    content: " DRAG & DROP HERE OR CLICK ";
    display: block;
    margin: 0 auto;
    /* color: #2ea591; */
    font-weight: 300;
    text-transform: capitalize;
    text-align: center;
}
</style>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 katapanda-hide-element">
        <div class="d-flex flex-row">
            
            <div class="card h-100">
                <a href="<?= site_url('report/stock') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Document PPN Masukkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumPPNMasukkan" class="numbers"></span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card h-100 ml-2">
                <a href="<?= site_url('langganan') ?>" class="card-body" style="color: #757575; text-decoration: none;">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Document Lain</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="sumDokumenLain" class="numbers"></span></div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-file-alt fa-2x text-info"></i>
                        </div>
                    </div>   
                </a>
            </div>
        </div>
    </div>

	<div class="row my-4">
		<div class="col">
			<div class="jumbotron" style="padding: 1rem 2rem">
				<h1><?= $title ?></h1>
				<p class="text-muted">Please select type of document before upload!</p>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="label-katapanda-sm" for="typeOfDocument">Type of Document <span class="text-danger">*</span></label>
                        <select name="typeOfDocument" id="typeOfDocument" class="selectpicker form-control form-control-md"  data-live-search="true"  title="Choose" style="border-color: #fff;">
                            <option value="PPNMASUKKAN">Dokumen PPN Masukkan</option>
                            <option data-divider="true"></option>
                            <option value="DOKUMENLAIN">Dokumen Lain</option>
                            <!-- <option data-divider="true"></option>
                            <option value="KODEOBJEKPAJAK">Unifikasi Kode Objek Pajak</option>
                            <option data-divider="true"></option>
                            <option value="KODEFASILITAS">Unifikasi Kode Fasilitas</option>
                            <option data-divider="true"></option>
                            <option value="KODEPEMBAYARAN">Unifikasi Kode Pembayaran</option>
                            <option data-divider="true"></option>
                            <option value="KODEDOKUMEN">Unifikasi Kode Dokumen</option> -->
                        </select>
                        <span id="errorTypeOfDocument"></span>
                    </div> 
                    <div class="form-group col-md-3" id="form_ppn_persentase">
                        <label class="label-katapanda-sm" for="ppn_persentase">PPN(%) <span class="text-danger"></span></label>
                        <input type="number" class="form-control form-control-md" name="ppn_persentase" id="ppn_persentase" min="0" max="100" step="0.01" placeholder="0.00">
                        <small class="form-text text-muted">Nilai antara 0 hingga 100%</small>
                    </div>
                    <div class="form-group col-md-4">
                        <span id="templateDocument"></span>
                    </div>
                    <div class="form-group col-md-12 d-none" id="fileUpload2">
                        <form method="post" action="#" id="#">
                            <div class="form-group files color">
                                <label class="label-katapanda-sm" for="File">File Document (Max: 10MB) <span class="text-danger">*</span></label>
                                <input type="file" id="file-upload" class="form-control form-control-md" style="">
                                <div id="file-upload-filename"></div>
                            </div>
                        </form>
                        <button type="button" class="btn bg-custom btn-block" id="btnUpload" style="margin-top: -15px">UPLOAD</button>
                    </div>
                </div>        
				
			</div>
		</div>

	</div>
</div>

<script src="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="<?= base_url('assets/vendor/xlsx/xlsx.full.min.js') ?>"></script>

<script>
    var start_time = '';
    $('#btnUpload').click(function(){

        if ($('#typeOfDocument').val() == 'PPNMASUKKAN' || $('#typeOfDocument').val() == 'DOKUMENLAIN') {
            if ($('#ppn_persentase').val() > 100) {
                notification('upload',  "error", "PPN Persentase maksimal 100");
                return
            }
        }
        
        // start loading
        loadingStart('body', `<div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div><br/>
                        Don't Close This Page <br/>while Importing`);

        setTimeout(function (){
            start_time = new Date().getTime();

            var files = $('#file-upload').get(0).files[0]; // FileList object
            var fileName = files.name;
            // console.log(files);
            // var xl2json = new ExcelToJSON();
            // xl2json.parseExcel(files);

            var reader = new FileReader();
            reader.readAsArrayBuffer(files);
            reader.onload = async function(e) {
                var data = new Uint8Array(reader.result);
                //   var wb = XLSX.read(data,{type:'array'});
                var wb = XLSX.read(data,{type:'array', cellDates:true, cellNF: false, cellText:false});

                let jsonObject;
                let obj;
                var i = 0;
                wb.SheetNames.forEach(sheet => {
                //   	dataLoad.html("");
                //   	dataLoad.append("Loading Persiapan "+(i++));
                    let rowObj = XLSX.utils.sheet_to_row_object_array(
                        wb.Sheets[sheet],{dateNF:"YYYY-MM-DD"}
                    )
                    jsonObject = JSON.stringify(rowObj);
                    obj = rowObj;
                })
                
                // console.log("data mantap : "+jsonObject);

                let limit = 15000;
                let looping = Math.ceil(obj.length / limit)
                let start = 0;
                let end = 0;
                for (let index = 0; index < looping; index++) {
                    if (index == 0) {
                        start = index;
                        end = limit;
                    } else {
                        start = end;
                        end = end + limit;
                    }
                    // console.log('start:'+start+' end:'+end);
                    let element = JSON.parse(jsonObject).slice(start,end);
                    // console.log(index+' : '+element);
                        
                    await axios({
                        method: `POST`,
                        url: `<?= site_url() ?>api/web/v1/import-document`,
                        headers: {
                            Authorization: 'Bearer <?= $token ?>' 
                        },
                        data: {
                            element: element,
                            type_document: $('#typeOfDocument').val(),
                            index: index,
                            filename: fileName,
                            ppn_persentase: $('#ppn_persentase').val(),
                        }
                    })
                    .then(function (response) {
                        let status = '';
                        let message = '';
                        // console.log(response);
                        if (response.data.status === true) {
                            let timeExecution = 'Time process: ' + msToTime(new Date().getTime() - start_time);
                            status = 'info';
                            message = response.data.message + ' ' + timeExecution;
                        } else if (response.data.status === false) {
                            status = 'warning';
                            message = response.data.message;
                        } else {
                            status = 'info';
                            message = `Please wait...! Inserting data batch ${index+1}/${looping}`;
                        }
                        if (index+1 == looping) {
                            notification('upload',  status, message);  
                        }  else {
                            notification('upload', 'info', `Please wait...! Inserting data batch ${index+1}/${looping}`);  
                        }
                                    
                        getData();
                        loadingStop()
                    })
                    .catch(function (error) {
                        console.log(error);
                        notification('upload', 'error', `Error: ${error}`);  
                        loadingStop()
                    })
                }
            }
        }, 1000);
    })

    $('#typeOfDocument').change(function() {
        // notificationWithImage('upload', 'info', `<span class="font-weight-bold font-italic">Please use the template document!</span> <br/>This document will be processed directly on the client computer. Total data more than 25k rows usually causing the page not to respond. <img class="img-fluid" src="<?= base_url('assets/img/unresponsive.PNG') ?>"> If you find it, you can <span class="font-weight-bold">ignore</span> that message or you can click button <span class="font-weight-bold">Wait</span>`, '');

        $("#fileUpload2").removeClass("d-none");
        $("#fileUpload1").addClass("d-none");
    })
</script>

<script>

$(document).ready( function () {
    // init
    getData();
    $('#btnUpload').addClass("d-none");

    $('#file-upload').change(function(e) {
        $('#btnUpload').removeClass("d-none");
        // console.log(e.target.files[0]);
    })

    $.fn.digits = function(){ 
        return this.each(function(){ 
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") ); 
        })
    }
})

$('#form_ppn_persentase').hide()

$('#typeOfDocument').change(function() {
    let type = $('#typeOfDocument').val();
    let link = '';
    $('#form_ppn_persentase').hide()

    if (type == 'KODEOBJEKPAJAK') {
        link = `<?= base_url('assets/template-document/01.03.03.01 Kode Objek Pajak.xlsx') ?>`;
    } else if (type == 'KODEFASILITAS') {
        link = `<?= base_url('assets/template-document/01.03.03.02 Kode Fasilitas.xlsx') ?>`;
    } else if (type == 'KODEPEMBAYARAN') {
        link = `<?= base_url('assets/template-document/01.03.03.03 Kode Pembayaran.xlsx') ?>`;
    } else if (type == 'KODEDOKUMEN') {
        link = `<?= base_url('assets/template-document/01.03.03.04 Kode Dokumen.xlsx') ?>`;
    } else if (type == 'PPNMASUKKAN') {
        link = `<?= base_url('assets/template-document/1234567890123456_PPN MASUKAN.xlsx') ?>`;
        $('#form_ppn_persentase').show()
    } else if (type == 'DOKUMENLAIN') {
        link = `<?= base_url('assets/template-document/1234567890123456_DOKUMEN LAIN.xlsx') ?>`;
        $('#form_ppn_persentase').show()
    } 
    $('#templateDocument').html(`<label class="label-katapanda-sm" for="downloadTemplate">
                                    Template document
                                </label><br/>
                                <a href="${link}" class="btn btn-md btn-outline-primary" title="Download template document">
                                    <i class="fa fa-download"></i>
                                </a>`);
})

// get data dashboard
function getData() {
    $('#sumPPNMasukkan').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
    $('#sumDokumenLain').html(`<div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
    
    axios({
        method: `GET`,
        url: `<?= site_url() ?>api/web/v1/dashboard/ppn`,
        headers: {
            Authorization: 'Bearer <?= $token ?>' 
        }
    })
    .then(function (response) {
        // console.log(response);
        
        $('#sumPPNMasukkan').text(response.data.data.ppnmasukkan.total_rows + ' Data');
        $('#sumDokumenLain').text(response.data.data.dokumenlain.total_rows + ' Data');
        
        $("span.numbers").digits();
    })
    .catch(function (error) {
        // console.log(error);
    })
}

function msToTime(duration) {
    let milliseconds = parseInt((duration % 1000) / 100),
        seconds = Math.floor((duration / 1000) % 60),
        minutes = Math.floor((duration / (1000 * 60)) % 60),
        hours = Math.floor((duration / (1000 * 60 * 60)) % 24);

    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
}

</script>