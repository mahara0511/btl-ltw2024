<?php


if(isset($_SESSION['message']))
{
    $message = $_SESSION['message'];
    require_once  (ROOT_PATH.'/views/layouts/login_popup.php');
    unset($_SESSION['message']);
}

    ?>

<style>
    /*label{
        font-size: large;
        position: relative;
        bottom: 25px;
    }
    input {
        border-radius: 3px;
    }*/

   /* input:-webkit-autofill {
        background-color: #586c78;
        width: inherit;
        height: inherit;
    }*/
   /* *{
        box-sizing: border-box;
    }
    input{
        padding: 0 5px;

    }*/
    #clear_pw,#clear_email{
        opacity: 0;
        float: right;
        position: relative;
        top: -55px;
        transition: opacity 0.2s linear
    }
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
    .materialert{
        position: relative;
        min-width: 150px;
        padding: 15px;
       /* margin-bottom: 20px;
        margin-top: 15px;*/
        border: 1px solid transparent;
        border-radius: 4px;
        transition: all 0.1s linear;
        webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .materialert .material-icons{
        margin-right: 10px;
    }
    .materialert .close-alert{
        -webkit-appearance: none;
        border: 0;
        cursor: pointer;
        color: inherit;
        background: 0 0;
        font-size: 22px;
        line-height: 1;
        font-weight: bold;
        text-shadow: 0 1px 0 rgba(255, 255, 255, .7);
        filter: alpha(opacity=40);
        margin-bottom: -5px;
        position: absolute;
        top: 16px;
        right: 5px;
    }
    .materialert.error{
        background-color: #c62828;
        color: #fff;
    }
    .card{
        margin: 10px auto;
        border-radius: 16px;
        border: 1px solid #ccc !important;
        background: whitesmoke;

    }

    @media only screen and (max-width: 480px) {
        .form-horizontal{
            width: 100%;
            margin-left: 0 !important;
        }
    }
    @media (max-width: 768px) {
        .card{
            background: whitesmoke;
            border-radius: 0px;
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
<?php include_once ROOT_PATH."/views/layouts/header.php"; ?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--<link rel="stylesheet" href="/public/css/login.css">-->
<link rel="stylesheet" href="public/fonts/themify-icons-font/themify-icons/themify-icons.css">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ">
            <div class="row ">
                <div class="col-xs-12 card " >
                    <div class="center-block" style="text-align: center">
                        <i class=" material-icons" id="icon" >account_circle</i>
                    </div>

                   <h1 class="text-center">Login information</h1>
                    <div class="row">
                        <form class=" form-horizontal col-xs-10 col-xs-offset-1 was-validated" novalidate id="login-form" method="post">

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="email">Email</label>
                                <div class="col-sm-10">
                                    <div class=" has-feedback has-clear mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-length="256" maxlength="256" autocomplete="email" required>
                                        <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
                                        <div class="invalid-feedback hidden">
                                            Please provide a valid email.
                                        </div>
                                       <!-- <i class="form-control-clear material-icons">clear</i>-->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="password">Password</label>
                                <div class="col-sm-10">
                                    <div class=" has-feedback has-clear mb-3">
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="password" data-length="30" maxlength="30" required placeholder="Password">
                                        <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
                                        <div class="invalid-feedback hidden">
                                            Please provide a valid password.
                                        </div>
                                    </div>
                                </div>

                            </div>


                          <!--  <div class="row">
                                <div class="col right-align">
                                    <a href="#" id="forget_pw" class="right-align">Forget password?</a>
                                </div>
                            </div>-->
                            <div class="checkbox" >
                                <label>
                                    <input type="checkbox" value="checkbox" name="checkbox">
                                    Remember me
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-5">
                                    <button type="submit" class="btn btn-primary " disabled="true" id="submit-button" name="login" style="margin: 50px auto">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr style="width:100%;text-align:left;margin-left:0">
                        <div class="card-action" style="margin: 0 10px 10px 10px">
                            <a href="\register">You haven't had account yet?</a>
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
    let inputValidator = {
        "password":false,
        "email": false,
    }
    $('.has-clear input[type="email"]').on('input propertychange', function() {
        console.log(inputValidator["password"]);
        var $this = $(this);
        var visible = Boolean($this.val());
        $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

        var txt=$this.val();
        var valid=Boolean(txt.match(/^([\w\.\-]+)@([\w\-]+)((\.(\w)+)+)$/)|| !visible);
        $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
        inputValidator["email"]=valid;
        let allTrue = Object.keys(inputValidator).every(function(item) {
            return inputValidator[item] === true
        });
        console.log(allTrue)
        console.log(inputValidator["password"]);
        if (allTrue) {
            $('#submit-button').attr("disabled", false);

        } else {
            $('#submit-button').attr("disabled", true);
        }
    }).trigger('propertychange');


    $('.has-clear input[type="password"]').on('input propertychange', function() {
        var $this = $(this);
        var visible = Boolean($this.val());
        $this.siblings('.form-control-clear').toggleClass('hidden', !visible);

        var txt=$this.val();
        var valid=Boolean(($this.val().length>=6)|| !visible);
        $this.siblings('.invalid-feedback').toggleClass('hidden',valid );
        //console.log(valid);
        inputValidator["password"]=valid;
        let allTrue = Object.keys(inputValidator).every(function(item) {
            return inputValidator[item] === true
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
    });

    $('.materialert .close-alert').click(function (){
        $(this).parent().hide('slow');
    });

    document.addEventListener('DOMContentLoaded', function () {
        $('#submit-button').attr("disabled",true);
        inputValidator["password"]=false;
        inputValidator["email"]=false;
    });


</script>