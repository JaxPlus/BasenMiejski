<?php
    class UserManagement {

        public static function echoUsers()
        {
            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection))
            {
                $connection->query("SET NAMES UTF8");
                $querySQLUsers = "SELECT idUser, firstName, lastName, email, tel, admin FROM user";
                $queryUsers = $connection->query($querySQLUsers);

                echo "<div class='usersTable'>
                    <table class='tablecenter'>
                        <tr><th>Id</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Telefon</th><th>Administrator</th><th>Usuń</th></tr>";
                    while($row = mysqli_fetch_row($queryUsers))
                    {
                        $admin = ($row[5] == 1) ? "Tak" : "Nie";
                        $adminInput = ($row[5] == 1) ? "disabled" : "";
                        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$admin</td><td><form class='formForDel' method='post'><input hidden type='number' name='userId' value='$row[0]'><input $adminInput type='submit' value='Usuń'></form></td></tr>";
                    }
                    echo "</table>
                </div>";
                $connection->close();
            }
            else
            {
                echo $connection;
            }
        }

        public function deleteUser($idUser)
        {
            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection)) {
                $querySQLDeleteUser = "DELETE FROM user WHERE idUser = $idUser";
                $connection->query($querySQLDeleteUser);

                echo "<div>Użytkownik został pomyślnie usunięty</div>";

                $connection->close();
            }
            else
            {
                echo $connection;
            }
        }
    }