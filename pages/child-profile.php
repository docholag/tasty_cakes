<?php
    $idUser = $_SESSION["idUser"];
    $user = user_info($idUser);
    foreach($user as $us):
?>


<div class="container mb-0" style="overflow: hidden; background-color:#fff;">
    <div class="row py-3" id="hea">
        <div class="col-6">
            <h5 style="float: left;">LỊCH SỬ GIAO DỊCH: </h5>
        </div>
    </div>
    <div id="tb" style="overflow:auto; ">
        <table style="width: 100%;float: left;">
            <thead style="border: 1px solid #000;">
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Số tiền</th>
                    <th>Địa chỉ</th>
                    <th>Ngày mua</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stt = 1;
                    foreach(order_user($idUser) as $or):
                ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $or["idOrder"]; ?></td>
                    <td><?php echo number_format($or["TongTien"], 0, ",", "."); ?> đ</td>
                    <td><?php echo $or["NoiNhan"]; ?></td>
                    <td><?php echo $or["ThoiGian"]; ?></td>
                    <td style="<?php if($or["idOS"] == 1){echo "color:red;";}if($or["idOS"] == 2){echo "color:oregan;";}if($or["idOS"] == 3){echo "color:green;";} ?>"><?php echo $or["TrangThai"]; ?></td>
                </tr>
                <?php
                    $stt++;
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    endforeach;
?>