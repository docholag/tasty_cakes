<?php
	session_start();
    require_once "admin/dbcon/function.php";
    if( isset($_GET["p"]) ){
        $p = $_GET["p"];
	}else $p = "";
?>

<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<title>Tasty Cakes</title>
	<base href="http://localhost/tc/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<head>
	<?php 
		include('blocks/CDN.php');
	?>
</head>
<body oncontextmenu="return false" class="snippet-body">

	<?php 
		require_once 'blocks/head.php';
	?>

	<?php
		switch($p){

			case "home" : require "pages/child-index.php"; break;

			case "cake" : require "pages/child-detail.php"; break;
				if( isset($_GET["idCake"]) && isset($_GET["name"])){
					require "pages/child-detail.php"; break;
				}else{
					require "pages/child-index.php"; break;
				}

			case "cart" : require "pages/child-cart.php"; break;
			case "menu" : 
			    if( isset($_GET["idLC"]) && isset($_GET["loai"]) ){
			        require "pages/child-result-menu.php"; break;
			    }else{
			        require "pages/child-index.php"; break;
				}
			case "find" : 
				if( isset($_GET["q"]) ){
					require "pages/child-result-find.php"; break;
				}else{
					require "pages/child-index.php"; break;
				}
			case "profile" : 
				if( isset($_SESSION["idUser"]) ){
					require "pages/child-profile.php"; break;
				}else{
					require "pages/child-index.php"; break;
				}

			default : require "pages/child-index.php";
		}
	?>



 	<script src="public/js/main.js"></script>
	<?php
		if( isset($_SESSION["stk"]) ):
	?>
        <script>
			function erroLogin(){
				document.getElementById('id01').style.display='block';
				document.getElementById('erroLogin').innerHTML = "<?php echo $_SESSION["stk"]; ?>";
			}
			erroLogin();
		</script>
	<?php
		endif;
    ?>
	<?php
		if(isset($_SESSION["tb"])):
			if($_SESSION["tb"] === 1):		
	?>
		<div id="thanks" class="modal pt-5" style="display:block;">
			<div class="modal-content animate">
				<h3>Thông báo</h3>
				<h4>
					Cám ơn bạn đã đặt mua sản phẩm của cửa hàng chúng tôi. <br>
					Nhân viên của cửa hàng sẽ gọi điện đến để xác nhận đơn hàng.
				</h4>
				<a href="javascript:void(0)" onclick="document.getElementById('thanks').style.display='none'">Đóng</a>
			</div>
		</div>
	<?php
			$_SESSION["tb"]++;
			endif;
		endif;
	?>
</body>
</html>



