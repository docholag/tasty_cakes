<li><a href="javascript:void(0)"  onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fas fa-user-circle"></i></a></li>
<div id="id01" class="modal">
    <div class="container tal" id="container">
        <div class="form-container sign-up-container up">
            <span onclick="document.getElementById('id01').style.display='none'" class="close pr-2" style="font-family: 'Caveat', cursive; cursor:pointer; font-size: 200%;" title="Close Modal">&times;</span>
            <form action="user_action/user_action.php" method="post">
                <h2>Tạo tài khoản</h2>
                <div class="social-container">
                    <a href="#" class="social fb"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social gg"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social in"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng email của bạn</span>
                <input onfocus="this.value=''" type="text" placeholder="Tên đăng nhập" name="tdndk" />
                <input onfocus="this.value=''" type="email" placeholder="Email" name="eml" />
                <input onfocus="this.value=''" type="password" placeholder="Mật khẩu" name="pwdk" />
                <button class="buton" type="submit" name="regis" >Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container up">
            <span onclick="document.getElementById('id01').style.display='none'" class="close pr-2" style="font-family: 'Caveat', cursive; cursor:pointer; font-size: 200%;" title="Close Modal">&times;</span>
            <form action="user_action/user_action.php" method="post">
                <h2 class="py-2">Đăng nhập</h2>
                <div class="social-container">
                    <a href="javascript:void(0)" class="social fb"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0)" class="social gg"><i class="fab fa-google-plus-g"></i></a>
                    <a href="javascript:void(0)" class="social in"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="or">hoặc dùng tài khoản của bạn</span>
                <input type="email" placeholder="Email" name="email" />
                <input onfocus="this.value=''" type="password" placeholder="Mật khẩu" name="pass" />
                <a class="or" href="javascript:void(0)">Quên mật khẩu?</a>
                <button class="buton" type="submit" name="login">Đăng nhập</button>
                <span style="color:red;font-size:1.5em;" id="erroLogin"></span>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2 class="py-2">Mừng trở lại!</h2>
                    <p>Đăng nhập để Tasty Cakes có thể quan tâm bạn hơn nữa</p>
                    <button class="ghost buton" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>Chào bạn !</h2>
                    <p>Nhập thông tin cá nhân và bắt đầu với Tasty Cakes</p>
                    <button class="ghost buton" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</div>