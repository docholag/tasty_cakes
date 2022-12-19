
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cơ Sở Dữ Liệu</h1>
<p class="mb-4">Quản lý các thông tin của trang web</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Quản lý bánh:
        </h6>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên bánh</th>
                        <th>Loại bánh</th>
                        <th>Giá bán</th>
                        <th>Ảnh</th>
                        <th>Đã bán</th>
                        <th>Tình trạng</th>
                        <th><a href="javascript:void(0)" onclick="document.getElementById('cake').style.display='block'">Thêm</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $cakes = all_cakes();
                        foreach($cakes as $cake):
                    ?>
                    <tr>
                        <td><?php echo $cake["TenBanh"]; ?></td>
                        <td><?php echo $cake["LoaiCake"]; ?></td>
                        <td><?php echo number_format($cake["GiaGiam"], 0, ",", "."); ?></td>
                        <td><img src="../public/img/cakes/<?php echo $cake["Anh"]; ?>" alt="" width="85px" srcset=""></td>
                        <td><?php echo $cake["DaBan"]; ?></td>
                        <td>
                            <?php echo $cake["TrangThai"]; ?> <br>
                            <form action="././action/cake_action.php" method="post" style="display: inline;" >
                                <input type="hidden" name="idCake" value="<?php echo $cake["idCake"]; ?>">
                                <input type="hidden" name="status" value="<?php echo $cake["idTTC"]; ?>">
                                <button type="submit" name="changett" class="btn-delete">Đổi trạng thái</button>
                            </form>
                        </td>
                        <td>
                            <a href="./?p=sua-cake&idCake=<?php echo $cake["idCake"]; ?>">Sửa</a> | 
                            <form action="././action/cake_action.php" method="post" style="display: inline;" 
                                onsubmit='return confirm("Bạn có chắc là muốn xóa bánh: <?php echo $cake["TenBanh"]; ?> không ???")'>
                                <input type="hidden" name="idCake" value="<?php echo $cake["idCake"]; ?>">
                                <input type="hidden" name="anh" value="<?php echo $cake["Anh"]; ?>">
                                <button type="submit" name="xoa" class="btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
            <!-- thêm bánh -->
            <div id="cake" class="modal">
                <form class="modal-content animate" action="././action/cake_action.php" method="post" enctype='multipart/form-data'>
                    <div class="form form-them-banh">
                        <span onclick="document.getElementById('cake').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <h4>Thêm Bánh</h4>
                        <label for="cake">Tên bánh: </label>
                        <input type="text"  name="cake" class="form-control form-control-sm in-s"><br>
                        <label for="giagoc">Giá gốc: </label>
                        <input type="number"  name="giagoc" class="form-control form-control-sm in-s"><br>
                        <label for="giagiam">Giá giảm: </label>
                        <input type="number"  name="giagiam" class="form-control form-control-sm in-s"><br>
                        <label for="loaicake">Loại bánh: </label>
                        <select name="loaicake" class="form-control form-control-sm in-s" >
                            <?php
                                $loai = all_loai();
                                foreach( $loai as $l ):
                            ?>
                                <option value="<?php echo $l["idLC"]; ?>"><?php echo $l["LoaiCake"]; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select> <br>
                        <label for="mota">Mô tả bánh: </label>
                        <textarea class="ckeditor" name="mota"></textarea> <br>
                        <label for="img">Ảnh bánh: </label>
                        <input type="file" name="img" id="img" /> <br>
                        <button type="submit" name="add" class="btn-sub">Thêm</button>
                    </div>
                </form>
            </div>

            <!-- sửa bánh -->
            <div id="edit-cake" class="modal">
                <form class="modal-content animate" action="././action/cake_action.php" method="post" enctype='multipart/form-data'>
                    <div class="form form-them-banh">
                        <span onclick="document.getElementById('cake').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <h4>Thêm Bánh</h4>
                        <label for="cake">Tên bánh: </label>
                        <input type="text"  name="cake" class="form-control form-control-sm in-s" id="tenbanh"><br>
                        <label for="giagoc">Giá gốc: </label>
                        <input type="number"  name="giagoc" class="form-control form-control-sm in-s" id="giagoc"><br>
                        <label for="giagiam">Giá giảm: </label>
                        <input type="number"  name="giagiam" class="form-control form-control-sm in-s" id="giagiam"><br>
                        <label for="loaicake">Loại bánh: </label>
                        <select name="loaicake" id="loaicake" class="form-control form-control-sm in-s" >
                            <?php
                                $loai = all_loai();
                                foreach( $loai as $l ):
                            ?>
                                <option value="<?php echo $l["idLC"]; ?>"><?php echo $l["LoaiCake"]; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select> <br>
                        <label for="mota">Mô tả bánh: </label>
                        <textarea id="mota" class="ckeditor" name="mota"></textarea> <br>
                        <label for="img">Ảnh bánh: </label>
                        <input type="file" name="img" id="img" /> <br>
                        <img src="../public/img/cakes/<?php echo $c["Anh"]; ?>" alt="" srcset="" style="width:20%"> <br>
                        <button type="submit" name="sua" class="btn-sub">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

