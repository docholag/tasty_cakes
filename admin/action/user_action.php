<?php
require 'function.php';
require "../dbcon/ConDB.php";
    if( isset($_POST["changeType"])){
        $idUser = $_POST["idUser"];
        $type = $_POST["type"];
        $sql = "
            UPDATE tb_user
            SET tb_user.idLU = :type
            WHERE idUser = :idUser
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $pre->bindParam(":type", $type, PDO::PARAM_STR);
        $pre->execute();
        header("location:../?p=show-users");
    }
    if( isset($_POST["xoa"])){
        $idUser = filter_input(INPUT_POST, 'idUser');
        $sql = "
            DELETE FROM tb_user
            WHERE idUser = :idUser;
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $pre->execute();
        header("location:../?p=show-users");
    }
?>