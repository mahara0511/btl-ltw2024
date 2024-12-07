


<?php

class userInfoModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    private function checkPassword($password)
    {
        return (strlen($password) >= 6) && (preg_match("/[A-Z]/", $password) && preg_match("/[a-z]/", $password) && preg_match("/[0-9]/", $password));
    }

    private function checkRePassword($password, $rePassword)
    {
        return $password == $rePassword;
    }

    private function checkName($name)
    {
        $name = mb_strtolower($name);
        return preg_match("/^[a-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]+$/", $name);
    }

    public function login($email, $password, $checkbox)
    {
        $email = mysqli_real_escape_string($this->db, $email);
        $password = mysqli_real_escape_string($this->db, $password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$this->checkPassword($password)) {
            return [
                'status' => 'success',
                'IAM' => 'user'
            ];
        }

        $password = md5($password);
        $sql = "SELECT * FROM user_info WHERE email = '$email' AND password = '$password'";
        $run_query = mysqli_query($this->db, $sql);
        $count = mysqli_num_rows($run_query);
        $row = mysqli_fetch_array($run_query);

        //if user record is available in database then $count will be equal to 1
        if ($count == 1) {
            $_SESSION["uid"] = $row["user_id"];
            $_SESSION["name"] = $row["first_name"];
            if (!empty($checkbox)) {
                setcookie("uid", $row["user_id"], time() + 7200);
                setcookie("name", $row["first_name"], time() + 7200);
            }
            $ip_add = getenv("REMOTE_ADDR");
            if (isset($_COOKIE["product_list"])) {
                $p_list = stripcslashes($_COOKIE["product_list"]);
                //here we are decoding stored json product list cookie to normal array
                $product_list = json_decode($p_list, true);
                for ($i = 0; $i < count($product_list); $i++) {
                    //After getting user id from database here we are checking user cart item if there is already product is listed or not
                    $verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = " . $product_list[$i];
                    $result = mysqli_query($this->db, $verify_cart);
                    if (mysqli_num_rows($result) < 1) {
                        //if user is adding first time product into cart we will update user_id into database table with valid id
                        $update_cart = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND user_id = -1";
                        mysqli_query($this->db, $update_cart);
                    } else {
                        //if already that product is available into database table we will delete that record
                        $delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = " . $product_list[$i];
                        mysqli_query($this->db, $delete_existing_product);
                    }
                }
                //here we are destroying user cookie
                setcookie("product_list", "", strtotime("-1 day"), "/");
            }
            return [
                'status' => 'success',
                'IAM' => 'user'
            ];
        } else {

            return [
                'status' => 'failed',
                'IAM' => 'user'
            ];

        }
    }


    public function register($password, $email, $address, $district, $rpw, $province, $mobile, $firstname, $lastname)
    {
        $email = mysqli_real_escape_string($this->db, $email);
        $password = mysqli_real_escape_string($this->db, $password);
        $address = mysqli_real_escape_string($this->db, $address);
        $district = mysqli_real_escape_string($this->db, $district);
        $rpw = mysqli_real_escape_string($this->db, $rpw);
        $province = mysqli_real_escape_string($this->db, $province);
        $firstname = mysqli_real_escape_string($this->db, $firstname);
        $lastname = mysqli_real_escape_string($this->db, $lastname);
        //echo $firstname;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return [
                'status' => 'error',
                'ERR' => 'invalid email'
            ];
        }
        if (!$this->checkPassword($password)) {

            return [
                'status' => 'error',
                'ERR' => 'invalid pw'
            ];
        }
        if (empty($district) || empty($address) || empty($province)
        ) {

            return [
                'status' => 'error',
                'ERR' => 'invalid empty'
            ];
        }
        if (!$this->checkRePassword($password, $rpw)) {

            return [
                'status' => 'error',
                'ERR' => 'invalid rpw'
            ];
        }
        if (!$this->checkName($lastname)) {

            return [
                'status' => 'error',
                'ERR' => 'invalid name'
            ];
        }
        /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)||!$this->checkPassword($password)||empty($district)||empty($address)||empty($province)
        ||!$this->checkRePassword($password,$rpw)||!$this->checkName($firstname)||!$this->checkName($lastname)) {

            return [
                'status' => 'error',
                'ERR'=> 'invalid input'
            ];
        }*/
        $password = md5($password);
        $sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1";
        $check_query = mysqli_query($this->db, $sql);
        $count_email = mysqli_num_rows($check_query);
        if ($count_email > 0) {
            return [
                'status' => 'exist',
                'ERR' => ''
            ];
        } else {

            $sql = "INSERT INTO user_info (user_id, first_name, last_name, email, password, mobile, address,province,district) 
		VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '$mobile', '$address', '$province', '$district')";
            $run_query = mysqli_query($this->db, $sql);
            $_SESSION["uid"] = mysqli_insert_id($this->db);
            $_SESSION["name"] = $firstname;
            if ($run_query) {
                return [
                    'status' => 'success',
                    'ERR' => ''
                ];
            } else {
                return [
                    'status' => 'error',
                    'ERR' => 'DB ERROR'
                ];
            }
        }
    }

    function dumpInfo()
    {
        if (isset($_COOKIE["uid"]) || isset($_SESSION["uid"])) {
            if (!(isset($_SESSION["uid"]))) {
                $_SESSION["uid"] = $_COOKIE["uid"];
                $_SESSION["name"] = $_COOKIE["name"];
            }
            //"SELECT first_name FROM user_info WHERE user_id='$_SESSION[uid]'"
            $sql = "SELECT first_name, last_name, email, mobile, address,province,district FROM user_info WHERE user_id='$_SESSION[uid]' LIMIT 1";
            $run_query = mysqli_query($this->db, $sql);
            $user_data = mysqli_fetch_array($run_query);
            return $user_data;
        }
         return [];

    }
}
?>