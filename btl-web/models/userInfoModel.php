


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
    private function checkMobile($mobile)
    {
        return preg_match("/^\d+$/", $mobile);
    }
    public function login($email, $password, $checkbox)
    {
        $email = mysqli_real_escape_string($this->db, $email);
        $password = mysqli_real_escape_string($this->db, $password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$this->checkPassword($password)) {
            return [
                'status' => 'failed',
                'ERR'=> 'wrong input format'
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
            return [
                'status' => 'success',
                'ERR'=> ''
            ];
        } else {

            return [
                'status' => 'failed',
                'ERR'=> 'wrong validation'
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

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)||!$this->checkPassword($password)||empty($district)||empty($address)||empty($province)
            ||!$this->checkRePassword($password,$rpw)||!$this->checkName($firstname)||!$this->checkName($lastname)||!$this->checkMobile($mobile)) {
            if ( empty($address)) {
                return [
                    'status' => 'error',
                    'ERR'=> 'invalid mobil'
                ];
            }
            return [
                'status' => 'error',
                'ERR'=> 'invalid input'
            ];
        }
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
    public function passManagement( $password,$rpw,$oldpassword)
    {
        $password = mysqli_real_escape_string($this->db, $password);
        $oldpassword = mysqli_real_escape_string($this->db, $oldpassword);
        $rpw = mysqli_real_escape_string($this->db, $rpw);

        if (isset($_COOKIE["uid"]) || isset($_SESSION["uid"])) {
            if (!(isset($_SESSION["uid"]))) {
                $_SESSION["uid"] = $_COOKIE["uid"];
                $_SESSION["name"] = $_COOKIE["name"];
            }

            if (!$this->checkPassword($oldpassword) || !$this->checkPassword($password) || !$this->checkRePassword($password,$rpw)) {
                return [
                    'status' => 'failed',
                ];
            }
            $oldpassword=md5($oldpassword);
            $password=md5($password);
            $sql = "SELECT * FROM user_info WHERE user_id = '".$_SESSION["uid"]."' AND password = '$oldpassword'";
            $run_query = mysqli_query($this->db, $sql);
            $count = mysqli_num_rows($run_query);
            //if user record is available in database then $count will be equal to 1
            if ($count == 1) {
                $sql = "UPDATE user_info SET password = '$password' WHERE user_id = '".$_SESSION["uid"]."' LIMIT 1";
                $run_query = mysqli_query($this->db, $sql);
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
            else{
                return [
                    'status' => 'failed',
                ];
            }

        }
    }

    public function updateInfo( $email, $address, $district, $province, $mobile, $firstname, $lastname)
    {


        $email = mysqli_real_escape_string($this->db, $email);
        $address = mysqli_real_escape_string($this->db, $address);
        $district = mysqli_real_escape_string($this->db, $district);
        $province = mysqli_real_escape_string($this->db, $province);
        $firstname = mysqli_real_escape_string($this->db, $firstname);
        $lastname = mysqli_real_escape_string($this->db, $lastname);
        //echo $firstname;

        if (isset($_COOKIE["uid"]) || isset($_SESSION["uid"])) {
            if (!(isset($_SESSION["uid"]))) {
                $_SESSION["uid"] = $_COOKIE["uid"];
                $_SESSION["name"] = $_COOKIE["name"];
            }

            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {

                return [
                    'status' => 'error',
                    'ERR' => 'invalid email'
                ];
            }

            if (!empty($lastname) && !$this->checkName($lastname)) {

                return [
                    'status' => 'error',
                    'ERR' => 'invalid name'
                ];
            }
            if (!empty($firstname) && !$this->checkName($firstname)) {

                return [
                    'status' => 'error',
                    'ERR' => 'invalid name'
                ];
            }
            if (!empty($mobile) && !$this->checkMobile($mobile)) {
                return [
                    'status' => 'error',
                    'ERR' => 'invalid mobile'
                ];
            }
            $sql = "UPDATE user_info SET ";
            if (!empty($email)) $sql .= "email = '$email' , ";
            if (!empty($address)) $sql .= "address = '$address' , ";
            if (!empty($province)) $sql .= "province = '$province' , ";
            if (!empty($district)) $sql .= "district  = '$district' , ";
            if (!empty($firstname)) $sql .= "first_name = '$firstname' , ";
            if (!empty($lastname)) $sql .= "last_name = '$lastname' , ";
            if (!empty($mobile)) $sql .= "mobile = '$mobile' ,";
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE user_id = '$_SESSION[uid]'";
            echo $sql;
            $run_query = mysqli_query($this->db, $sql);
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
}
?>