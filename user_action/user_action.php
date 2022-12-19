<?php
    session_start();
    require_once "../admin/dbcon/ConDB.php";
    if(isset($_POST["regis"])){
        if($_POST["eml"] !==  "" && $_POST["tdndk"] !==  "" && $_POST["pwdk"] !==  "" ){
            $eml = $_POST["eml"];
            $tdn = $_POST["tdndk"];
            $pw = $_POST["pwdk"];
            $hpw = password_hash($pw, PASSWORD_DEFAULT);
            $checktk = "
                SELECT idUser FROM tb_user
                WHERE TaiKhoan = :tdn
                
            ";
            $pre = $conn->prepare($checktk);
            $pre->bindParam(":tdn", $tdn, PDO::PARAM_STR);
            $pre->execute();
            $counttk = $pre->rowCount();
            $checkeml = "
                SELECT idUser FROM tb_user
                WHERE Email = :eml
                
            ";
            $pre = $conn->prepare($checkeml);
            $pre->bindParam(":eml", $eml, PDO::PARAM_STR);
            $pre->execute();
            $counteml = $pre->rowCount();
            if( $counteml > 0){
                echo '<script>alert("Email đã tồn tại !!!");</script>';
                echo '<script> window.history.back(); </script>';
            }else if($counttk > 0){
                echo '<script>alert("Tên đăng nhập đã tồn tại");</script>';
                echo '<script> window.history.back(); </script>';
            }else if($counteml === 0 && $counttk === 0){
                $sql = "
                    INSERT INTO tb_user (idUser, Email, SDT, TaiKhoan, MatKhau, Avatar, HoTen, DiaChi, idLU) 
                    VALUES (NULL, :eml, '', :tdn, :pw, 'unknow.jpg', '', '', '2');
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":eml", $eml, PDO::PARAM_STR);
                $pre->bindParam(":tdn", $tdn, PDO::PARAM_STR);
                $pre->bindParam(":pw", $hpw, PDO::PARAM_STR);
                $pre->execute();
                echo '<script>alert("Đăng ký thành công !!!!");</script>';
                header("Location: ../");
            }
        }else{
            echo '<script>alert("Yêu cầu nhập đầy đủ");</script>';
        }
    }
    if(isset($_POST["login"])){
        if($_POST["email"] !==  "" && $_POST["pass"] !==  ""){
            $email = $_POST["email"];
            $pw = $_POST["pass"];
            $hpw = "";
            $sql = "
                SELECT * FROM tb_user 
                WHERE Email = :email
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":email", $email, PDO::PARAM_STR);
            $pre->execute();
            if($pre->rowCount() > 0){
                $acc = $pre->fetchAll();
                foreach($acc as $row){
                    if (password_verify($pw, $row["MatKhau"])) {
                        $_SESSION["idUser"] = $row["idUser"];
                        $_SESSION["TaiKhoan"] = $row["TaiKhoan"];
                        $_SESSION["img"] = $row["Avatar"];
                        $_SESSION["loai"] = $row["idLU"];
                        $_SESSION["HoTen"] = $row["HoTen"];
                        $_SESSION["Email"] = $row["Email"];
                        $_SESSION["DiaChi"] = $row["DiaChi"];
                        $_SESSION["SDT"] = $row["SDT"];
                        unset($_SESSION['stk']);
                        header("Location: ../");
                    }else {
                        $_SESSION["stk"] = "Sai mật khẩu !!!";
                        // echo '<script>alert("Yêu cầu nhập đầy đủ");</script>';
                        echo '<script> window.history.back();</script>';
                    }
                }
            }else {
                $_SESSION["stk"] = "Email không tồn tại !!!";
                // echo '<script>alert("Yêu cầu nhập đầy đủ");</script>';
                echo '<script> window.history.back();</script>';
            }
        }else{
            //echo '<script>alert("Yêu cầu nhập đầy đủ");</script>';
            //echo '<script> window.history.back();</script>';
        }
    }
    if(isset($_POST["dang"])){
        if($_POST["cmt"] !==  ""){
            $cmt = $_POST["cmt"];
            $idUser = $_POST["idUser"];
            $idCake = $_POST["idCake"];
            $sql = "
                INSERT INTO tb_comment (idCmt, idUser, idCake, NoiDung, NgayTao) 
                VALUES (NULL, :idUser, :idCake, :cmt, CURRENT_TIME());
            ";
            $pre = $conn->prepare($sql);
            $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $pre->bindParam(":idCake", $idCake, PDO::PARAM_INT);
            $pre->bindParam(":cmt", $cmt, PDO::PARAM_STR);
            $pre->execute();
            header("Location: ../?p=cake&idCake=".$idCake."name=".$_POST["name"]);
        }else{
            echo '<script>alert("Yêu cầu nhập đầy đủ");</script>';
            echo "<script> window.history.back(); </script>";
        }
    }
    if(isset($_POST["changeAva"])){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $expensions= array("jpeg","jpg","png");
        if( $_FILES["avatar"]['name'] !== "" ){
            $anh = $_FILES['avatar']['name'];
            $idUser = $_POST["idUser"];
            $duoi = pathinfo($anh, PATHINFO_EXTENSION);

            if( in_array($duoi, $expensions) === TRUE){
                $img = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;
                while(file_exists("../public/img/user/".$img)){
                    $img = substr(str_shuffle($permitted_chars), 0, 16)."_".$anh;
                }

                move_uploaded_file($_FILES['avatar']['tmp_name'], "../public/img/user/".$img);

                $sql = "
                    UPDATE tb_user 
                    SET Avatar = :img
                    WHERE idUser = :idUser
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $pre->bindParam(":img", $img, PDO::PARAM_STR);
                $pre->execute();
                header("location:../?p=profile");
            }else{
                echo "<script> window.history.back(); </script>";
                echo "<script> alert('Chỉ nhận file ảnh !!!'); </script>";
            }
        }else {
            echo "<script> window.history.back(); </script>";
            echo "<script> alert('Vui lòng nhập đầy đủ'); </script>";
        }
    }
    if(isset($_POST["update"])){
        $idUser = $_POST["idUser"];
        $hvt = $_POST["hvt"];
        $sdt = $_POST["sdt"];
        $dc = $_POST["dc"];
        $sql = "
            UPDATE tb_user 
            SET HoTen = :hvt,
                SDT = :sdt,
                DiaChi = :dc
            WHERE idUser = :idUser
        ";
        $pre = $conn->prepare($sql);
        $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $pre->bindParam(":hvt", $hvt, PDO::PARAM_STR);
        $pre->bindParam(":dc", $dc, PDO::PARAM_STR);
        $pre->bindParam(":sdt", $sdt, PDO::PARAM_STR);
        $pre->execute();
        header("location:../?p=profile");
        
    }
    if(isset($_POST["changePass"])){
        if($_POST["oldpass"] !==  "" && $_POST["newpass"] !==  "" && $_POST["rnewpass"] !==  ""){
            if($_POST["newpass"] === $_POST["rnewpass"]){
                $old = $_POST["oldpass"];
                $new = $_POST["newpass"];
                $idUser = $_POST["idUser"];
                $hpw = "";
                $sql = "
                    SELECT * FROM tb_user 
                    WHERE idUser = :idUser
                ";
                $pre = $conn->prepare($sql);
                $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $pre->execute();
                $acc = $pre->fetchAll();
                foreach($acc as $row){
                    if (password_verify($old, $row["MatKhau"])) {
                        $hpw = password_hash($new, PASSWORD_DEFAULT);
                        $sql = "
                            UPDATE tb_user 
                            SET MatKhau = :hpw
                            WHERE idUser = :idUser
                        ";
                        $pre = $conn->prepare($sql);
                        $pre->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                        $pre->bindParam(":hpw", $hpw, PDO::PARAM_STR);
                        $pre->execute();
                        header("location:../?p=profile");
                    }else {
                        echo '<script>alert("Sai mật khẩu !!!");</script>';
                        echo '<script> window.history.back();</script>';
                    }
                }
            }else{
                echo '<script>alert("Nhập lại mật khẩu mới sai !!!");</script>';
                echo '<script> window.history.back();</script>';
            }
        }else{
            echo '<script>alert("Yêu cầu nhập đầy đủ !!!");</script>';
            echo '<script> window.history.back();</script>';
        }
    }
?>