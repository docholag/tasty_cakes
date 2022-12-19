<?php
require 'function.php';
require "../dbcon/ConDB.php";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$expensions= array("jpeg","jpg","png");
    if( isset($_POST["add"])){
        
        if( !empty($_POST["cake"]) && !empty($_POST["giagoc"]) && !empty($_POST["giagiam"])){
            $cake = $_POST["cake"];
            $giagoc = $_POST["giagoc"];
            $giagiam = $_POST["giagiam"];
            $tenkd = changeTitle($cake);
            $mota = $_POST["mota"];
            $loai = $_POST["loaicake"];
            $anh = $_FILES['img']['name'];
            $duoi = pathinfo($anh, PATHINFO_EXTENSION);

            $check = "
                SELECT idCake FROM tb_cakes
                WHERE TenBanh = :cake;
            ";
            $pre = $conn->prepare($check);
            $pre->bindParam(":cake", $cake, PDO::PARAM_STR);
            $pre->execute();
            $count = $pre->rowCount();
            if($count === 0){
                
                if( in_array($duoi, $expensions) === TRUE){
                
                    $img = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;

                    while(file_exists("../../public/img/cakes/".$img)){
                        $img = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;
                    }

                    move_uploaded_file($_FILES['img']['tmp_name'], "../../public/img/cakes/".$img);

                    $sql = "
                        INSERT INTO 
                        tb_cakes (idCake, TenBanh, TenKD, GiaGoc, GiaGiam, Anh, MoTa, DaBan, LuotThich, idLC, idTTC) 
                        VALUES 
                        (NULL, :cake, :tenkd, :giagoc, :giagiam, :img, :mota, 0, 0, :idloai, 1);
                    ";
                    $pre = $conn->prepare($sql);
                    $pre->bindParam(":cake", $cake, PDO::PARAM_STR);
                    $pre->bindParam(":tenkd", $tenkd, PDO::PARAM_STR);
                    $pre->bindParam(":giagoc", $giagoc, PDO::PARAM_INT);
                    $pre->bindParam(":giagiam", $giagiam, PDO::PARAM_INT);
                    $pre->bindParam(":img", $img, PDO::PARAM_STR);
                    $pre->bindParam(":mota", $mota, PDO::PARAM_STR);
                    $pre->bindParam(":idloai", $loai, PDO::PARAM_INT);
                    $pre->execute();
                    header("location:../?p=show-cakes");
                }else{
                    echo "<script> window.history.back(); </script>";
                    echo "<script> alert('Chỉ nhận file ảnh !!!'); </script>";
                }
            }else{
                echo "<script> window.history.back(); </script>";
                echo "<script> alert('Sản phẩm đã tồn tại trong hệ thống !!!'); </script>";
            }
        }else {
            echo "<script> window.history.back(); </script>";
            echo "<script> alert('Vui lòng nhập đầy đủ'); </script>";
        }
    }
    if( isset($_POST["sua"])){
        if( !empty($_POST["cake"]) && !empty($_POST["giagoc"]) && !empty($_POST["giagiam"])){
            $cake = $_POST["cake"];
            $giagoc = $_POST["giagoc"];
            $giagiam = $_POST["giagiam"];
            $tenkd = changeTitle($cake);
            $mota = $_POST["mota"];
            $loai = $_POST["loaicake"];
            $ten_anh = $_POST["avatar"];
            $idCake = $_POST["idCake"];
            // $anh = $_FILES['img']['name'];
            

            if( $_FILES["img"]['name'] !== "" ){
                $anh = $_FILES['img']['name'];
                $duoi = pathinfo($anh, PATHINFO_EXTENSION);
                if( in_array($duoi, $expensions) === TRUE){
                    $anhbia = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;
                    while(file_exists("../../public/img/cakes/".$anhbia)){
                        $anhbia = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;
                    }
                    move_uploaded_file($_FILES['img']['tmp_name'], "../../public/img/cakes/".$anhbia);
                    unlink("../../public/img/cakes/".$ten_anh);
                    $img = "Anh = "."'$anhbia'".",";
                }else{
                    echo "<script> alert('Chỉ nhận file ảnh !!!'); </script>";
                }
            }else{
                $img = "";
            }
            $sql = "
                UPDATE tb_cakes
                SET ".$img."
                    TenBanh = :ten,
                    TenKD = :tenkd,
                    GiaGoc = :giagoc,
                    GiaGiam = :giagiam,
                    MoTa =  :mota,
                    idLC = :idLC
                WHERE idCake = :idCake;
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":ten", $cake, PDO::PARAM_STR);
            $pre->bindParam(":tenkd", $tenkd, PDO::PARAM_STR);
            $pre->bindParam(":giagoc", $giagoc, PDO::PARAM_INT);
            $pre->bindParam(":giagiam", $giagiam, PDO::PARAM_INT);
            $pre->bindParam(":mota", $mota, PDO::PARAM_STR);
            $pre->bindParam(":idLC", $loai, PDO::PARAM_INT);
            $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
            $pre->execute();
            header("location:../?p=sua-cake&idCake=".$idCake);
        }else {
            echo "<script> alert('Vui lòng nhập đầy đủ'); </script>";
        }
    }
    if( isset($_POST["xoa"])){
        $idCake = filter_input(INPUT_POST, 'idCake');
        $img = $_POST["anh"];
        $sql = "
            DELETE FROM tb_cakes
            WHERE idCake = :idCake;
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
        $pre->execute();
        unlink("../../public/img/cakes/".$img);
        header("location:../?p=show-cakes");
    }
    if( isset($_POST["changett"])){
        $idCake = filter_input(INPUT_POST, 'idCake');
        $status = (int)$_POST["status"];
        if($status === 2){
            $tt = 1;
        }
        if($status === 1){
            $tt = 2;
        }
        
        $sql = "
            UPDATE tb_cakes
            SET idTTC = :status
            WHERE idCake = :idCake;
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
        $pre->bindParam(":status", $tt, PDO::PARAM_INT);
        $pre->execute();
        header("location:../?p=show-cakes");
    }
?>