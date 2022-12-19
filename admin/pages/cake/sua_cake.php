
<?php
    // require '../../dbcon/function.php';
    $idCake = (int)$_GET["idCake"];
    $cake = info_cake($idCake);
    foreach($cake as $c):
?>
<div class="container-fluid">
    <a href="./?p=show-cakes" title="Quay lại">Quay lại</a>
    <h1 class="h3 mb-2 text-gray-800">Sửa thông tin bánh:</h1>

    <div class="add-item">
        <form action="././action/cake_action.php" method="post" style="margin-top:25px;" enctype='multipart/form-data'>
            <label for="cake">Tên bánh: </label>
            <input type="text"  name="cake" class="form-control form-control-sm in" id="tenbanh" value="<?php echo $c["TenBanh"]; ?>"><br>
            <label for="giagoc">Giá gốc: </label>
            <input type="number"  name="giagoc" class="form-control form-control-sm in-s" id="giagoc" min='0' value="<?php echo $c["GiaGoc"]; ?>"><br>
            <label for="giagiam">Giá giảm: </label>
            <input type="number"  name="giagiam" class="form-control form-control-sm in-s" id="giagiam" min='0' value="<?php echo $c["GiaGiam"]; ?>"><br>
            <label for="loaicake">Loại bánh: </label>
            <select name="loaicake" id="loaicake" class="form-control form-control-sm in-s" >
                <?php
                    $loai = all_loai();
                    foreach( $loai as $l ):
                ?>
                    <option value="<?php echo $l["idLC"]; ?>" <?php if($l["idLC"] === $c["idLC"]){echo "selected";} ?>><?php echo $l["LoaiCake"]; ?></option>
                <?php
                    endforeach;
                ?>
            </select> <br>
            <label for="mota">Mô tả bánh: </label>
            <textarea id="mota" class="ckeditor" name="mota"><?php echo $c["MoTa"]; ?></textarea> <br>
            <label for="img">Ảnh bánh: </label>
            <input type="file" name="img" id="img" /> <br>
            <img src="../public/img/cakes/<?php echo $c["Anh"]; ?>" alt="" srcset="" style="width:20%"> <br>
            <input type="hidden" name="idCake" value="<?php echo $idCake; ?>">
            <input type="hidden" name="avatar" value="<?php echo $c["Anh"]; ?>">
            <button type="submit" name="sua" class="btn-sub">Sửa</button>
            <a href="./?p=show-cakes" title="Quay lại">Quay lại</a>
        </form>
    </div>
</div>
<?php
    endforeach;
?>