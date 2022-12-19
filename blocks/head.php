<?php
    $cart = (isset($_SESSION["cart"])) ? $_SESSION["cart"] : [];
?>
<!--Navigation-->
<div class="w3-top ">
  <div class="w3-bar w3-card w3-row head  py-3 px-4">
    <div class="w3-bar-item w3-col w3-container pt-2 topnav w3-hide-small" style="width:40%">
      <div class="w3-row">
        <div class="w3-col w3-container" style="width:33%">
          <a class="nav-link js-scroll-trigger font a" href="./">TRANG CHỦ</a>
        </div>
        <div class="w3-col w3-container element a" style="width:33%">
          <div class="w3-dropdown-hover nav-link js-scroll-trigger font">
            <button class="w3-button b js-scroll-trigger" id="w3">MENU</button>
            <div class="w3-dropdown-content fixe">
              <ul class="cent py-3">
                <?php
								$menu = all_loai();
								foreach($menu as $m):
							?>
                <li class="pb-3"><a href="./?p=menu&idLC=<?php echo $m["idLC"]; ?>&loai=<?php echo $m["LCKD"]; ?>"
                    class="w3-bar-item w3-button"><?php echo $m["LoaiCake"]; ?></a></li>
                <?php
								endforeach;
							?>
              </ul>
            </div>
          </div>
        </div>
        <div class="w3-col w3-container  element a" style="width:33%">
          <div class="w3-dropdown-hover nav-link js-scroll-trigger font">
            <button class="w3-button b js-scroll-trigger" onclick="window.location.href=''" id="w3">BÁNH MỚI</button>
          </div>
        </div>
      </div>
    </div>
    <div class="w3-col w3-container screen" style="width:20%">
      <a href="./" style="display: flex;justify-content: center;"><img class=" brand mr-8"
          src="public/img/coverPS.png"></a>
    </div>
    <div class="w3-bar-item w3-col w3-container w3-hide-small pt-2" style="width:40%">
      <div class="w3-row">
        <div class="w3-col w3-container" style="width:40%"><a class="nav-link js-scroll-trigger font a"
            href="javascript:void(0)">ĐÀO TẠO</a></div>
        <div class="w3-col w3-container" style="width:40%"><a class="nav-link js-scroll-trigger font a"
            href="javascript:void(0)">VỀ CHÚNG TÔI</a></div>
        <div class="w3-col w3-container" style="width:20%"><a class="nav-link js-scroll-trigger font a"
            href="javascript:void(0)">HỖ TRỢ</a></div>
      </div>
    </div>
  </div>
</div>
<!-- hide -->
<div id="navDemo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium wid w3-top w3-right" style="z-index: 50;">
  <a href="./" class="w3-bar-item w3-button w3-right padding js-scroll-trigger" onclick="myFunction()">TRANG CHỦ</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right padding js-scroll-trigger"
    onclick="myFunction()">MENU</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right padding js-scroll-trigger"
    onclick="myFunction()">BÁNH MỚI</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right padding js-scroll-trigger"
    onclick="myFunction()">ƯA CHUỘNG</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right padding js-scroll-trigger"
    onclick="myFunction()">VỀ CHÚNG TÔI</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right padding js-scroll-trigger"
    onclick="myFunction()">HỖ TRỢ</a>
</div>
<!-- User cuon theo trang -->
<div class="user">
  <ul class="ul_user">
    <li class="active cart" id="button">
      <a href="javascript:void(0)" data-toggle="collapse" data-target="#demo">
        <i class="fas fa-search" aria-hidden="true"></i>
      </a>
      <ul>
        <li>
          <div id="demo" class="collapse">
            <div class="box">
              <div class="container-4">
                <form autocomplete="off" target="_self" action="./" method="get">
                  <div class="autocomplete">
                    <input type="hidden" name="p" value="find" />
                    <input type="text" id="search" name="q" placeholder="Search..." />
                    <button class="icon" target="_self">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </li>
    <li><a href="./?p=cart"><i class="fas fa-shopping-cart"></i><span
          class="badge badge-light"><?php if(isset($_SESSION["cart"])){echo count($_SESSION["cart"]);}else{echo "0";} ?></span></a>
    </li>
    <li><a href="javascript:void(0)"><i class="fas fa-heart"></i></i></a></li>
    <?php
			if(!isset($_SESSION["idUser"])){
				require_once 'pages/lr.php';
			}else{
				require_once 'pages/user.php';
			}
		?>
  </ul>

</div>