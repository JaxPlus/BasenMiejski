<?php
    class CreatePass {
        private string $name;
        private string $lenghtOfPass;
        private string $description;
        private string $type;
        private string $priceOfPass;

        public function __construct($name, $lenghtOfPass, $description, $type, $priceOfPass) {
            $this->name = $name;
            $this->lenghtOfPass = $lenghtOfPass;
            $this->description = $description;
            $this->type = $type;
            $this->priceOfPass = $priceOfPass;
        }

        public static function echoForm()
        {
            echo '<div class="formForNews">
                <form action="" method="post">
                    <label for="name">Nazwa karnetu: </label>
                    <input required type="text" name="name" id="name">

                    <label for="name">Długość karnetu (w miesiącach): </label>
                    <input required type="number" max="12" min="1" name="lenghtOfPass" id="lenghtOfPass">

                    <label for="description">Opis: </label>
                    <input required type="text" name="description" id="description">

                    <label for="type">Typ karnetu: </label>
                    <input required type="text" name="type" id="type">

                    <label for="priceOfPass">Cena karnetu: </label>
                    <input required type="text" name="priceOfPass" id="priceOfPass">

                    <input type="submit" value="Utwórz nowy karnet">
                </form>
            </div>';
        }

        private function monthName()
        {
            if ($this->lenghtOfPass == 1) {
                $this->lenghtOfPass = $this->lenghtOfPass ." miesiąc";
            }
            elseif ($this->lenghtOfPass <= 2 && $this->lenghtOfPass >= 4) {
                $this->lenghtOfPass = $this->lenghtOfPass ." miesiące";
            }
            else {
                $this->lenghtOfPass = $this->lenghtOfPass ." miesięcy";
            }
        }
        
        private function checkIfNumberProvided()
        {
            if (is_numeric($this->priceOfPass)) {
                return true;
            }

            return false;
        }

        private function getQueryAll()
        {
            $this->monthName();
            return "INSERT INTO pass(name, lenghtOfPass, description, type, priceOfPass) VALUES ('$this->name', '$this->lenghtOfPass', '$this->description', '$this->type', '$this->priceOfPass')";
        }

        public function executeAll()
        {
            if ($this->checkIfNumberProvided()) {
                $connection = new ConnectToDB();
                $connection = $connection->getConnection();
    
                if (is_object($connection)) {
                    $connection->query("SET NAMES UTF8");
                    $connection->query($this->getQueryAll());
    
                    echo "<div>Karnet został pomyślnie dodany!</div>";
    
                    $connection->close();
                }
                else {
                    echo $connection;
                }
            }
            else
            {
                echo "<div class='error tablecenter'>Podaj prawidłowy format pieniędzy.</div>";
            }
        }
    }