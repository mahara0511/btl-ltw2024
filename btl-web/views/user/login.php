<?php
$email=$password="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email=test_input($_POST["email"]);
$password=test_input($_POST["password"]);
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    if (checkInfo($email,$password)){
        echo '<script>window.location.href = "index.php"</script>';
    }
    else{
        echo '<script>window.alert("Your login has been denied!")</script>';
    }
}
}
function checkInfo($email,$password)
{
    return false;
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php require_once(realpath(__DIR__ . '/../..')."/component/head.php"); ?>
    <title>Login page</title>
    <style>
        label{
            font-size: large;
            position: relative;
            bottom: 25px;
        }
        input {
            border-radius: 3px;
        }

        input:-webkit-autofill {
            background-color: #586c78;
            width: inherit;
            height: inherit;
        }
        *{
            box-sizing: border-box;
        }
        input{
            padding: 0 5px;

        }
        #clear_pw,#clear_email{
            opacity: 0;
            float: right;
            position: relative;
            top: -55px;
            transition: opacity 0.2s linear
        }
        #icon{
            font-size: 12rem
        }
        @media (max-width: 900px) {
            #icon {
                font-size: 6rem;
            }
        @media (max-width: 1200px) {
            #icon {
                font-size: 8rem;
            }

            .card{

                padding: 0;
                margin: 0;
            }

        }

    </style>
</head>
<body>
<?php
require_once(realpath(__DIR__ . '/../..')."/views/layouts/header.php"); ?>
<div class="container">
    <div class="row valign-wrapper">
        <div class="col s12 m10 offset-m1 l8 offset-l2 xl6 offset-xl3 valign ">
            <div class="card ">
                <div class="card-content center-align ">
                    <i class=" material-icons" id="icon" >account_circle</i>
                    <span class="card-title">Login information</span>
                    <div class="row">
                    <form class="col s10 offset-s1 black-text" id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate login-form" name="email" autocomplete="email" data-length="256" maxlength="256">
                                <label class="active" for="email">Email</label>
                                <span class="helper-text" data-error="Invalid email"></span>
                                <a class="waves-effect waves-light" id="clear_email"><i class=" material-icons">clear</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate login-form" name="password" autocomplete="password" data-length="30" maxlength="30">
                                <label class="active" for="password">Password</label>
                                <a class="waves-effect waves-light" id="clear_pw"><i class=" material-icons">clear</i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col right-align">
                                <a href="#" id="forget_pw" class="right-align">Forget password?</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l3 offset-l9 center-align" id="submit-holder">
                                <button class="btn grey waves-effect waves-light "  type="submit" name="action">Login
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="register.php">You haven't had account yet?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(realpath(__DIR__ . '/../..')."/views/layouts/footer.php"); ?>
<?php require_once(realpath(__DIR__ . '/../..')."/component/script_config.php"); ?>
<script>

  /*  function changeColor(){
        var elements=document.getElementsByClassName("login-form")
        for (var i = 0; i < elements.length;  i++ ){
            elements[i].setAttribute("style", "background-color:red");
        }
    }*/
    const email_button = document.getElementById('clear_email')
    const Email = document.getElementById('email')
    const pw_button = document.getElementById('clear_pw')
    const pw = document.getElementById('password')
    const forget=document.getElementById('forget_pw')
    Email.addEventListener('input', function(){
        if(this.value !== "") email_button.style.opacity = 1
        else email_button.style.opacity = 0
    });

    email_button.addEventListener('click', function(){
        Email.value = "";
        this.style.opacity = 0
    });
  pw.addEventListener('input', function(){
      if(this.value !== "") pw_button.style.opacity = 1
      else pw_button.style.opacity = 0
  });

  pw_button.addEventListener('click', function(){
      pw.value = "";
      this.style.opacity = 0
  });
  document.addEventListener('DOMContentLoaded', function () {
      var textNeedCount = document.querySelectorAll('#email,#password');
      M.CharacterCounter.init(textNeedCount);
  });
  forget.addEventListener('click', function(){
      Email.value = "";
      this.style.opacity = 0
  });

</script>

</body>

</html>