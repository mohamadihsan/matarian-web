<div class="container">

    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        <span class="navbar-brand mb-0 h1 text-center" style="color: antiquewhite;"><i class="fas fa-newspaper"></i> Matarian News</span>
    </nav>

    <div id="preload" class="text-center">
        <div class="spinner-border text-custom" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div id="newsContent">
        <div id="title" class="text-left" style="font-size: 2em; font-weight: bolder"></div>
        <div id="postingDate" class="text-left" style="font-size: 1em; margin-bottom: 20px"></div>
        <div id="cover" class="text-left"></div>
        <div id="content" style="margin-top: 20px; text-align: justify;"></div>
    </div>
</div>


<script src="<?= base_url('assets/'); ?>vendor/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $("#preload").fadeOut(500, function() {
            $("#newsContent").fadeIn(1000);
        });

        axios({
                method: `GET`,
                url: `<?= site_url() ?>api/web/v1/news/<?= $id ?>`,
                headers: {
                    Authorization: 'Bearer <?= $token ?>'
                }
            })
            .then(function(response) {
                // console.log(response.data.data[0]);
                $('#title').html(response.data.data[0].title);
                $('#postingDate').html(`Matarian.com - ${moment(response.data.data[0].created_at, 'YYYY-MM-DD HH:mm').format('DD/MM/YYYY HH:mm')}`);
                $('#cover').html(`<img src="<?= base_url() ?>${response.data.data[0].cover}" class="img-fluid" />`);
                $('#content').html(response.data.data[0].content);
            })
            .catch(function(error) {
                console.log(error);
            })
    })
</script>