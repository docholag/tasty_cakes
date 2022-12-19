<h5 class="mt-0">Bình luận</h5>
<hr>

<div class=" over_flow row justify-content-center ">
    <?php
        $cmts = cake_cmts($idCake);
        foreach($cmts as $cmt):
    ?>
    <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 cmt my-2">
        <img class="py-2" src="public/img/user/<?php echo $cmt["Avatar"]; ?>" alt="">
        <div class="bl_01">
            <ul style="width: 100%; "> 
                <li>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <p><?php echo $cmt["TaiKhoan"]; ?></p>
                            </div>
                            <div class="col-6 float-right">
                                <p class="float-right font_cmt cmt_col"><?php echo $cmt["NgayTao"]; ?></p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="border_cmt"><p class="px-2 py-2 font_cmt"><?php echo $cmt["NoiDung"]; ?></p></div>
                </li>
            </ul>
        </div>
    </div>
    <?php
        endforeach;
    ?>
</div>

<div class="comt row justify-content-center">
    <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 text-center cmtt cmt">
        <div class="bl_01">
            <ul class="my-0" style="width: 100%; "> 
                <li>
                    <form action="user_action/user_action.php" method="post" onsubmit="return checkCmt()">
                        <div class="container">
                            <div class="row">
                                <div class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1">
                                    <img class="py-1" src="public/img/user/<?php echo $_SESSION["img"]; ?>" alt="">
                                </div>
                                <div class="col-6 col-sm-5 col-md-8 col-lg-8 col-xl-8 py-2 " style="border-radius: 12%;" >
                                    <input class=" incmt infor_us" type="text" name="cmt" id="cmt" placeholder="Bình luận...">
                                </div>
                                <div class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-2 py-2 kk">
                                    <input type="hidden" name="idUser" value="<?php echo $_SESSION["idUser"]; ?>">
                                    <input type="hidden" name="idCake" value="<?php echo $idCake; ?>">
                                    <input type="hidden" name="name" value="<?php echo $_GET["name"]; ?>">
                                    <button title="Gửi" type="submit" class=" sendcmt lgout px-0 py-1" name="dang" ><i class="far fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    function checkCmt(){
        var cmt = document.getElementById("cmt");
        if(cmt.value === ""){
            alert("Vui lòng nhập nội dung !!!");
            return false;
        }else{
            return true;
        }
    }
</script>