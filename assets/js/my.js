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
            } else if (action === 'login') {
                messageAction = ''
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

function loadingStart(element = 'body', message = null) {
    // loading screen after click button login
    $(element).loading({
        stoppable: false,
        message: message === null ? "Please wait..." : message,
        theme: "dark"
    });
}


function loadingStop(element = 'body') {
    // loading screen after click button login
    $(element).loading('stop');
}