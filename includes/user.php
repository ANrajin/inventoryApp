<?php
    class User{
        private $con;

        public function __construct(){
            include_once('../database/db.php');
            
            $db = new Database();
            $this->con = $db -> connect();
        }

        //check whether user exists or not
        private function email_exists($email){
            $pre_stat = $this->con->prepare('SELECT user_id FROM user WHERE user_email = ?');
            $pre_stat->bind_param('s', $email);
            $pre_stat->execute() or die($this->con->error);

            $result = $pre_stat->get_result();

            if($result->num_rows > 0){
                return 1;
            }else{
                return 0;
            }
        }

        public function userAcc($user, $email, $pass, $userType){

            //generate hased password
            //$password = password_hash($pass, PASSWORD_BCRYPT, ['cost' => '8']);
            $password = md5($pass);

            //prepared statement to save from sql attacks
            if($this->email_exists($email)){
                return "Email_Already_Exists";
            }else{
                $pre_stat = $this->con->prepare(
                    'INSERT INTO `user`(`user_name`, `user_email`, `user_password`, `user_type`, `register_date`, `last_login`)
                    VALUES (?,?,?,?,?,?)'
                );

                $date = date('Y-m-d');
                $pre_stat -> bind_param('ssssss', $user, $email, $password, $userType, $date, $date);
                $result = $pre_stat->execute() or die($this->con->error);

                if($result){
                    return $this->con->insert_id;
                }
                else{
                    return "Error_Occured";
                }
            }
            
        }

        //Userlogin
        public function userLogin($email, $pass){
            $password = md5($pass);

            $pre_stat = $this->con->prepare('SELECT user_id, user_name, user_password, last_login FROM user WHERE user_email = ?');
            $pre_stat -> bind_param('s', $email);
            $pre_stat -> execute() or die($this->con->error);
            $result = $pre_stat->get_result();

            if($result->num_rows < 1){
                return "Not Registered";
            }
            else{
                $row = $result->fetch_assoc();
                $hash = $row['user_password'];

                if($password == $hash){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['last_login'] = $row['last_login'];

                    //update user last login time while login
                    $last_login = date('Y-m-d h:m:s');
                    $pre_stat = $this->con->prepare('UPDATE user SET last_login = ? WHERE user_email = ?');
                    $pre_stat->bind_param('ss', $last_login, $email);
                    $result = $pre_stat->execute() or die($this->con->error);

                    if($result){
                        return $_SESSION['user_id'] = $row['user_id'];
                    }else{
                        return 0;
                    }
                }else{
                    return "Password do not matched";
                }
            }
        }
    }

// $user = new User;
//$user->userAcc($user, $email, $pass, $userType);
// echo $user->userAcc('Admin', 'admin@email.com','123', 'Admin');

// echo $user->userLogin('admin@email.com', '123');
