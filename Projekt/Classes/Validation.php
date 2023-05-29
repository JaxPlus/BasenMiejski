<?php

    abstract class Validation {
        // Do bazy
        protected $connection;

        // Dane od użytkownika
        protected $fname;
        protected $lname;
        protected $password;
        protected $password_hashed;
        protected $email;
        protected $tel;

        // Ewentualny błąd
        protected $error;

        // Flaga do walidacji
        protected $f_ok = true;

        // Przypisanie wartości od użytkownika
        public function __construct($fname, $lname, $password, $email, $tel) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->password = $password;
            $this->email = $email;
            $this->tel = $tel;
        }

        // Sprawdzanie rejestracji
        // Sprawdzanie długości imienia
        protected function fNameLength()
        {
            if ((strlen($this->fname) < 2) || (strlen($this->fname) > 20))
            {
                $this->f_ok = false;
                $_SESSION['e_fname'] = "Imie musi posiadać od 2 do 20 znaków!";
            }
        }

        // Sprawdzanie czy imie ma litery
        protected function fNameWithLetters()
        {
            if (!preg_match('/^[\p{Latin}]+$/u', $this->lname))
            {
                $this->f_ok = false;
                $_SESSION['e_fname'] = "Imie może składać się tylko z liter!";
            }
        }

        // Sprawdzanie długości nazwiska
        protected function lNameLength()
        {
            if ((strlen($this->lname) < 2) || (strlen($this->lname) > 20))
            {
                $this->f_ok = false;
                $_SESSION['e_lname'] = "Nazwisko musi posiadać od 2 do 20 znaków!";
            }
        }

        // Sprawdzanie czy nazwisko ma litery
        protected function lNameWithLetters()
        {
            if (!preg_match('/^[\p{Latin}]+$/u', $this->lname))
            {
                $this->f_ok = false;
                $_SESSION['e_lname'] = "Imie może składać się tylko z liter!";
            }
        }

        // Poprawność adresu email
        protected function emailSanitalize()
        {
            $emailB = filter_var($this->email, FILTER_SANITIZE_EMAIL);
		
            if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $this->email))
            {
                $this->f_ok = false;
                $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
            }
        }

        // Sprawdzanie czy istnieją duplikaty danego typu (wykorzystywane w klasach dziedziczących)
        protected function checkingIfAnyOthers($query, $type)
        {
            if ($type != "user") {
                $result = $this->connection->query($query);
                if (!$result) throw new Exception($this->connection->error);
    
                $numOfResults = $result->num_rows;
    
                if($numOfResults > 0)
                {
                    $this->f_ok = false;
                    if ($type == "email") {
                        $_SESSION['e_'. $type] = "Istnieje już konto przypisane do tego adresu e-mail!";
                    }
                    else if($type == "tel") {
                        $_SESSION['e_'. $type] = "Istnieje już taki numer telefonu! Podaj inny.";
                    }
                }
            }
            else if ($type == "user") {
                $result = $query;

                $numOfUsers = $result->num_rows;

                if($numOfUsers > 0)
                {
                    return $result->fetch_assoc();
                }
                else
                {
                    $_SESSION['e_log'] = 'Nieprawidłowy login lub hasło!';
                }
            }
        }

        // Sprawdzanie telefonu
        protected function telVerification()
        {
            if (!preg_match('/^[0-9]+$/u', $this->tel))
            {
                $this->f_ok = false;
                $_SESSION['e_tel'] = "Podaj poprawny numer telefonu!";
            }
        }

        // Sprawdzenie jego długości
        protected function telLength()
        {
            if (strlen($this->tel) != 9)
            {
                $this->f_ok = false;
                $_SESSION['e_tel'] = "Podaj prawidłową długość telefonu!";
            }
        }

        // Sprawdzanie długości telefonu
        protected function passwCheck()
        {
            if ((strlen($this->password) < 8) || (strlen($this->password) > 20))
            {
                $this->f_ok = false;
                $_SESSION['e_password'] = "Hasło musi posiadać od 8 do 20 znaków!";
            }

            $this->password_hashed = password_hash($this->password, PASSWORD_DEFAULT);
        }

        // Zapamiętywanie danych z formularza
        protected function formRemember()
        {
            $_SESSION['fr_fname'] = $this->fname;
            $_SESSION['fr_lname'] = $this->lname;
            $_SESSION['fr_passw'] = $this->password;
            $_SESSION['fr_email'] = $this->email;
            $_SESSION['fr_tel'] = $this->tel;
        }

        // Sprawdzanie emaila i hasła
        protected function emailAndPasswordChecking($email, $password)
        {
            $this->connection->query("SET NAMES UTF8");
                
            $this->email = $email;
            $this->password = $password;
            
            $this->email = htmlentities($this->email, ENT_QUOTES, "UTF-8");
        }

        // Testowanie połączenia jak i wykonywanie wszystkich testów - dzieci mają własne interpretacje
        protected abstract function allTest();
    }