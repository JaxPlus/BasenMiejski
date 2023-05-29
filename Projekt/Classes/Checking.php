<?php

    class Checking {
        public static function canBeHere($session_something, $location)
        {
            if (empty($_SESSION[$session_something]))
            {
                header("Location: $location");
                exit();
            }
        }

        public static function ticketErrorClear()
        {
            for ($i=1; $i <= 5; $i++) { 
                if (isset($_SESSION['fr_kid'. $i])) unset($_SESSION['fr_kid'. $i]);
                if (isset($_SESSION['e_date'. $i])) unset($_SESSION['e_date'. $i]);
                if (isset($_SESSION['fr_arrivalDate'. $i])) unset($_SESSION['fr_arrivalDate'. $i]);
            }
        }
    }
?>