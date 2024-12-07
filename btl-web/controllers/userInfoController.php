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
                        }
                        else{
                            //header ('location: /');
                            header ('location: /');
                        }
                        //TO DO: add code to go back to prev page//
                }
                else {
                    $_SESSION['message'] = "Login failed!";
                    header ('location: /login');

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
        unset($_SESSION["uid"]);
        unset($_SESSION["name"]);
        if (isset($_COOKIE["uid"])){
            unset($_COOKIE['uid']);
            unset($_COOKIE['name']);
            setcookie('uid');
            setcookie('name');
        }
        require_once (ROOT_PATH.'/views/layouts/logout_popup.php');

    }
    //$password,$email,$address,$district,$rpw,$province,$mobile,$firstname,$lastname)
    public function register_form(){
        if (array_key_exists('register', $_POST)&&isset($_POST["email"]) && isset($_POST["password"]) &&
            isset($_POST["firstname"]) && isset($_POST["lastname"])&&isset($_POST["mobile"])&&isset($_POST["address"])
            &&isset($_POST["province"])&&isset($_POST["district"])&&isset($_POST["rpw"])) {
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
                $_SESSION['message'] = "Registration failed!";
                //echo $state['ERR'];
                header ('location: /register');

            }
            else if ($state['status']=='success'){
                if (isset($_COOKIE["returnPage"])){
                    $sender = parse_url($_COOKIE["returnPage"]);
                    echo $sender['path'];
                    header ('location:'.$sender['path']);
                }
                else{
                    //header ('location: /');
                    header ('location: /');
                }
            }
            else if ($state['status']=='exist'){
                $_SESSION['message'] = "Your email have been already registered!";
                header ('location: /register');
            }

        }
        else{
            require (ROOT_PATH.'/views/register_form.php');
        }
    }



    public function showInfo()
    {
        $user_info = $this->model->dumpInfo();
        //echo '<script>console.log("'.$user_info["first_name"].'")</script>';
        require (ROOT_PATH.'/views/user_info.php');
        //$this->render('views/cart.php', $data);
    }

    private function render($view, $data = [])
    {
        extract($data); // Extract array keys as variables
        if (file_exists($view)) {
            include $view;
        } else {
            echo "View not found: $view";
        }
    }
}

?>
