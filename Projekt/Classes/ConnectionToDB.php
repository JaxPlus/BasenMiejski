<?php

    class ConnectToDB {
        // Dane do bazy danych
        private $host = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'basen';

        // Połączenie do bazy
        private $connection;
        
        // I ewentualnie błąd
        private $error;

        // Tu połączenie do bazy jest sprawdzane a metoda zwraca true jeśli zadziała lub false jeśli nie zadziała
        public function testDBConnection()
        {
            mysqli_report(MYSQLI_REPORT_STRICT);
		
            try 
            {
                $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

                if ($this->connection->connect_errno != 0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    return true;
                }
			}
            catch(Exception $error)
            {
                $this->error = $error->getMessage();
            }
        }

        // ta funkcja sprawdza czy nie ma błędów i daje połączenie z bazą
        public function getConnection()
        {
            if ($this->testDBConnection()) {
                return $this->connection;
            }
            else {
                return $this->error;
            }
        }
    }