<?php


if(isset($_SESSION['message']))
{
    $message = $_SESSION['message'];
    require_once  (ROOT_PATH.'/views/layouts/login_popup.php');
    unset($_SESSION['message']);
}

?>

<style>

    #icon{
        font-size: 20rem;
        color: #1d467a;
    }
    input{
        max-width: inherit;
    }

    ::-ms-clear {
        display: none;
    }

    .form-control-clear {
        float: right;
        position: relative;
        top: -30px;
        right: 5px;
        transition: opacity 0.2s linear

    }
    .form-control-edit {
        float: right;
        position: relative;
        top: -30px;
        right: 5px;
        transition: opacity 0.2s linear

    }

    .card{
        margin: 10px auto;
        border-radius: 16px;
        border: 1px solid #ccc !important;
        background: whitesmoke;

    }


    @media only screen and (max-width: 480px) {
        form{
            width: 100%;
            margin-left: 0 !important;
        }
        .hide-on-small-only{
            opacity: 0;
        }
    }
    @media (max-width: 768px) {
        .card{
            background: whitesmoke;
            border-radius: 0;
            border: 1px solid #ccc !important;

        }
    }
    @media (max-width: 900px) {
        #icon {
            font-size: 10rem;
        }
    }
    @media (max-width: 1200px) {
        #icon {
            font-size: 14rem;
        }
    }


