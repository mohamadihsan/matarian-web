// Function
function notification(action, status, message = null) {
    let messageAction;
    let confirmText = 'Close';

    if (message === null) {
        if (status === 'success') {
            if (action === 'create') {
                messageAction = 'data saved successfully...';
            } else if (action === 'update') {
                messageAction = 'data updated successfully...';
            } else if (action === 'delete') {
                messageAction = 'data deleted successfully...';
            } else if (action === 'approve') {
                messageAction = 'data approved successfully...';
            } else if (action === 'reject') {
                messageAction = 'data rejected successfully...';
            } else if (action === 'upload') {
                messageAction = 'data uploaded successfully...';
            } else if (action === 'login') {
                messageAction = ''
            } else if (action === 'forgot') {
                messageAction = 'link reset has been send via email'
            }
        } else if (status === 'error' || status === 'warning' || status === 'info') {
            if (action === 'create') {
                messageAction = 'data failed to save...';
            } else if (action === 'update') {
                messageAction = 'data failed to update...';
            } else if (action === 'delete') {
                messageAction = 'data failed to delete...';
            } else if (action === 'approve') {
                messageAction = 'data failed to approve...';
            } else if (action === 'reject') {
                messageAction = 'data failed to reject...';
            } else if (action === 'upload') {
                messageAction = 'file upload unsucessfully...'
            } else if (action === 'login') {
                messageAction = 'please check your username & password!'
            } else if (action === 'forgot') {
                messageAction = 'please check your email!'
            }
        }
    }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn bg-custom',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        position: 'center',
        icon: status, // success or error or warning or info or question
        title: 'Message',
        text: message === null ? messageAction : message,
        confirmButtonText: confirmText,
        cancelButtonText: 'Close!',
        showConfirmButton: status !== 'success' ? true : false,
        timer: status !== 'success' ? false : 1500,
        width: '28rem'
    })
}

// Function
function notificationWithImage(action, status, message = null, imageUrl) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn bg-custom',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        position: 'center',
        title: 'Info',
        html: message === null ? '' : message,
        confirmButtonText: 'Close',
        cancelButtonText: 'Close!',
        showConfirmButton: true,
        timer: status !== 'success' ? false : 1500,
        width: '28rem',
        imageUrl: imageUrl,
        // imageHeight: 1500,
        imageAlt: 'Info'

    })
}

function loadingStart(element = 'body', message = null) {
    // loading screen after click button login
    $(element).loading({
        stoppable: false,
        message: message === null ? `<div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>` : message,
        theme: "dark"
    });
}


function loadingStop(element = 'body') {
    // loading screen after click button login
    $(element).loading('stop');
}

function formatDDMMYYYHHIISS(date) {
    return moment(date, 'YYYY-MM-DD hh:mm:ss').format('DD-MM-YYYY hh:mm:ss');
}

function formatTanggalIndonesia(tanggal, format = 'date') {
    var date = new Date(tanggal);
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    var tanggal = date.getDate();
    var hari = date.getDay();
    var jam = date.getHours();
    var menit = date.getMinutes();
    var detik = date.getSeconds();

    switch(hari) {
        case 0: hari = "Minggu"; break;
        case 1: hari = "Senin"; break;
        case 2: hari = "Selasa"; break;
        case 3: hari = "Rabu"; break;
        case 4: hari = "Kamis"; break;
        case 5: hari = "Jum'at"; break;
        case 6: hari = "Sabtu"; break;
    }
    switch(bulan) {
        case 0: bulan = "Januari"; break;
        case 1: bulan = "Februari"; break;
        case 2: bulan = "Maret"; break;
        case 3: bulan = "April"; break;
        case 4: bulan = "Mei"; break;
        case 5: bulan = "Juni"; break;
        case 6: bulan = "Juli"; break;
        case 7: bulan = "Agustus"; break;
        case 8: bulan = "September"; break;
        case 9: bulan = "Oktober"; break;
        case 10: bulan = "November"; break;
        case 11: bulan = "Desember"; break;
    }

    var tampilTanggalFull = hari + ", " + tanggal + " " + bulan + " " + tahun;
    var tampilTanggal = tanggal + " " + bulan + " " + tahun;
    var tampilWaktu = jam + ":" + menit + ":" + detik;

    if (format == 'full') {
        return tampilTanggalFull + ' ' + tampilWaktu;
    } else if (format == 'time') {
        return tampilWaktu;
    }

    return tampilTanggal;
}