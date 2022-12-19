<?php
require "../dbcon/ConDB.php";
    if( isset($_POST["changestt"])){
        $stt = $_POST["stt"];
        $idOrder = $_POST["idOrder"];
        $sql = "
            UPDATE tb_order
            SET idOS = :idOS
            WHERE idOrder = :idOrder;
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idOS", $stt, PDO::PARAM_INT);
        $pre->bindParam(":idOrder", $idOrder, PDO::PARAM_INT);
        $pre->execute();
        header("location:../?p=show-orders");
        
    }
    // if( isset($_POST["xoa"])){
    //     $idLC = filter_input(INPUT_POST, 'idLC');
    //     $sql = "
    //         DELETE FROM tb_loaicake
    //         WHERE idLC = :idLC;
    //     ";
    //     $pre = $conn->prepare($sql);
    //     $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
    //     $pre->execute();
    //     header("location:../?p=show-menu");
    // }
?>