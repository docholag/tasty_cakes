<?php
	$cart = (isset($_SESSION["cart"])) ? $_SESSION["cart"] : [];
	$total = 0;
?>

		<!-- Content -->
<div class="container-fluid content pb-5">
	<h4 class="float-left de pl-5 py-3 ml-5">GIỎ HÀNG CỦA BẠN:</h4>
	<div class="cart-container row mx-0 container page-wrapper page-checkout product">
		<div  class="col-12 col-sm-12 col-md-12 col-xl-8 col-lg-12">
			<table>
			  	<thead>
				    <tr class="_">
						<th class=" py-1 product-name width-7" colspan="4">Sản phẩm</th>
						<th class=" py-1 text-center width-1">Giá</th>
						<th class=" py-1 width-1">Số Lượng</th>
						<th class=" py-1 text-center width-1 nole"> Tổng</th>
				    </tr>
			  	</thead>
			  	<tbody>
			  		<!--=======Lặp sản phẩm trong giỏ hàng =========-->
					<?php
						foreach($cart as $key):
					?>
				    <tr class="bottum">
						<td colspan="2">
							<form action="user_action/cart_action.php" method="post">
								<input type="hidden" name="idCake" value="<?php echo $key["id"]; ?>">
								<button class="remove" name="delete" title="Xóa sản phẩm này">×</button>
							</form>
						</td>
						<td class="product-thumbnail">
							<a href="./?p=cake&idCake=<?php echo $key["id"]; ?>&name=<?php echo $key["namekd"]; ?>">
								<img width="100" height="100" src="public/img/cakes/<?php echo $key["img"]; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" sizes="(max-width: 100px) 100vw, 100px">
							</a>
						</td>
						<td class="product-name" data-title="Sản phẩm">
							<a href="./?p=cake&idCake=<?php echo $key["id"]; ?>&name=<?php echo $key["namekd"]; ?>"><?php echo $key["name"]; ?></a>
						</td>
						<td class="pl-2"><?php echo number_format($key["price"], 0, ",", "."); ?> đ</td>
						<td>
							<div class="buttons_added">
								<form action="user_action/cart_action.php" method="post">
									<input class="minus is-form" type="button" value="-">
									<input aria-label="quantity" class="input-qty" max="10" min="1" name="quantity" type="number" value="<?php echo $key["quantity"]; ?>">
									<input class="plus is-form" type="button" value="+"> <br>
									<input type="hidden" name="idCake" value="<?php echo $key["id"]; ?>">
									<button type="submit" name="update" style="background: none;padding: 7px;color:#000;">Cập nhật</button>
								</form>
							</div>
						</td>
						<td class="text-end nole"><?php echo number_format($key["quantity"]*$key["price"], 0, ",", "."); ?> đ</td>
				    </tr>
					<?php
						$total += $key["quantity"]*$key["price"];
						endforeach;
					?>
				    <!--======= Ở trên lặp sản phẩm trong giỏ hàng -->
				    <tr>
				    	<td colspan="6" class="actions clear py-5">
				    		<div class="continue-shopping pull-left hide-for-small text-left mr-half">
				    			<a class="continue py-2 font-weight-bold" href="./">← Tiếp tục mua sắm</a>
							</div>
						</td>
					</tr>
			  	</tbody>
			</table>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-xl-4 col-lg-12 mrs">
			<table>
			  	<thead>
				    <tr class="_">
				      <th class="text-center py-1 product-name text-dark imp" colspan="2">TỔNG ĐƠN HÀNG</th>
				    </tr>
			  	</thead>
			  	<tbody class="px-3">
				    <tr>
						<td class="px-5 bottum" colspan="2">
							<ul style="display: flex;">
								<li class="font-weight-bold">Số tiền </li>
								<li class="margin-left-auto"> <?php echo number_format($total, 0, ",", "."); ?>đ</li>
							</ul>
						</td>
				    </tr>
				    <tr>
						<td class="px-5 bottum" colspan="2">
							<ul style="display: flex;">
								<li class="font-weight-bold"><input type="text" placeholder="Mã giảm giá" id="mgg"> </li>
								<li style="font-size: 13px; text-align: center;" class="lgout margin-left-auto"> <a href="javascript:void(0)" onclick="checkMGG()">Áp dụng</a></li>
							</ul>
						</td>
				    </tr>
					<tr>
						<td class="px-5 bottum" colspan="2">
							<h4>TỔNG CỘNG: <span id="thanhtoan"><?php echo number_format($total, 0, ",", "."); ?> đ</span> </h4>
						</td>
				    </tr>
				    <tr>
						<td class="px-5 pt-5 text-center nopadding" colspan="2">
							<a href="javascript:void(0)" onclick="document.getElementById('id03').style.display='block'" style="width:auto;" class="thanhtoan px-3 py-3">TIẾN HÀNH THANH TOÁN</a>
						</td>
				    </tr>
			  	</tbody>
			</table>
			<div id="id03" class="modal pt-5">
				<form class="modal-content animate" action="user_action/cart_action.php" method="post" onsubmit="return checkTT()">
					<div class="imgcontainer">
						<span onclick="document.getElementById('id03').style.display='none'" class="closse" title="Close Modal">&times;</span>
						<h2 class="font-weight-bold">XÁC NHẬN ĐƠN HÀNG</h2>
						<hr style="width: 80%; margin: auto; color: #333333">
					</div>

					<div class="container chot">
						<div class="row mx-0 pt-3 pb-5">
							<div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6">
								<div class="addres"><h4>1. Xác nhận thông tin đơn hàng</h4></div>
								<div class="addres bor">
									<i class="mar fas fa-map-marker-alt "></i>
									<input id="searchLoction" placeholder="Nhập địa chỉ giao hàng" name="dc" title="Nhập địa chỉ giao hàng" value="<?php if(isset($_SESSION["idUser"])){echo $_SESSION["DiaChi"];}else{echo "";} ?>" type="text" class="uk-input">
								</div>
								<div class="addres bor">
									<i class="mar fas fa-user-circle"></i>
									<input type="text" placeholder="Người nhận" title="Người nhận"  name="tenkh" id="tenkh" value="<?php if(isset($_SESSION["idUser"])){echo $_SESSION["HoTen"];}else{echo "";} ?>" required>
								</div>
								<div class="addres bor">
									<i class=" mar fas fa-phone"></i>
									<input type="tel" id="phone" name="sdt" placeholder="Số điện thoại" title="Số điện thoại" value="<?php if(isset($_SESSION["idUser"])){echo $_SESSION["SDT"];}else{echo "";} ?>" required>
								</div>
								<div class="addres bor">
									<input type="text" placeholder="Ghi chú" title="Lưu ý của bạn" name="ghichu" id="ghichu">
								</div>
							</div>
							<div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6  mrs">
								<div class=""><h4>2. Hình thức thanh toán</h4></div>
									<div class="container pb-0 px-1">
										<div class="row mx-0 say">
											<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 px-0">
											<div class="pt-2"><input  type="radio" id="thanhtoan" name="thanhtoan" checked> <i class="gren fas fa-money-bill-wave"></i> Thanh toán khi nhận hàng</div>
											<div class="pt-2"><input  type="radio" id="thanhtoan" name="thanhtoan"> <i class="fas fa-money-check-alt"></i> Thẻ ATM nội địa</div>
											<div class="pt-2"><input  type="radio" id="thanhtoan" name="thanhtoan"> <img class="size" src="public/img/zalo.png" alt="ZaloPay"> ZaloPay</div>
										</div>
										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 px-0">
											<div class="pt-2"><input  type="radio" id="thanhtoan" name="thanhtoan"> <img class="size" src="public/img/visa.png" alt="ZaloPay"> Visa/Master/JCB</div>
											<div class="pt-2"><input  type="radio" id="thanhtoan" name="thanhtoan"> <img class="size" src="public/img/momo.png" alt=""> MoMo</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="text-center">
									<h3>Tổng: <small class="font-italic" id="tttt"><?php echo number_format($total, 0, ",", "."); ?> đ</small></h3>
									<hr>
									<div class="dk pb-4">
										<small>
											Bằng việc chọn "Đặt hàng", bạn đã đồng ý với 
											<a style="text-decoration:underline;" href="javascript:void(0)">Điều khoản sử dụng</a>, 
											và <a href="javascript:void(0)" style="text-decoration:underline;"> chính sách bảo mật thông tin</a> của Tasty Cakes.
										</small>
									</div>
									<div class="px-5 pt-3 text-center nopadding">
										<input type="hidden" name="tongtien" id="tongtien" value="<?php echo $total; ?>">
										<button class="thanhtoan px-3 py-3" name="thanh-toan" type="submit">ĐẶT HÀNG</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function checkTT(){
		const vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
		const dc = document.getElementById("searchLoction").value;
		const tenkh = document.getElementById("tenkh").value;
		const sdt = document.getElementById("phone").value;
		if(dc === "" || tenkh === "" || std === ""){
			alert("Vui lòng nhập đầy đủ thông tin cần thiết !!!");
			return false;
		} else if(reg.test(sdt) !== true){
			alert("Vui lòng nhập đúng định dạng số điện thoại !!!");
			return false;
		}else{
			//;
			return true;
		}
	}
	var check = 1;
	function checkMGG(){
		const mgg = document.getElementById("mgg").value;
		const tien = document.getElementById("tongtien").value;
		
		if(check === 1){
			$.get("user_action/magiamgia.php", {mgg:mgg, tien:tien, check:check}, function(data){
				$("#tttt").html(data);
				$("#thanhtoan").html(data);
				$("#ghichu").attr("value",data);
			});
			$.get("user_action/giamgia.php", {mgg:mgg, tien:tien, check:check}, function(data){
				$("#tongtien").attr("value",data);
			});
			check = 2;
		}else{
			alert("Bạn đã sử dụng mã giảm giá !!!");
		}
	}
</script>