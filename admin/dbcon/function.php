<?php
    // Tất cả chức năng ở đây

    # Bánh func
        // Lấy tất cả bánh
        function all_cakes(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                INNER JOIN tb_trangthaicake
                ON tb_cakes.idTTC = tb_trangthaicake.idTTC
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy thông tin của 1 loại bánh
        function info_cake($idCake){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                INNER JOIN tb_trangthaicake
                ON tb_cakes.idTTC = tb_trangthaicake.idTTC
                WHERE idCake = :idCake
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy bánh theo loại bánh
        function loai_cakes($idLC){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_loaicake
                INNER JOIN tb_cakes
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_loaicake.idLC = :idLC
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy bánh mới
        function new_cakes(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_loaicake
                INNER JOIN tb_cakes
                ON tb_cakes.idLC = tb_loaicake.idLC
                LIMIT 0,8
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy lượt thích của 1 bánh
        function like_cake($idCake){
            require "ConDB.php";
            $sql = "
                SELECT idLike FROM tb_banhyeuthich
                WHERE idCake = :idCake
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
            $pre->execute();
            return $pre->rowCount();
        }
    #

    # Loại bánh func
        // Lấy tất cả loại bánh
        function all_loai(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_loaicake
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
    #
    
    # Đơn hàng func
        // Lấy tất cả đơn hàng
        function all_orders(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_order
                INNER JOIN tb_orderstatus
                ON tb_order.idOS = tb_orderstatus.idOS
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy trạng thái đơn hàng
        function status_order(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_orderstatus
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy đơn hàng của 1 người
        function order_user($idUser){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_order
                INNER JOIN tb_orderstatus
                ON tb_order.idOS = tb_orderstatus.idOS
                WHERE tb_order.idUser = :idUser
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Tìm kiếm menu phân trang
        // Lấy bánh theo loại bánh
        function cakes_menu($idLC, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.idLC = :idLC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy số lượng bánh theo loại bánh
        function count_cakes_menu($idLC){
            require "ConDB.php";
            $sql = "
                SELECT idCake FROM tb_cakes
                WHERE idLC = :idLC
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->execute();
            return $pre->rowCount();
        }
        // Lấy số lượng bánh theo loại bánh xếp theo lượt thích
        function cakes_menu_ln($idLC, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                WHERE tb_cakes.idLC = :idLC
                ORDER BY LuotThich DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy số lượng bánh theo loại bánh xếp theo mua nhiều
        function cakes_menu_mn($idLC, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                WHERE tb_cakes.idLC = :idLC
                ORDER BY DaBan DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy số lượng bánh theo loại bánh xếp theo giá giảm dần
        function cakes_menu_gg($idLC, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                WHERE tb_cakes.idLC = :idLC
                ORDER BY GiaGiam DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy số lượng bánh theo loại bánh xếp theo giá tăng dần
        function cakes_menu_gt($idLC, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                WHERE tb_cakes.idLC = :idLC
                ORDER BY GiaGiam ASC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Người dùng func
        // Lấy tất cả người dùng
        function all_users(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_user
                INNER JOIN tb_loaiuser
                ON tb_user.idLU = tb_loaiuser.idLU
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }

        // thông tin của người dùng
        function user_info($idUser){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_user
                INNER JOIN tb_loaiuser
                ON tb_user.idLU = tb_loaiuser.idLU
                WHERE idUser = :idUser
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Bình luận
        // Lấy bình luận của 1 bánh
        function cake_cmts($idCake){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_comment
                INNER JOIN tb_user
                ON tb_user.idUser = tb_comment.idUser
                WHERE tb_comment.idCake = :idCake
                ORDER BY idCmt DESC
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Tìm kiếm từ khóa phân trang
        // Lấy bánh theo từ khóa
        function cakes_key($tk, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy số lượng bánh theo từ khóa
        function count_cakes_key($tk){
            require "ConDB.php";
            $sql = "
                SELECT idCake FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->execute();
            return $pre->rowCount();
        }
        // Lấy bánh theo từ khóa xếp theo lượt thích
        function cakes_key_ln($tk, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
                ORDER BY tb_cakes.LuotThich DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy bánh theo từ khóa xếp theo mua nhiều
        function cakes_key_mn($tk, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
                ORDER BY tb_cakes.DaBan DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy bánh theo từ khóa xếp theo giá giảm dần
        function cakes_key_gg($tk, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
                ORDER BY tb_cakes.GiaGiam DESC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
        // Lấy bánh theo từ khóa xếp theo giá tăng dần
        function cakes_key_gt($tk, $start){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_cakes
                INNER JOIN tb_loaicake
                ON tb_cakes.idLC = tb_loaicake.idLC
                WHERE tb_cakes.TenBanh REGEXP :tk OR tb_loaicake.LoaiCake REGEXP :tk
                ORDER BY tb_cakes.GiaGiam ASC
                LIMIT :start,12
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tk", $tk, PDO::PARAM_STR);
            $pre->bindParam(":start", $start, PDO::PARAM_INT);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Mã giảm giá func
        // Lấy tất cả mã giảm giá
        function all_mgg(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_magiamgia
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
    #

    # Mã giảm giá func
        // Lấy tất cả loại người dùng
        function all_loaiuser(){
            require "ConDB.php";
            $sql = "
                SELECT * FROM tb_loaiuser
            ";
            $pre = $conn->prepare($sql);
            $pre->execute();
            return $pre->fetchAll();
        }
    #
?>