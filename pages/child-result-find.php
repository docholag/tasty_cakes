<?php
    $tk = $_GET["q"];
    if(isset($_GET["trang"])){
        $currentPage = (int)$_GET["trang"];
    }else{
        $currentPage = 1;
    }
    $start = ($currentPage - 1)*12;
    $count = count_cakes_key($tk);
    $cakes;
    if(isset($_GET["sort"])){
        switch($_GET["sort"]){
            case "like-nhieu" :
                $cakes = cakes_key_ln($tk, $start);
                break;
            case "mua-nhieu" :
                $cakes = cakes_key_mn($tk, $start);
                break;
            case "gia-tang-dan" :
                $cakes = cakes_key_gt($tk, $start);
                break;
            case "gia-giam-dan" :
                $cakes = cakes_key_gg($tk, $start);
                break;
            default : $cakes = cakes_key($tk, $start);
        }
    }else{
        $cakes = cakes_key($tk, $start);
    }
?>

<div class="de px-5 py-3">
    <div class="row justify-content-between">
        <div class="col-6 col-sm-6 col-md-5 col-lg-4 col-xl-4 pl-5">
            <h4  style="display:contents;">KẾT QUẢ TÌM KIẾM: '<?php echo $tk; ?>' có <?php echo $count; ?> kết quả</h4>
        </div>
        <div class="col-5 col-sm-4 col-md-3 col-lg-3 col-xl-2">
            <div class="wrap" style="text-align: center;">
                <a data-toggle="collapse" href="#collapse1"><i class="fas fa-filter"></i> Bộ lọc </a>

                <div id="collapse1" class=" divloc panel-collapse collapse" style="background-color: #c4c8cc;">
                    <ul style="margin:0;">
                        <li><a href="./?p=tim-kiem&q=<?php echo $tk; ?>&sort=like-nhieu" style="display: block;padding: 7px 0;">Yêu thích</a></li>
                        <li><a href="./?p=tim-kiem&q=<?php echo $tk; ?>&sort=mua-nhieu" style="display: block;padding: 7px 0;">Mua nhiều</a></li>
                        <li><a href="./?p=tim-kiem&q=<?php echo $tk; ?>&sort=gia-tang-dan" style="display: block;padding: 7px 0;">Giá tăng dần</a></li>
                        <li><a href="./?p=tim-kiem&q=<?php echo $tk; ?>&sort=gia-giam-dan" style="display: block;padding: 7px 0;">Giá giảm dần</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="contentProducts__card">

        <div class="row mx-0 px-3">
            <?php
                foreach($cakes as $cake):
                    $pt = 100 - (($cake["GiaGiam"]*100)/$cake["GiaGoc"]);
                    $pt = round($pt, 0, PHP_ROUND_HALF_UP);
            ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-3 pt-5">
                    <div class="contentProducts__card anime ">
                        <div class="contentProducts__image">
                            <div class="contentProducts__label">-<?php echo $pt; ?>%</div>
                            <a href="./?p=cake&idCake=<?php echo $cake["idCake"]; ?>&name=<?php echo $cake["TenKD"]; ?>"><img src="public/img/cakes/<?php echo $cake["Anh"]; ?>" alt="undefined"></a>
                        </div>
                        <div class="contentProducts__text">
                                <h4 class="contentProducts__productTitle text-center"><?php echo $cake["TenBanh"]; ?></h4>
                                <div class="contentProducts__priceContainer row">
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                        <a href="./?p=cake&idCake=<?php echo $cake["idCake"]; ?>&name=<?php echo $cake["TenKD"]; ?>">
                                        <div class="contentProducts__priceFinal"><?php echo number_format($cake["GiaGiam"], 0, ",", "."); ?> đ</div>
                                        </a>
                                        <sub class="del"><?php echo number_format($cake["GiaGoc"], 0, ",", "."); ?> đ</sub>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <div class="contentProducts__priceOriginal pl-2">
                                            <i title="Thêm vào yêu thích" class=" faheart fa fa-heart" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            <div class="contentProducts__info">
                                <div class="row web-kit">
                                    <div class="col-6 px-0">
                                        <div class="contentProducts__link">
                                            <a href="javascript:void(0)">
                                                <span title="Thêm vào giỏ hàng" class="org">Thêm vào giỏ
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#698ccd" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                    <line x1="9" y1="12" x2="15" y2="12"></line>
                                                    <line x1="12" y1="9" x2="12" y2="15"></line>
                                                    </svg>
                                                </span>
                                                <i class="icon-plus fas fa-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="contentProducts__view cta cta02" title="Mua">Mua</div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
        </div>

    </div>    
</div>
<div class="container-fluid">
    <span class="text-center pt-3">
        <?php
            $totalPage = ceil($count/12);
            
            $pagination = [$currentPage]; // Đây là mảng lưu các trang sẽ xuất hiện ở phần phân trang
            while (count($pagination) < 5) { // Sẽ chạy vòng lặp cho đến khi nào mảng này có đủ 5 phần tử thì thôi
                $left = $pagination[0] - 1; // Phần tử tiếp theo ở bên trái sẽ là phần tử bên trái ở thời điểm hiện tại trừ đi 1
                $right = $pagination[count($pagination) - 1] + 1; // Phần tử tiếp theo ở bên phải sẽ là phần tử bên phải ở thời điểm hiện tại cộng với 1
                $added = false; // Biến để kiểm tra xem có trang mới được thêm vào không
                if ($left > 0) {
                    array_unshift($pagination, $left); // Đẩy page mới vào đầu mảng 
                    $added = true;
                }
                if ($right <= $totalPage) {
                    array_push($pagination, $right); // Đẩy page mới vào cuối mảng 
                    $added = true;
                }
                if (!$added) { // Nếu cả bên trái lẫn bên phải đều không thể thêm phần tử nào vào nữa, thì break khỏi vòng lặp
                    break;
                }
            }
            // Sau vòng lặp này bạn sẽ có một mảng có tối đa là 5 trang
            if ($pagination[0] != $currentPage) { // Nếu trang ngoài cùng bên trái, mà không phải là current page, thì sẽ có nút Previous 
                array_unshift($pagination, '<');
            }

            if ($pagination[count($pagination) - 1] != $currentPage) { // Nếu trang ngoài cùng bên phải, mà không phải là current page, thì sẽ có nút Next 
                array_push($pagination, '>');
            }
        ?>
        <?php
            foreach ($pagination as $p):
        ?>
            <a href="<?php
                if($p === '<'){
                    if(isset($_GET["sort"])){
                        echo "./?p=tim-kiem&q=".$tk."&sort=".$_GET["sort"]."&trang=".($currentPage-1);
                    }else{
                        echo "./?p=tim-kiem&q=".$tk."&trang=".($currentPage-1);
                    }
                }
                else if($p === '>'){
                    if(isset($_GET["sort"])){
                        echo "./?p=tim-kiem&q=".$tk."&sort=".$_GET["sort"]."&trang=".($currentPage+1);
                    }else{
                        echo "./?p=tim-kiem&q=".$tk."&trang=".($currentPage+1);
                    }
                }
                else{
                    if(isset($_GET["sort"])){
                        echo "./?p=tim-kiem&q=".$tk."&sort=".$_GET["sort"]."&trang=".$p;
                    }else{
                        echo "./?p=tim-kiem&q=".$tk."&trang=".$p;
                    }
                }
            ?>" style="margin:0 5px;text-decoration: none;<?php if($p == $currentPage){echo "color:red;";} ?>">
                <?php echo $p; ?>
            </a>
        <?php
            endforeach;
        ?>
    </span>
</div>


