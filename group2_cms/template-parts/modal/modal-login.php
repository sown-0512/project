<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-login">Đăng Nhập</h4>
                <h4 class="modal-title-re" style="display:none;">Đăng Ký</h4>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div class="content">
                        <p class="error alert" id="login_error"></p>
                        <div class="form loginBox">
                            <form method="POST" data-remote="true" action="" accept-charset="UTF-8" name="login_form">
                                <input id="userLogin" class="form-control" type="text" placeholder="Tên tài khoản" name="userLogin" required>

                                <input id="passLogin" class="form-control" type="password" placeholder="Mật khẩu" name="passLogin" required>

                                <input class="btn btn-default btn-login" type="submit" name="login" value="Đăng Nhập">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <p class="error alert" id="re_error"></p>
                        <div class="form">
                            <form method="POST" data-remote="true" action="" accept-charset="UTF-8" name="re_form" onsubmit="return re_validate();">

                                <input id="userRegister" class="form-control" type="text" placeholder="Tên tài khoản" name="userRegister">

                                <input id="passRegister" class="form-control" type="password" placeholder="Mật khẩu" name="passRegister">

                                <input id="passConfirmRegister" class="form-control" type="password" placeholder="Nhập lại mật khẩu" name="passConfirmRegister">

                                <input class="btn btn-default btn-register" type="submit" value="Đăng Ký" name="register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="forgot login-footer">
                    <span>Chưa có tài khoản?
                        <a href="javascript: showRegisterForm();">Đăng Ký</a>
                    </span>
                </div>
                <div class="forgot register-footer" style="display:none">
                    <span>Bạn đã có tài khoản?</span>
                    <a href="javascript: showLoginForm();">Đăng Nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // function login_validate() {
    //     let error = document.getElementById('login_error');

    //     let user = document.getElementById('userLogin');
    //     let pass = document.getElementById('passLogin');

    //     if (userName.value == '') {
    //         error.classList.add('alert-danger');
    //         error.textContent = "Tài khoản không được để trống";
    //         return false;
    //     }
    //     if (pass.value == '') {
    //         pass.focus();
    //         error.classList.add('alert-danger');
    //         error.textContent = "Mật khẩu không được để trống";
    //         return false;
    //     }
    // }

    function re_validate() {
        let error = document.getElementById('re_error');

        let userName = document.getElementById('userRegister');
        let pass = document.getElementById('passRegister');
        let pass_cf = document.getElementById('passConfirmRegister');

        if (userName.value != '' && pass.value != '' && pass_cf.value != '') {
            if (userName.value.length < 3) {
                error.classList.add('alert-danger');
                error.textContent = "Tài khoản ít nhất 3 ký tự";
                return false;
            }
            if (pass.value.length < 6) {
                error.classList.add('alert-danger');
                error.textContent = "Mật khẩu ít nhất 6 ký tự";
                return false;
            }
            if (pass.value != pass_cf.value) {
                 error.classList.add('alert-danger');
                error.textContent = "Mật khẩu không trùng khớp";
                return false;
            }
        }else{
            error.classList.add('alert-danger');
            error.textContent = "Điền đầy đủ thông tin";
            return false;
        }
    }

    
</script>