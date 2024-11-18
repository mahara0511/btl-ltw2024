<?php
$email=$password="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=test_input($_POST["email"]);
    $password=test_input($_POST["password"]);
    $firstname=test_input($_POST["firstname"]);
    $lastname=test_input($_POST["lastname"]);
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
    <title>Register page</title>
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
        #clear_pw,#clear_email,#clear_fname,#clear_lname,#clear_rpw{
            opacity: 0;
            float: right;
            position: relative;
            top: -55px;
            transition: opacity 0.2s linear
        }
        .note{
            list-style-type: disc;

        }
        #check1,#check2{
            opacity: 0;
            float: left;
            /*position: relative;
            left: -2rem;*/
            transition: opacity 0.2s linear;
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
                <div class="card-content center-align">
                    <span class="card-title">Welcome to our shop!</span>
                    <h4> Registration information</h4>
                    <div class="row">
                        <form class="col s10 offset-s1 black-text" id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" class="validate login-form" name="email" data-length="256" maxlength="256" required>
                                    <label class="active" for="email">Email</label>
                                    <span class="helper-text" data-error="Invalid email"></span>
                                    <a class="waves-effect waves-light" id="clear_email"><i class=" material-icons">clear</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input id="firstname" type="text" class="validate login-form" name="firstname" required pattern="^[A-Za-z\-]+$"  data-length="30" maxlength="30">
                                    <label class="active" for="firstname" data-error="Invalid name">First name</label>
                                    <span class="helper-text" data-error="Invalid name"></span>
                                    <a class="waves-effect waves-light" id="clear_fname"><i class=" material-icons">clear</i></a>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input id="lastname" type="text" class="validate login-form" name="lastname" data-length="30" maxlength="30" required pattern="^[A-Za-z\-]+$">
                                    <label class="active" for="lastname" data-error="Invalid name">Last name</label>
                                    <span class="helper-text" data-error="Invalid name"></span>
                                    <a class="waves-effect waves-light" id="clear_lname"><i class=" material-icons">clear</i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" class="validate login-form" name="password"  data-length="30" maxlength="30" required>
                                    <label class="active" for="password">Password</label>
                                    <a class="waves-effect waves-light" id="clear_pw"><i class=" material-icons">clear</i></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="rpassword" type="password" class="validate login-form" name="rpassword"  data-length="30" maxlength="30" required>
                                    <label class="active" for="rpassword">Retype your password</label>
                                    <span class="helper-text" data-error="Passwords not matching" id="checkrpw"></span>
                                    <a class="waves-effect waves-light" id="clear_rpw"><i class=" material-icons">clear</i></a>
                                </div>
                            </div>
                            <div class="grey-text left-align note">
                                        <div class="row">
                                            <div class="col s1 hide-on-small-only">
                                                <i class="tiny material-icons" id="check1">check</i>
                                            </div>
                                            <div class="col s11" id="frule">
                                                Your password must have between 2-30 characters
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s1 hide-on-small-only">
                                                <i class="tiny material-icons" id="check2">check</i>
                                            </div>
                                            <div class="col s11" id="srule">
                                                Your password must contain at least 1 upper letter, lower letter and number
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l3 offset-l9 center-align" id="submit-holder">
                                    <button class="btn green waves-effect waves-light " type="submit" name="action" id="submit" disabled>Sign up
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="login.php">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(realpath(__DIR__ . '/../..')."/views/layouts/footer.php"); ?>
<?php require_once(realpath(__DIR__ . '/../..')."/component/script_config.php"); ?>
<script>

    const email_button = document.getElementById('clear_email')
    const Email = document.getElementById('email')
    const pw_button = document.getElementById('clear_pw')
    const pw = document.getElementById('password')

    const fname_button = document.getElementById('clear_fname')
    const fname=document.getElementById('firstname')

    const lname_button = document.getElementById('clear_lname')
    const lname=document.getElementById('lastname')

    const rpw_button = document.getElementById('clear_rpw')
    const rpw=document.getElementById('rpassword')

    const crpw=document.getElementById('checkrpw')

    const frule=document.getElementById('frule')
    const srule=document.getElementById('srule')
    const check1=document.getElementById('check1')
    const check2=document.getElementById('check2')
    const buttonSend=document.getElementById('submit')
    let inputs = document.querySelectorAll('input');
    let inputValidator = {
        "repassword":false,
        "password": false,
    }


    rpw.addEventListener('input',function (){
        if(this.value !== "") rpw_button.style.opacity = 1
        else rpw_button.style.opacity = 0

      if(this.value!==pw.value) {
          inputValidator["repassword"]=false
          console.log(crpw.classList.contains("invalid"))

            if (rpw.classList.contains("invalid")===false){
               rpw.classList.add("invalid")
            }
            if (rpw.classList.contains("valid")) {
                rpw.classList.remove("valid");
            }
          console.log(rpw.classList)
      }
      else{
          inputValidator["repassword"]=true;
          if (rpw.classList.contains("valid")===false){
              rpw.classList.add("valid")
          }
          if (rpw.classList.contains("invalid")) {
              rpw.classList.remove("invalid");
          }
      }
      console.log(inputValidator)
        let allTrue = Object.keys(inputValidator).every(function(item) {
            return inputValidator[item] === true
        });
        console.log(allTrue)
        if (allTrue) {
            buttonSend.disabled = false;
        } else {
            buttonSend.disabled = true;

        }
    })

    rpw_button.addEventListener('click', function(){
        Email.value = "";
        this.style.opacity = 0
    });

    Email.addEventListener('input', function(){
        if(this.value !== "") email_button.style.opacity = 1
        else email_button.style.opacity = 0
    });

    email_button.addEventListener('click', function(){
        Email.value = "";
        this.style.opacity = 0
    });

    fname.addEventListener('input', function(){
        if(this.value !== "") fname_button.style.opacity = 1
        else fname_button.style.opacity = 0
    });

    fname_button.addEventListener('click', function(){
        fname.value = "";
        this.style.opacity = 0
    });
    lname.addEventListener('input', function(){
        if(this.value !== "") lname_button.style.opacity = 1
        else lname_button.style.opacity = 0
    });

    lname_button.addEventListener('click', function(){
        lname.value = "";
        this.style.opacity = 0
    });
    pw.addEventListener('input', function(){
        if(this.value !== "") {
            pw_button.style.opacity = 1
            console.log(this.value)
            var x=checkPassword(this.value)
            frule.setAttribute("color","red")
            console.log(x&2)
            if (x===0){
                inputValidator['password']=true;
            }
            else{
                inputValidator['password']=false;
            }
            if ((x&2)!==0){
                frule.style.color='red'
                check1.style.opacity=0
            }
            else{
                frule.style.color='green'
                check1.style.opacity=1
            }
            if ((x&1)!==0){
                srule.style.color='red'
                check2.style.opacity=0
            }
            else{
                srule.style.color='green'
                check2.style.opacity=1
            }

        }
        else{
            pw_button.style.opacity = 0
        }
        let allTrue = Object.keys(inputValidator).every(function(item) {
            return inputValidator[item] === true
        });
        console.log(allTrue)
        if (allTrue) {
            buttonSend.disabled = false;
            buttonSend.style.backgroundColor="green"
        } else {
            buttonSend.disabled = true;

        }

    });

    pw_button.addEventListener('click', function(){
        pw.value = "";
        frule.style.color='grey'
        srule.style.color='grey'
        check1.style.opacity=0
        check2.style.opacity=0
        this.style.opacity = 0
    });
    document.addEventListener('DOMContentLoaded', function () {
        var textNeedCount = document.querySelectorAll('#email,#password');
        M.CharacterCounter.init(textNeedCount);
    });

    function checkPassword(str){
        var x=0;
        if (str.length<2) x=x+10;
        if (str.match(/[A-Z]/) ==null || str.match(/[a-z]/) ==null || str.match(/[0-9]/) ==null) x=x+1;
        return x;
    }

</script>

</body>

</html>