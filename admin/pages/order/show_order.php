
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cơ Sở Dữ Liệu</h1>
<p class="mb-4">Quản lý các thông tin của trang web</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Quản lý Đơn hàng:
        </h6>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Nơi nhận</th>
                        <th>Ghi chú</th>
                        <th>Tổng tiền</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $orders = all_orders();
                        foreach($orders as $order):
                    ?>
                    <tr>
                        <td><?php echo $order["idOrder"]; ?></td>
                        <td><?php echo $order["TenKH"]; ?></td>
                        <td><?php echo $order["SDT"]; ?></td>
                        <td><?php echo $order["NoiNhan"]; ?></td>
                        <td><?php echo $order["GhiChu"]; ?></td>
                        <td><?php echo number_format($order["TongTien"], 0, ",", "."); ?></td>
                        <td><?php echo $order["ThoiGian"]; ?></td>
                        <td>
                            <a href="javascript:void(0)" data-stt="<?php echo $order["idOS"]; ?>" data-id="<?php echo $order["idOrder"]; ?>" 
                            onclick="changeStt(this)" title="Nhấn để đổi trạng thái đơn hàng">
                                <?php echo $order["TrangThai"]; ?>
                            </a>
                        </td>
                        <td>
                            <form action="././action/order_action.php" method="post" style="display: inline;" 
                                onsubmit='return confirm("Bạn có chắc là muốn xóa đơn hàng này không ???")'>
                                <input type="hidden" name="idOrder" value="<?php echo $order["idOrder"]; ?>">
                                <button type="submit" name="xoa" class="btn-delete">Xóa</button>
                            </form> |
                            <a href="javascript:void(0)" data-id="<?php echo $order["idOrder"]; ?>" onclick="detailOrder(this)">Chi tiết</a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
            <!-- chi tiết đơn hàng -->
            <div id="detail" class="modal modal-content animate">
                
            </div>

            <!-- đổi trạng thái đơn hàng -->
            <div id="changestt" class="modal">
                
            </div>
        </div>
    </div>
</div>
</div>

