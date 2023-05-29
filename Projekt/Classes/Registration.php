<?php
    require_once("Validation.php");

    class Registration extends Validation {
        // Do bazy
        protected $connection;

        // Flaga do walidacji
        protected $f_ok = true;

        public function __construct($fname, $lname, $password, $email, $tel) {
            parent::__construct($fname, $lname, $password, $email, $tel);
        }

        // Override metody allTest
        public function allTest()
        {
            require_once ("ConnectionToDB.php");

            $conn = new ConnectToDB();
            $this->connection = $conn->getConnection();

            if (is_object($this->connection))
            {
                // Tu będą wszystkie testy
                $this->fNameLength();
                $this->fNameWithLetters();
                $this->lNameLength();
                $this->lNameWithLetters();
                $this->emailSanitalize();
                $this->telVerification();
                $this->telLength();
                $this->passwCheck();

                // Metoda odpowiadająca za zapamiętywanie danych
                $this->formRemember();
                
                // Zapytanka do rejestacji
                $querySQLRegistration = "INSERT INTO user (firstName, lastName, password, email, tel) VALUES ('$this->fname', '$this->lname', '$this->password_hashed', '$this->email', '$this->tel');";
                $querySQLEmail = "SELECT idUser FROM user WHERE email = '$this->email'";
                $querySQLTel = "SELECT idUser FROM user WHERE tel = '$this->tel'";

                try
                {
                    // Sprawdzanie czy istnieją duplikaty emailów i telefonu
                    $this->checkingIfAnyOthers($querySQLEmail, "email");
                    $this->checkingIfAnyOthers($querySQLTel, "tel");

                    // Ciasteczko do zapamiętywania akcji
                    setcookie('rejestracja', true);

                    if ($this->f_ok) {

                        // No i cyk kolejna marna duszycza wpadła w sidła tej strony hehehe
                        if ($this->connection->query($querySQLRegistration))
                        {
                            // Do podstrony witaj.php
                            $_SESSION['isLog'] = true;
                            $_SESSION['successfulRegistration'] = true;

                            // Usuwanie niepotrzebnego ciasteczka
                            if (isset($_COOKIE['rejestracja'])){ setcookie("rejestracja", false); }

                            header('Location: ./witamy.php');
                        }
                        else
                        {
                            throw new Exception($this->connection->error);
                        }
                    }
                }
                catch (Exception $e)
                {
                    echo "<div>Błąd jakiś: $e</div>";
                }
            }
            else
            {
                echo $this->connection;
            }
        }
    }