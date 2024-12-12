<?php
require_once 'models/userInfoModel.php';
if(session_id() == '') {
    session_start();
}
class userInfoController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new userInfoModel($db);
    }


    public function login_form(){
        if (array_key_exists('login', $_POST)&&isset($_POST["email"]) && isset($_POST["password"])) {
             if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
                $_SESSION['message'] = "You are admin";
                header('location: /login'); // Chuyển hướng đến trang admin
                exit();
            }
            $email = $_POST["email"];
            $password = $_POST["password"];
            $checkbox=$_POST["checkbox"];
            $state=$this->model->login($email,$password,$checkbox);
            echo '<script>console.log("'.$state['status'].'")</script>';
            if ($state['status']=='success'){
                echo '<script>console.log("thf")</script>';
                if (isset($_COOKIE["returnPage"])){
                    $sender = parse_url($_COOKIE["returnPage"]);
                    echo $sender['path'];
                    header ('location:'.$sender['path']);
                    exit;
                }
                else{
                    //header ('location: /');
                    header ('location: /');
                    exit;
                }
                //TO DO: add code to go back to prev page//
            }
            else {
                $_SESSION['message'] = $state['ERR'];
                header ('location: /login');
                exit;

            }

        }
        else{
            require (ROOT_PATH.'/views/login_form.php');
        }
    }


    public static function logout(){
        if(session_id() == '') {
            session_start();
        }
        $_SESSION['message'] = "Logout successful!";
        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
            unset($_SESSION['admin_name']);
            unset($_SESSION['admin']);
        }
        else {
            unset($_SESSION["uid"]);
            unset($_SESSION["name"]);
            if (isset($_COOKIE["uid"])) {
                unset($_COOKIE['uid']);
                unset($_COOKIE['name']);
                setcookie('uid');
                setcookie('name');
            }
        }

    }
    //$password,$email,$address,$district,$rpw,$province,$mobile,$firstname,$lastname)
    public function register_form(){
        if (array_key_exists('register', $_POST)&&isset($_POST["email"]) && isset($_POST["password"]) &&
            isset($_POST["firstname"]) && isset($_POST["lastname"])&&isset($_POST["mobile"])&&isset($_POST["address"])
            &&isset($_POST["province"])&&isset($_POST["district"])&&isset($_POST["rpw"])) {
             if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
                $_SESSION['message'] = "You are admin";
                header('location: /login'); // Chuyển hướng đến trang admin
                exit();
            }
            $email = $_POST["email"];
            $password = $_POST["password"];
            $address= $_POST["address"];
            $district=$_POST["district"];
            $rpw=$_POST["rpw"];
            $province=$_POST["province"];
            $mobile=$_POST["mobile"];
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];

            $state=$this->model->register($password,$email,$address,$district,$rpw,$province,$mobile,$firstname,$lastname);

            echo '<script>console.log("'.$state['status'].'")</script>';
            if ($state['status']=='error'){
                $_SESSION['message'] =$state['ERR'];
                //echo $state['ERR'];
                header ('location: /register');
                exit;

            }
            else if ($state['status']=='success'){
                if (isset($_COOKIE["returnPage"])){
                    $sender = parse_url($_COOKIE["returnPage"]);
                    echo $sender['path'];
                    header ('location:'.$sender['path']);
                    exit;
                }
                else{
                    //header ('location: /');
                    header ('location: /');
                    exit;
                }
            }
            else if ($state['status']=='exist'){
                $_SESSION['message'] = "Your email have been already registered!";
                header ('location: /register');
                exit;
            }

        }
        else{
            require (ROOT_PATH.'/views/register_form.php');
        }
    }


    public function passManagement()
    {
        if (array_key_exists('savePass', $_POST)) {
            $password = $_POST["password"];
            $rpw=$_POST["rpw"];
            $oldpassword=$_POST["oldpassword"];
            $state=$this->model->passManagement($password,$rpw,$oldpassword);
            echo '<script>console.log("'.$state['status'].'")</script>';
            if ($state['status']!='success'){
                $_SESSION['message']="Update failed. Please try again!";
            }
            else{
                $_SESSION['message']="Update successfully";
            }
            header ('location: /user_info');
            exit;
            // header ('location: /');
        }
        else{
            $user_info = $this->model->dumpInfo();
            require (ROOT_PATH.'/views/password.php');
        }
    }


    public function showInfo()
    {

        if (array_key_exists('save', $_POST)) {
            $email = $_POST["email"];
            $address= $_POST["address"];
            $district=$_POST["district"];
            $province=$_POST["province"];
            $mobile=$_POST["mobile"];
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
            $state=$this->model->updateInfo($email,$address,$district,$province,$mobile,$firstname,$lastname);
            echo '<script>console.log("'.$state['status'].'")</script>';
            if ($state['status']!='success'){
                $_SESSION['message']="Update failed. Please try again!";
            }

            header ('location: /user_info');
            exit;
        }
        else{
            $user_info = $this->model->dumpInfo();
            //echo '<script>console.log("'.$user_info["first_name"].'")</script>';
            require (ROOT_PATH.'/views/user_info.php');
            //$this->render('views/cart.php', $data);
        }
    }

}

?>
