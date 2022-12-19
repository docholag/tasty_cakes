<?php
    require_once "../admin/dbcon/ConDB.php";
    if($_GET["check"] == 1){
        $mgg = $_GET["mgg"];
        $tien = (int)$_GET["tien"];
        $giam = 0;
        $sql = "
            SELECT Giam FROM tb_magiamgia
            WHERE Code = :mgg
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":mgg", $mgg, PDO::PARAM_STR);
        $pre->execute();
        if($pre->rowCount() > 0){
            $acc = $pre->fetchAll();
            foreach($acc as $row){
                $giam = $row["Giam"];
            }
            $tiengiam = ((100-(int)$giam)/100)*$tien;
            echo number_format($tiengiam, 0, ",", ".")." đ (-".(int)$giam."%)";
        }else{
            echo '<script>alert("Sai mã giảm giá !!!!");</script>';
            echo number_format($tien, 0, ",", ".")." đ";
        }
    }else{
        echo '<script>alert("Bạn đã sử dụng mã giảm giá !!!!");</script>';
        echo number_format($tien, 0, ",", ".")." đ";
    }
    //echo $tiengiam;
    
?>