<?php
    class IssetEchoClass {
        public function issetEcho($toIsset, $type)
        {
            if (isset($type)) {
                if ($type == "error") {
                    echo '<div class="error">'. @$_SESSION[$toIsset].'</div>';
                    unset($_SESSION[$toIsset]);
                }
                elseif ($type == "value") {
                    echo @$_SESSION[$toIsset];
                    unset($_SESSION[$toIsset]);
                }
            }
        }
    }