<?php
	$idCake = (int)$_GET["idCake"];
	$cake = info_cake($idCake);
	foreach($cake as $c):
		$pt = 100 - (($c["GiaGiam"]*100)/$c["GiaGoc"]);
        $pt = round($pt, 0, PHP_ROUND_HALF_UP);
?>

<div class="container content pb-5">
	<h4 class="float-left de py-3">CHI TIẾT BÁNH:</h4>
	<div class="cart-container row mx-0 justify-content-md-center container page-wrapper page-checkout ">
		<div class="col-10 col-sm-10 col-md-9 col-xl-6 col-lg-10 mrx">
			<div class="ima darius px-5 py-5"><img class="fix-img" src="public/img/cakes/<?php echo $c["Anh"]; ?>" alt=""></div>
		</div>
		<div class="col-10 col-sm-10 col-md-9 col-xl-6 col-lg-10 mrs">
			<form action="user_action/cart_action.php" method="post">
				<div class="darius px-5 pb-4 pt-3"> 
					<table style="margin: auto;">
					  	<thead>
						    <tr class="_">
						      	<th class="py-1 product-name text-dark" colspan="2"><h5 class="col pl-0"><?php echo $c["TenBanh"]; ?></h5></th>
								<td class="py-1 product-name text-dark" colspan="2"><span id="like"><?php echo like_cake($idCake); ?></span> ❤</td>
						    </tr>
					  	</thead>
					  	<tbody class="px-3">
						    <tr>
								<td class="px-5 bottum pt-3" colspan="2">
									<ul class="mb-0" style="display: flex;">
										<li class="font-weight-bold"><span style="line-height: 45px;">Giá</span> <span class="cor pl-2"><?php echo number_format($c["GiaGiam"], 0, ",", "."); ?> đ</span></li>
										<li class="margin-left-auto"><span class=" pl-3">-<?php echo $pt; ?>%</span></li>
									</ul>
								</td>
						    </tr>
						    <tr>
								<td class="px-5 bottum" colspan="2">
									<ul style="display: flex;">
										<li class="font-weight-bold" style="font-size: 18px;"><del><?php echo number_format($c["GiaGoc"], 0, ",", "."); ?> đ</del></li>
									</ul>
								</td>
						    </tr>
						    <tr style="border-bottom: 2px solid #33ccff">
						      <td class="px-5 pt-2 bottum" colspan="2">
						      	<ul style="display: flex;">
						      		<li class="font-weight-bold"><span>Số lượng</span>
						      			<div class="buttons_added pl-2">
											<input class="minus is-form" type="button" value="-">
											<input aria-label="quantity" class="input-qty" min="1" name="soluong" type="number" value="1">
											<input class="plus is-form" type="button" value="+">
											<input name="idCake" type="hidden" value="<?php echo $c["idCake"]; ?>">
										</div>
						      		</li>
						      	</ul>
						      </td>
						    </tr>
					  	</tbody>
					</table>
					<div class="row mx-0 justify-content-md-center" style="padding-top: 10%;">
			      		<div class="col-5 col-xl-5 col-md-5 col-sm-6  col-lg-4 ">
			      			<button type="submit" style="width:auto;" class="thanhtoan px-2 py-2" name="add-cart" onclick="alert('Đã thêm vào giỏ hàng')">VÀO GIỎ HÀNG</button>
			      		</div>
			      		<div class="col-4 col-xl-4 col-md-4 col-sm-4 col-lg-3">
			      			<button type="submit" style="width:auto;" class="thanhtoan px-2 py-2" name="buy-now">MUA NGAY</button>
			      		</div>
			      		<div class="col-1 col-xl-1 col-md-1 col-sm-1 col-lg-1">
			      			<a href="javascript:void(0)" onclick="clickLike(this)" data-idc="<?php echo $idCake; ?>" 
							data-idu="<?php $idUser = (isset($_SESSION["idUser"])) ? $_SESSION["idUser"] : 1;echo $idUser;  ?>">
							  	<i title="Thêm vào yêu thích" class=" faheart fa fa-heart" aria-hidden="true"></i>
							</a>
			      		</div>
			      	</div>
				</div>
			</form>
		</div>
	</div>

</div>




<div class="container py-5">
	<div class="tab">
		<!-- <button class="tablinks" onclick="openC(event, 'mota')" id="defaultOpen">Mô tả</button> -->
		<button class="tablinks" onclick="openC(event, 'danhgia')">Đánh giá</button>
	</div>

	<div id="mota" class="tabcontent py-3 px-3">
		<h5>
			<?php echo $c["MoTa"]; ?>
		</h5>
	</div>

	<div id="danhgia" class="tabcontent py-3 px-3 container">
		<?php
			if(!isset($_SESSION["idUser"])){
				echo "Vui lòng <a href='javascript:void(0)' style='color:#007bff' onclick='document.getElementById(`id01`).style.display=`block`'>Đăng nhập</a> để bình luận";
			}else{
				require_once 'pages/cmt.php';
			}
		?>
	</div>
</div>


<script>
	function openC(evt, cName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cName).style.display = "block";
		evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	function clickLike(ele){
		const idUser = ele.getAttribute("data-idu");
		const idCake = ele.getAttribute("data-idc");
		if(idUser == 1){
			alert("Vui lòng đăng nhập để thích bánh này !!!");
			document.getElementById(`id01`).style.display=`block`;
		}else{
			$.get("user_action/like_cake.php", {idUser:idUser, idCake:idCake}, function(data){
				$("#like").html(data);
			});
		}
		
	}
</script>
<?php
	endforeach;
?>