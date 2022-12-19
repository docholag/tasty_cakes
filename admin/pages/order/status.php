<?php
    require "../../dbcon/function.php";
    $idStt = (int)$_GET["idStt"];
    $idOrder = $_GET["idOrder"];
?>

<form class="modal-content animate" action="././action/order_action.php" method="post" enctype='multipart/form-data'>
    <div class="form form-them-banh" style="width: 50%;">
        <span onclick="document.getElementById('changestt').style.display='none'" class="close" title="Close Modal">&times;</span>
        <h4>Đổi trạng thái</h4>
        <label for="stt">Trạng thái: </label>
        <select name="stt" class="form-control form-control-sm in" style="width:50%;">
            <?php
                $status = status_order();
                foreach( $status as $stt ):
            ?>
                <option value="<?php echo $stt["idOS"]; ?>" <?php if($stt["idOS"] == $idStt){echo "selected";} ?>><?php echo $stt["TrangThai"]; ?></option>
            <?php
                endforeach;
            ?>
        </select><br>
        <input type="hidden" name="idOrder" value="<?php echo $idOrder; ?>">
        <button type="submit" name="changestt" class="btn-sub">Đổi</button>
    </div>
</form>