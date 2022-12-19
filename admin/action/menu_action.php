<?php
require 'function.php';
require "../dbcon/ConDB.php";
    if( isset($_POST["add"])){
        
        if( !empty($_POST["loaicake"])){
            $loaicake = $_POST["loaicake"];
            $lckd = changeTitle($loaicake);
            $check = "
                SELECT idLC FROM tb_loaicake
                WHERE LoaiCake = :loaicake;
            ";
            $pre = $conn->prepare($check);
            $pre->bindParam(":loaicake", $loaicake, PDO::PARAM_STR);
            $pre->execute();
            $count = $pre->rowCount();
            if($count === 0){
                
                $sql = "
                    INSERT INTO tb_loaicake (idLC, LoaiCake, LCKD) 
                    VALUES (NULL, :loaicake, :lckd);
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":loaicake", $loaicake, PDO::PARAM_STR);
                $pre->bindParam(":lckd", $lckd, PDO::PARAM_STR);
                $pre->execute();
                header("location:../?p=show-menu");
            }else{
                echo "<script> window.history.back(); </script>";
                echo "<script> alert('Loại bánh đã tồn tại trong hệ thống !!!'); </script>";
            }
        }else {
            echo "<script> window.history.back(); </script>";
            echo "<script> alert('Vui lòng nhập đầy đủ'); </script>";
        }
    }
    if( isset($_POST["xoa"])){
        $idLC = filter_input(INPUT_POST, 'idLC');
        $sql = "
            DELETE FROM tb_loaicake
            WHERE idLC = :idLC;
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idLC", $idLC, PDO::PARAM_INT);
        $pre->execute();
        header("location:../?p=show-menu");
    }
?>