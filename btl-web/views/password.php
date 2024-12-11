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
                    <h4 class="text-center" style="margin-bottom:50px ">Password Management</h4>
                    <div class="row">
                        <form class="  col-xs-10 col-xs-offset-1 was-validated" novalidate id="register-form" method="post">

                            <div class="form-group">
                                <label class=" control-label" for="oldpassword">Old Password</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="oldpassword" type="password" class="form-control" name="oldpassword" autocomplete="password" data-length="30" maxlength="30" required placeholder="Old password">
                                    <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
                                </div>


                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="password">Password</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="password" data-length="30" maxlength="30" required placeholder="Password">
                                    <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
                                </div>


                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="rpw">Reenter your password</label>

                                <div class=" has-feedback has-clear mb-3">
                                    <input id="rpw" type="password" class="form-control" name="rpw" autocomplete="password" data-length="30" maxlength="30" required placeholder="Reenter your password">
                                    <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
                                    <div class="invalid-feedback hidden">
                                        Passwords don't match.
                                    </div>
                                </div>


                            </div>


                            <div class="grey-text left-align note">
                                <div class="row">
                                    <div class="col-xs-1 hide-on-small-only ">
                                        <i class="material-icons" id="check1">check</i>
                                    </div>
                                    <div class="col-xs-11" id="rule1">
                                        Your password must have between 6-30 characters
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-1 hide-on-small-only ">
                                        <i class="tiny material-icons" id="check2">check</i>
                                    </div>
                                    <div class="col-xs-11" id="rule2">
                                        Your password must contain at least 1 upper letter, lower letter and number
                                    </div>
                                </div>
                            </div>
                            <div class=" row">

                                <div class="col-xs-1 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary " onclick="confirm('Do you want to change password?')"  disabled id="submit-button" name="savePass" style="margin: 50px auto">Save</button>
                                </div>
                            </div>

                        </form>
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
            "rpw":false,
            "password":false,
            "oldpassword":false
        }


        $('#oldpassword').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

            var txt=$this.val();
            var valid=Boolean(($this.val().length>=6)|| !visible);
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            //console.log(valid);
            regValidate["oldpassword"]=valid;
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

        $('#password').on('input propertychange', function() {
            var $this = $(this);
            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
            console.log(visible)
            var txt=$this.val();
            if(visible){
                var x=checkPassword(txt);
                //console.log(x);
                if ((x&2)!==0){
                    console.log(x&2);
                    $('#rule1').css("color", "red");
                    $('#rule1').siblings('.col-xs-1').css("opacity", "0");
                }
                else{
                    $('#rule1').css("color", "green");
                    $('#rule1').siblings('.col-xs-1').css("opacity", "1");
                }
                if ((x&1)!==0){
                    $('#rule2').css("color", "red");
                    $('#rule2').siblings('.col-xs-1').css("opacity", "0");
                }
                else{
                    $('#rule2').css("color", "green");
                    $('#rule2').siblings('.col-xs-1').css("opacity", "1");
                }

            }
            else {
                $('#rule2').css("color", "grey");
                $('#rule1').css("color", "grey");
                $('#rule2').siblings('.col-xs-1').css("opacity", "0");
                $('#rule1').siblings('.col-xs-1').css("opacity", "0");
            }


            regValidate["password"]=Boolean(!x||!visible);

            var rpw=$('#rpw').val();
            var valid=Boolean((txt===rpw));
            $('#rpw').siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["rpw"]=valid;



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


        $('#rpw').on('input propertychange', function() {
            var $this = $(this);
            var $pw=$('#password');

            var visible = Boolean($this.val());
            $this.siblings('.form-control-clear').toggleClass('hidden', !visible);


            var valid=Boolean(($this.val()===$pw.val())||!visible);
            $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
            regValidate["rpw"]=valid;
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

        function checkPassword(str){
            var x=0;
            if (str.length<6) x=x+10;
            if (str.match(/[A-Z]/) ==null || str.match(/[a-z]/) ==null || str.match(/[0-9]/) ==null) x=x+1;
            return x;
        }

        document.addEventListener('DOMContentLoaded', function () {
            $('#submit-button').attr("disabled",true);
            regValidate ["password"]=false;
            regValidate["oldpassword"]=false;
            regValidate["rpw"]=false;
        });


    </script>