</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php include_once ROOT_PATH."/views/layouts/header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ">
            <div class="row ">
                <div class="col-xs-12 card " >
                    <h1 class="text-center" style="margin-top: 50px">Hi <?php echo $user_info["first_name"]?></h1>
                    <h4 class="text-center" style="margin-bottom:50px ">User information</h4>
                    <div class="row">
                        <form class="  col-xs-10 col-xs-offset-1 was-validated" novalidate id="register-form" method="post">

                            <div class="form-group">
                                <label class=" control-label text-left" for="email">Email</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $user_info['email']?>" data-length="256" maxlength="256" autocomplete="email" required>
                                    <a class="form-control-clear" hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid email.
                                    </div>
                                    <!-- <i class="form-control-clear material-icons">clear</i>-->
                                </div>

                            </div>


                            <div class="form-group">
                                <label class="control-label" for="firstname">First name</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="firstname" type="text" class="form-control " name="firstname"  data-length="30" maxlength="30" required placeholder="<?php echo $user_info['first_name']?>">
                                    <a class="form-control-clear" hidden><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid name.
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label text-left" for="lastname">Last name</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="lastname" type="text" class="form-control " name="lastname"  data-length="30" maxlength="30" required placeholder="<?php echo $user_info['last_name']?>">
                                    <a class="form-control-clear" hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid name.
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label text-left" for="mobile">Mobile</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="mobile" type="text" class="form-control" name="mobile"  data-length="30" maxlength="15" required placeholder="<?php echo $user_info['mobile']?>">
                                    <a class="form-control-clear" hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid mobile.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-left" for="address">Address</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="address" type="text" class="form-control" name="address"  data-length="30" maxlength="255" required placeholder="<?php echo $user_info['address']?>">
                                    <a class="form-control-clear " hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid address.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-left" for="province">Province</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="province" type="text" class="form-control" name="province"  data-length="30" maxlength="255" required placeholder="<?php echo $user_info['province']?>">
                                    <a class="form-control-clear" hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid province.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-left" for="district">District</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="district" type="text" class="form-control" name="district"  data-length="30" maxlength="255" required placeholder="<?php echo $user_info['district']?>">
                                    <a class="form-control-clear" hidden ><i class=" material-icons">clear</i></a>
                                    <a class="form-control-edit"  ><i class=" material-icons">edit</i></a>
                                    <div class="invalid-feedback hidden">
                                        Please provide a valid district.
                                    </div>
                                </div>
                            </div>







                            <div class=" row">

                                <div class="col-xs-2 ">
                                    <button type="submit" class="btn btn-primary " disabled id="submit-button" name="save" style="margin: 50px auto">Save</button>
                                </div>
                                <div class="col-xs-2 ">
                                    <button type="button" class="btn btn-primary "  onclick="location.href='/password'"  id="submit-button" name="save" style="margin: 50px auto">Change password</button>
                                </div>
                            </div>

                        </form>
                        <hr style="width:100%;text-align:left;margin-left:0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <?php include ROOT_PATH."/views/layouts/footer.php"; ?>

    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/slick.min.js"></script>
    <script src="public/js/nouislider.min.js"></script>
    <script src="public/js/jquery.zoom.min.js"></script>
    <script src="public/js/sweetalert.min.js"></script>
    <script src="public/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="public/js/main.js"></script>
    <script src="public/js/actions.js"></script>
    <script src="public/js/script.js"></script>
    <script >
        let regValidate = {
            "address":true,
            "province":true,
            "district":true,
            "mobile":true,
            "email":true,
            "firstname": true,
            "lastname": true,
        }

        let validation = /^[a-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]+$/;

        $('.has-clear input[type="email"]').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
            console.log(visible);
            var txt=$this.val();
            var valid=Boolean(txt.match(/^([\w\.\-]+)@([\w\-]+)((\.(\w)+)+)$/)||!visible);
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["email"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(regValidate)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');




        $('#address').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            var valid=Boolean((txt.length>0)||!visible)
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["address"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');

        $('#province').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            var valid=Boolean((txt.length>0)||!visible)
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["province"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');

        $('#district').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            var valid=Boolean((txt.length>0)||!visible)
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["district"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');


        $('.form-control-clear').click(function() {
            $(this).siblings('input[type="email"]').val('').trigger('propertychange').focus();
            $(this).siblings('input[type="password"]').val('').trigger('propertychange').focus();
            $(this).siblings('input[type="text"]').val('').trigger('propertychange').focus();
        });


        $('.form-control-edit').click(function() {
            $(this).siblings('input').removeAttr('readonly');
            $(this).siblings('input').trigger('propertychange');
            $(this).attr('hidden', '');
            $(this).siblings('.form-control-clear').removeAttr('hidden');
        });


        $('#mobile').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);


            var txt=$this.val();
            console.log(txt);
            var valid=Boolean((txt.match(/^\d+$/)&&txt.length>=3)||!visible)

            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["mobile"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');

        $('#lastname').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            txt=txt=txt.toLocaleLowerCase()
            var valid=Boolean((txt.length>=2&&txt.length<=30&&validation.test(txt))||!visible)

            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["lastname"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');

        $('#firstname').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            txt=txt.toLocaleLowerCase()


            var valid=Boolean((txt.length>=2&&txt.length<=30&&validation.test(txt))||!visible)
            //console.log(txt.match(/[a-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]+/))
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["firstname"]=valid;
            let allTrue = Object.keys(regValidate).every(function(item) {
                return regValidate[item] === true
            });
            console.log(allTrue)
            if (allTrue) {
                $('#submit-button').attr("disabled", false);

            } else {
                $('#submit-button').attr("disabled", true);
            }
        }).trigger('propertychange');

        document.addEventListener('DOMContentLoaded', function () {
            $('#submit-button').attr("disabled",true);
            $('#email').attr('readonly','');
            $('#firstname').attr('readonly','');
            $('#lastname').attr('readonly','');
            $('#address').attr('readonly','');
            $('#province').attr('readonly','');
            $('#district').attr('readonly','');
            $('#mobile').attr('readonly','');
            $('#email').val('<?php echo $user_info["email"]?>').trigger('propertychange');
            $('#firstname').val('<?php echo $user_info["first_name"]?>').trigger('propertychange');
            $('#lastname').val('<?php echo $user_info["last_name"]?>').trigger('propertychange');
            $('#address').val('<?php echo $user_info["address"]?>').trigger('propertychange');
            $('#province').val('<?php echo $user_info["province"]?>').trigger('propertychange');
            $('#district').val('<?php echo $user_info["district"]?>').trigger('propertychange');
            $('#mobile').val('<?php echo $user_info["mobile"]?>').trigger('propertychange');
        });


    </script>
