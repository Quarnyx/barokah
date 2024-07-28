<?php include 'partials/main.php'; ?>
<?php
session_start();
if (!$_SESSION['id_user']) {
    header('Location: login.php');
    exit();
}
?>

<head>
    <?php
    $title = "Dashboard";
    include 'partials/title-meta.php'; ?>

    <!-- Plugins css -->
    <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />


    <?php include 'partials/head-css.php'; ?>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <?php include 'partials/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            <?php include 'partials/topbar.php'; ?>

            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <?php include 'content.php'; ?>

                </div> <!-- container -->

            </div> <!-- content -->

            <?php include 'partials/footer.php'; ?>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <!--  Modal content for the Large example -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php include 'partials/right-sidebar.php'; ?>

    <?php include 'partials/footer-scripts.php'; ?>

    <!-- Plugins js-->
    <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>

    <!-- Dashboar 1 init js-->
    <script src="assets/js/pages/dashboard-1.init.js"></script>

</body>

</html>