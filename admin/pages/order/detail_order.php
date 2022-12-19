<?php
    require "../../dbcon/ConDB.php";
    $idOrder = (int)$_GET["idOrder"];
    $sql = "
        SELECT * FROM tb_orderdetail
        INNER JOIN tb_cakes
        ON tb_orderdetail.idCake = tb_cakes.idCake
        WHERE tb_orderdetail.idOrder = :id
    ";
    $pre = $conn->prepare($sql);
    $pre->bindParam(":id", $idOrder, PDO::PARAM_INT);
    $pre->execute();
?>

<span onclick="document.getElementById('detail').style.display='none'" class="close" title="Close Modal">&times;</span>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Bánh</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($pre->fetchAll() as $row):
        ?>
            <tr>
                <td><?php echo $row["TenBanh"]; ?></td>
                <td><?php echo number_format($row["DonGia"], 0, ",", "."); ?></td>
                <td><?php echo $row["SoLuong"]; ?></td>
                <td><?php echo number_format($row["DonGia"]*$row["SoLuong"], 0, ",", "."); ?></td>
            </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>