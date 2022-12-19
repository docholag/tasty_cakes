<?php
    session_start();
    require_once "dbcon/function.php";
    if(!isset($_SESSION["idUser"])){
        echo "<script> alert('Vui lòng đăng nhập !!!'); </script>";
        echo "<script> window.history.back(); </script>";
    }else if((int)$_SESSION["loai"] === 2){
        echo "<script> alert('Bạn không đủ quyền hạn !!!'); </script>";
        header("Location: ../");
    }
    if( isset($_GET["p"]) ){
        $p = $_GET["p"];
    }else $p = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="http://localhost/tc/admin/">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/main.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- slide trái --> 
        <?php
            require_once "blocks/slide_trai.php";
        ?>
        <!-- End slide trái -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top bar -->
                <?php
                    require_once "blocks/top_bar.php";
                ?>
                <!-- End of Top bar -->

                <!-- Begin Page Content -->
                <?php
                    switch($p){
                        // điều hướng quản lý bánh
                        case "show-cakes" : require "pages/cake/show_cake.php"; break;
                        case "sua-cake" : 
                            if( isset($_GET["idCake"]) ){
                                require "pages/cake/sua_cake.php"; break;
                            }else{
                                require "pages/dashboard.php"; break;
                            }
                        // điều hướng quản lý menu bánh
                        case "show-menu" : require "pages/menu/show_menu.php"; break;
                        // điều hướng quản lý đơn hàng
                        case "show-orders" : require "pages/order/show_order.php"; break;
                        // điều hướng quản lý người dùng
                        case "show-users" : require "pages/user/show_user.php"; break;
                        // điều hướng quản lý người dùng
                        case "show-codes" : require "pages/code/show_code.php"; break;
                        // case "add-product" : require "pages/product/add_product.php"; break;
                        // case "sua-product" : 
                        //     if( isset($_GET["idSP"]) ){
                        //         require "pages/product/sua_product.php"; break;
                        //     }else{
                        //         require "pages/dashboard.php"; break;
                        //     }
                        default : require "pages/dashboard.php";
                    }
                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                require_once "blocks/footer.php";
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" language="javascript" src="ckeditor/ckeditor.js" ></script>
    

    <!--  -->
    <script src="js/bootbox/bootbox.all.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>

</body>

</html>
