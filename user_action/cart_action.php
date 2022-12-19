<?php
    session_start(); 
    require_once "../admin/dbcon/ConDB.php";

    if(isset($_POST["add-cart"])){
        $idCake = $_POST["idCake"];
        $soluong = $_POST["soluong"];
        $price = "";
        $ten = "";
        $anh = "";
        $tenkd = "";
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
        foreach($pre->fetchAll() as $row){
            $price = $row["GiaGiam"];
            $ten = $row["TenBanh"];
            $anh = $row["Anh"];
            $tenkd = $row["TenKD"];
        }
        $item = [
            'id' => $idCake,
            'name' => $ten,
            'namekd' => $tenkd,
            'img' => $anh,
            'price' => $price,
            'quantity' => $soluong
        ];
        if(isset($_SESSION["cart"][$idCake])){
            $_SESSION["cart"][$idCake]['quantity'] += $soluong;
        }else{
            $_SESSION["cart"][$idCake] = $item;
        }
        header("Location: ../?p=cake&idCake=".$idCake."&name=".$tenkd);
    }
    if(isset($_POST["buy-now"])){
        $idCake = $_POST["idCake"];
        $soluong = $_POST["soluong"];
        $price = "";
        $ten = "";
        $anh = "";
        $tenkd = "";
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
        foreach($pre->fetchAll() as $row){
            $price = $row["GiaGiam"];
            $ten = $row["TenBanh"];
            $anh = $row["Anh"];
            $tenkd = $row["TenKD"];
        }
        $item = [
            'id' => $idCake,
            'name' => $ten,
            'namekd' => $tenkd,
            'img' => $anh,
            'price' => $price,
            'quantity' => $soluong
        ];
        if(isset($_SESSION["cart"][$idCake])){
            $_SESSION["cart"][$idCake]['quantity'] += $soluong;
        }else{
            $_SESSION["cart"][$idCake] = $item;
        }
        header("Location: ../?p=cart");
    }
    if(isset($_POST["delete"])){
        unset($_SESSION["cart"][$_POST["idCake"]]);
        header("Location: ../?p=cart");
    }
    if(isset($_POST["update"])){
        $_SESSION["cart"][$_POST["idCake"]]['quantity'] = $_POST["quantity"];
        header("Location: ../?p=cart");
    }
    if(isset($_POST["thanh-toan"])){
        $tenkh = $_POST["tenkh"];
        $sdt = $_POST["sdt"];
        $dc = $_POST["dc"];
        $ghichu = $_POST["ghichu"];
        $tongtien = $_POST["tongtien"];
        $idUser =  (isset($_SESSION["idUser"])) ? $_SESSION["idUser"] : 1;
        if($tenkh !== "" && $sdt !== "" && $dc !== ""){
            if($idUser !== 1){
                $sql = "
                    UPDATE tb_user
                    SET HoTen = :hoten,
                        DiaChi = :dc,
                        SDT = :sdt
                    WHERE idUser = :idUser
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":hoten", $tenkh, PDO::PARAM_STR);
                $pre->bindParam(":sdt", $sdt, PDO::PARAM_STR);
                $pre->bindParam(":dc", $dc, PDO::PARAM_STR);
                $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $pre->execute();
            }
            $sql = "
                INSERT INTO tb_order (idOrder, TenKH, SDT, NoiNhan, GhiChu, TongTien, ThoiGian, idUser, idOS) 
                VALUES (NULL, :tenkh, :sdt, :dc, :ghichu, :tongtien, CURRENT_TIME(), :idUser, '1');
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":tenkh", $tenkh, PDO::PARAM_STR);
            $pre->bindParam(":sdt", $sdt, PDO::PARAM_STR);
            $pre->bindParam(":dc", $dc, PDO::PARAM_STR);
            $pre->bindParam(":ghichu", $ghichu, PDO::PARAM_STR);
            $pre->bindParam(":tongtien", $tongtien, PDO::PARAM_INT);
            $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $pre->execute();
            $idDH = $conn->lastInsertId();
            $ctdh = "";
            
            $cart = (isset($_SESSION["cart"])) ? $_SESSION["cart"] : [];
            $count = 1;
            foreach($cart as $key){
                $daban = 0;
                $ctdh .= "('null', '".$key["id"]."', '".$key["price"]."', '".$key["quantity"]."', '".$idDH."')";
                $sql = "
                    SELECT * FROM tb_cakes
                    WHERE idCake = :idCake
                    
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":idCake", $key["id"], PDO::PARAM_INT);
                $pre->execute();
                foreach($pre->fetchAll() as $row){
                    $daban = $row["DaBan"];
                }
                $daban += $key["quantity"];
                $sql = "
                    UPDATE tb_cakes
                    SET DaBan = :sell
                    WHERE idCake = :idCake;
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":idCake", $key["id"], PDO::PARAM_INT);
                $pre->bindParam(":sell", $daban, PDO::PARAM_INT);
                $pre->execute();
                // kiểm tra mảng để thêm dấu phẩy
                if( $count !== count($cart)){
                    $ctdh .= ",";
                    $count ++;
                }
            }
            
            $sql = "INSERT INTO tb_orderdetail (idOD, idCake, DonGia, SoLuong, idOrder) VALUES".$ctdh;
            $pre = $conn->prepare($sql);
            $pre->execute();
            unset($_SESSION["cart"]);
            $_SESSION["tb"] = 1;
            header("Location: ../");
        }else{
            echo "<script> alert('Vui lòng nhập những thông tin bắt buộc !!!'); </script>";
            echo "<script> window.history.back(); </script>";
        }
    }
?>