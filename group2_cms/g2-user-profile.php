<?php
/* Template Name: G2-Profile-User */
if (isset($_COOKIE['userName'])) {
    get_header();
    $user = new User();
    $user->setUser($_COOKIE['userName']);
?>
    <hr>
    <div class="container bootstrap snippet profile"  style="margin-bottom: 15px;">
        <div class="row">
            <div class="col-sm-10">
                <h1>Thông tin cá nhân</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!--left col-->
                <div class="text-center">
                    <a style="padding-bottom: 10px;" href="<?php echo $user->getFilter("avatar") ?>" class="pull-right">
                        <img style="box-shadow: 1px 1px 4px 0px rgba(0, 0, 0, 0.75);width:70%;" title="profile image" class="img-responsive" src="<?php echo $user->getFilter("avatar") ?>">
                    </a>

                </div>
            </div>
            <!--/col-3-->
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li class="active" style="margin-right: 15px;"><a data-toggle="tab" href="http://localhost/wordpress/profile-user/">Thông tin</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="" method="post" enctype="multipart/form-data"> 
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="profile_user">
                                        <h4>Tên tài khoản</h4>
                                    </label>
                                    <input disabled type="text" class="form-control" name="profile_user" id="profile_user" placeholder="first name" title="Không chỉnh sửa" value="<?php echo $user->getFilter("user") ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="sex">
                                        <h4>Giới tính</h4>
                                    </label>
                                    <br>
                                    <?php
                                    if ($user->getFilter("sex") == 0) {
                                        echo '<input type="radio" name="profile_sex" id="sex" value="0" checked>Nam
                                        <input type="radio" name="profile_sex" id="sex" value="1">Nữ
                                        <input type="radio" name="profile_sex" id="sex" value="2">Khác';
                                    } else if ($user->getFilter("sex") == 1) {
                                        echo '<input type="radio" name="profile_sex" id="sex" value="0" >Nam
                                        <input type="radio" name="profile_sex" id="sex" value="1" checked>Nữ
                                        <input type="radio" name="profile_sex" id="sex" value="2">Khác';
                                    } else {
                                        echo '<input type="radio" name="profile_sex" id="sex" value="0" checked>Nam
                                        <input type="radio" name="profile_sex" id="sex" value="1">Nữ
                                        <input type="radio" name="profile_sex" id="sex" value="2" checked>Khác';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-6">
                                    <label for="profile_email">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="email" class="form-control" name="profile_email" id="profile_email" placeholder="you@email.com" value="<?php echo $user->getFilter("email") ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="profile_phone">
                                        <h4>Điện thoại</h4>
                                    </label>
                                    <input type="text" class="form-control" name="profile_phone" id="profile_phone" placeholder="1234 567 890" value="<?php echo $user->getFilter("phone") ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="profile_password_old">
                                        <h4>Mật khẩu</h4>
                                    </label>
                                    <input type="password" class="form-control" name="profile_password_old" id="profile_password_old" placeholder="Mật khẩu cũ" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="profile_password_new">
                                        <h4>Mật khẩu mới</h4>
                                    </label>
                                    <input type="password" class="form-control" name="profile_password_new" id="profile_password_new" placeholder="Mật khẩu mới">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                            <h6>Thêm ảnh đại diện </h6>
                            <input type="file" class="text-center center-block file-upload" name="profile_avatar">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <input type="hidden" name="profile_update" value="true">
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>

        </div>
        <!--/col-9-->
    </div>
    <!--/row-->
    <script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
    </script>
<?php
    get_footer();
} else {
    wp_redirect("http://localhost/wordpress/");
}
