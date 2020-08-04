function tokenExpired(baseUrl, token) {
    notification('get', 'error', 'Token has expired. Please Login again...');
    setInterval(function(){ 
        axios({
            method: `POST`,
            url: `${baseUrl}api/web/v1/logout`,
            headers: {
                Authorization: `Bearer ${token}` 
            }
        })
        .then(function (response) {
            window.location.replace(baseUrl);
        })
        .catch(function (error) {
            console.log(error);
        })            
    }, 2000);
}