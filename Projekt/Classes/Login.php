<?php
    require_once ("ConnectionToDB.php");
    require_once("Validation.php");

    class Login extends Validation {

        public function __construct($email, $password) {
            $this->email = $email;
            $this->password = $password;
        }

        public function allTest()
        {
            $conn = new ConnectToDB();
            $this->connection = $conn->getConnection();

            if (is_object($this->connection))
            {
                $this->emailAndPasswordChecking($this->email, $this->password);

                // Ten if to coś mądrego czego nie pamiętam :P
                if ($result = $this->connection->query(sprintf("SELECT * FROM user WHERE email = '%s'", mysqli_real_escape_string($this->connection, $this->email))))
                {
                    $row = $this->checkingIfAnyOthers($result, "user");

                    if (isset($row['password'])) {
                        // Weryfikacja hasła -> czy hasło zgadza się z jego hashem
                        if (password_verify($this->password, $row['password'])) {
                            // To żeby wyświetlać wszystko fajnie na koncie
                            $_SESSION['isLog'] = true;
                            $_SESSION['idUser'] = $row['idUser'];
                            $_SESSION['fname'] = $row['firstName'];
                            $_SESSION['sname'] = $row['lastName'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['admin'] = $row['admin'];
                            
                            unset($_SESSION['e_log']);
                            $result->free_result();
                            header('Location: konto.php');
                        }
                        else 
                        {
                            $_SESSION['e_log'] = 'Nieprawidłowy login lub hasło!';
                        }
                    }
                }
            }
        }
    }