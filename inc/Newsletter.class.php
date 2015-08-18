<?php
class Newsletter
{
    private static $email;
    public static $name;
    private static $valid = true;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function register($email) {
        if (!empty($_POST)) {
            self::$email    = $_POST['signup-email'];
            self::$name    = $_POST['name'];

            if (empty(self::$email)) {
                $status  = "error";
                $message = "The email address field must not be blank";
                self::$valid = false;
            } else if (!filter_var(self::$email, FILTER_VALIDATE_EMAIL)) {
                $status  = "error";
                $message = "You must fill the field with a valid email address";
                self::$valid = false;
            }

            if (empty(self::$name)) {
                $status  = "error";
                $message = "The name field must not be blank";
                self::$valid = false;
            } else if (!filter_var(self::$name)) {
                $status  = "error";
                $message = "You must fill the field with a valid email address";
                self::$valid = false;
            }




            if (self::$valid) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $existingSignup = $pdo->prepare("SELECT COUNT(*) FROM signups WHERE signup_email_address='$email'");
                $existingSignup->execute();
                $data_exists = ($existingSignup->fetchColumn() > 0) ? true : false;

                if (!$data_exists) {
                    $sql = "INSERT INTO signups (signup_email_address, user_name) VALUES (:email, :name)";
                    $q = $pdo->prepare($sql);

                    $q->execute(
                        array(':email' => self::$email,':name' => self::$name,));

                    if ($q) {
                        $status  = "success";
                        $message = "You have been successfully subscribed";
                    } else {
                        $status  = "error";
                        $message = "An error occurred, please try again";
                    }
                } else {
                    $status  = "error";
                    $message = "This email is already subscribed";
                }
            }

            $data = array(
                'status'  => $status,
                'message' => $message
            );

            echo json_encode($data);

            Database::disconnect();
        }
    }
}