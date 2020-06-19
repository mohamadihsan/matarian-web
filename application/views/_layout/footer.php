</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>copyright &copy; 2020 - <?= SITE_NAME; ?>
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    // init
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // sample
    let data = [
        {
            "id": "1",
            "name": "Tiger Nixon",
            "position": "System Architect",
            "salary": "$320,800",
            "start_date": "2011/04/25",
            "office": "Edinburgh",
            "extn": "5421"
        },
        {
            "id": "2",
            "name": "Garrett Winters",
            "position": "Accountant",
            "salary": "$170,750",
            "start_date": "2011/07/25",
            "office": "Tokyo",
            "extn": "8422"
        },
        {
            "id": "3",
            "name": "Ashton Cox",
            "position": "Junior Technical Author",
            "salary": "$86,000",
            "start_date": "2009/01/12",
            "office": "San Francisco",
            "extn": "1562"
        },
        {
            "id": "4",
            "name": "Cedric Kelly",
            "position": "Senior Javascript Developer",
            "salary": "$433,060",
            "start_date": "2012/03/29",
            "office": "Edinburgh",
            "extn": "6224"
        },
        {
            "id": "5",
            "name": "Airi Satou",
            "position": "Accountant",
            "salary": "$162,700",
            "start_date": "2008/11/28",
            "office": "Tokyo",
            "extn": "5407"
        },
        {
            "id": "6",
            "name": "Brielle Williamson",
            "position": "Integration Specialist",
            "salary": "$372,000",
            "start_date": "2012/12/02",
            "office": "New York",
            "extn": "4804"
        },
        {
            "id": "7",
            "name": "Herrod Chandler",
            "position": "Sales Assistant",
            "salary": "$137,500",
            "start_date": "2012/08/06",
            "office": "San Francisco",
            "extn": "9608"
        },
        {
            "id": "8",
            "name": "Rhona Davidson",
            "position": "Integration Specialist",
            "salary": "$327,900",
            "start_date": "2010/10/14",
            "office": "Tokyo",
            "extn": "6200"
        },
        {
            "id": "9",
            "name": "Colleen Hurst",
            "position": "Javascript Developer",
            "salary": "$205,500",
            "start_date": "2009/09/15",
            "office": "San Francisco",
            "extn": "2360"
        },
        {
            "id": "10",
            "name": "Sonya Frost",
            "position": "Software Engineer",
            "salary": "$103,600",
            "start_date": "2008/12/13",
            "office": "Edinburgh",
            "extn": "1667"
        },
        {
            "id": "11",
            "name": "Jena Gaines",
            "position": "Office Manager",
            "salary": "$90,560",
            "start_date": "2008/12/19",
            "office": "London",
            "extn": "3814"
        },
        {
            "id": "12",
            "name": "Quinn Flynn",
            "position": "Support Lead",
            "salary": "$342,000",
            "start_date": "2013/03/03",
            "office": "Edinburgh",
            "extn": "9497"
        },
        {
            "id": "13",
            "name": "Charde Marshall",
            "position": "Regional Director",
            "salary": "$470,600",
            "start_date": "2008/10/16",
            "office": "San Francisco",
            "extn": "6741"
        },
        {
            "id": "14",
            "name": "Haley Kennedy",
            "position": "Senior Marketing Designer",
            "salary": "$313,500",
            "start_date": "2012/12/18",
            "office": "London",
            "extn": "3597"
        },
        {
            "id": "15",
            "name": "Tatyana Fitzpatrick",
            "position": "Regional Director",
            "salary": "$385,750",
            "start_date": "2010/03/17",
            "office": "London",
            "extn": "1965"
        }
    ];
</script>

<!-- assets -->
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/axios/dist/axios.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery-easy-loading/dist/jquery.loading.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-responsive/js/responsive.bootstrap.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jszip/js/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/pdfmake/js/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/pdfmake/js/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/katapanda.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/my.js"></script>
<script src="<?= base_url('assets/'); ?>js/version.min.js"></script>
</body>

</html>