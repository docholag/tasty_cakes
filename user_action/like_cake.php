<?php
    require_once "../admin/dbcon/ConDB.php";
    require_once "../admin/dbcon/function.php";
    $idUser = (int)$_GET["idUser"];
    $idCake = (int)$_GET["idCake"];
    $sql = "
        SELECT idLike FROM tb_banhyeuthich
        WHERE idUser = :idUser AND idCake = :idCake
    ";
    $pre = $conn->prepare($sql);
    $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
    $pre->execute();
    if($pre->rowCount() === 0){
        $sql = "
            INSERT INTO tb_banhyeuthich (idLike, idUser, idCake) VALUES (NULL, :idUser, :idCake);
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
        $pre->execute();
        $sql = "
            UPDATE tb_cakes 
            SET LuotThich = :like
            WHERE idCake = :idCake
        ";
        $pre = $conn->prepare($sql);
        $like = like_cake($idCake);
        $pre->bindParam(":like", $like, PDO::PARAM_INT);
        $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
        $pre->execute();
        echo like_cake($idCake);
    }else{
        echo '<script>alert("Bạn đã thích bánh này rồi !!!!");</script>';
        echo like_cake($idCake);
    }
    
?>