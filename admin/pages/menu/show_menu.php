
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cơ Sở Dữ Liệu</h1>
<p class="mb-4">Quản lý các thông tin của trang web</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Quản lý Menu bánh:
        </h6>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loại bánh</th>
                        <th><a href="javascript:void(0)" onclick="document.getElementById('loaicake').style.display='block'">Thêm</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $loais = all_loai();
                        foreach($loais as $loai):
                    ?>
                    <tr>
                        <td><?php echo $loai["idLC"]; ?></td>
                        <td><?php echo $loai["LoaiCake"]; ?></td>
                        <td>
                            <form action="././action/menu_action.php" method="post" style="display: inline;" 
                                onsubmit='return confirm("Bạn có chắc là muốn xóa loại bánh: <?php echo $loai["LoaiCake"]; ?> không ???")'>
                                <input type="hidden" name="idLC" value="<?php echo $loai["idLC"]; ?>">
                                <button type="submit" name="xoa" class="btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
            <!-- thêm loại bánh -->
            <div id="loaicake" class="modal">
                <form class="modal-content animate" action="././action/menu_action.php" method="post" enctype='multipart/form-data'>
                    <div class="form form-them-banh" style="width: 50%;">
                        <span onclick="document.getElementById('loaicake').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <h4>Thêm Loại Bánh</h4>
                        <label for="loaicake">Loại bánh: </label>
                        <input type="text"  name="loaicake" class="form-control form-control-sm in-s"><br>
                        <button type="submit" name="add" class="btn-sub">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

