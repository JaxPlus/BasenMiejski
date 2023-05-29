<?php
    class CreateNews {
        private string $title;
        private $content;
        private $img;
        private $sportEvent;
        private $uploadOk = true;
        private $imageFileType;
        private $error;

        public function __construct($title, $content, $img, $sportEvent = false) {
            $this->title = $title;
            $this->content = $content;
            $this->img = $img;
            $this->sportEvent = $sportEvent;
        }

        // Wyświetlanie formularza - żeby mi to html'a nie zaśmiecało
        public static function echoForm()
        {
            echo "<div class='formForNews'>
                <form action='' method='post' enctype='multipart/form-data'>
                    <label for='title'>Tytuł:</label>
                    <input required type='text' name='title' id='title' maxlength='30'>

                    <label for='content'>Ogłoszenie:</label>
                    <textarea required name='content' cols='30' rows='5'></textarea>

                    <label for='image'>Zdjęcie:</label>
                    <input required type='file' name='image' id='image' accept='image/*'>

                    <label id='labelForSportE' for='sportEvent'>
                        Czy jest to wydarzenie sportowe:
                        <input type='checkbox' name='sportEvent' id='sportEvent'>
                    </label>

                    <input type='submit' value='Stwórz nową aktualność'>
                </form>
            </div>";
        }

        private function querySQLAll()
        {
            $this->setFileName();
            $fileName = $this->img['name'];
            if ($this->sportEvent == 'on') {
                $querySQLAll = "INSERT INTO news(FK_idUser, creationDate, newsTitle, content, img, sportEvent) VALUES ($_SESSION[idUser], CURRENT_DATE(), '$this->title', '$this->content', '$fileName', 1)";
            }
            else {
                $querySQLAll = "INSERT INTO news(FK_idUser, creationDate, newsTitle, content, img, sportEvent) VALUES ($_SESSION[idUser], CURRENT_DATE(), '$this->title', '$this->content', '$fileName', 0)";
            }

            return $querySQLAll;
        }

        public function fileUpload()
        {
            $this->setFileName();
            $target_dir = "../Classes/Admin/Images/";
            $target_file = $target_dir .basename($this->img["name"]);
            $this->imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Sprawdzenie czy plik jest zdjęciem czy też nie
            $check = getimagesize($this->img["tmp_name"]);
            
            try {
                $this->isAnImage($check);
                $this->ifFileExists($target_file);
                $this->ifFileIsToBig();
                $this->fileType();
                
                $this->ifAllIsOk($target_file);
            }
            catch (Exception $err) {
                $err = $err->getMessage();
                $this->error = "<div class='error tablecenter'>$err</div>";
            }
        }

        private function setFileName()
        {            
            $this->img['name'] = str_replace(" ", "%20", $this->img['name']);
        }

        private function isAnImage($check)
        {
            if($check !== false) {
                $this->uploadOk = true;
            }
            else {
                $this->uploadOk = false;
                throw new Exception("Ten plik nie jest zdjęciem.");
            }
        }

        private function ifFileExists($target_file)
        {
            if (file_exists($target_file)) {
                $this->uploadOk = false;
                throw new Exception("Przepraszamy ale ten plik już istnieje, proszę wybrać inny.");
            }
        }

        public function ifFileIsToBig()
        {
            if ($this->img["size"] > 2097152) {
                $this->uploadOk = false;
                throw new Exception("Przepraszamy ale twój plik jest za duży.");
            }
        }

        private function fileType()
        {
            if($this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg") {
                $this->uploadOk = false;
                throw new Exception("Przepraszamy tylko zdjęcia JPG, JPEG i PNG są dozwolone.");
            }
        }

        private function ifAllIsOk($target_file)
        {
            if ($this->uploadOk == false) {
                throw new Exception("Przepraszamy, plik nie został wysłany. Prosimy spróbować jeszcze raz.");
                // Jeśli wszystko jest dobrze to trza zupload'ować plik
              }
              else {

                if (move_uploaded_file($this->img["tmp_name"], $target_file)) {
                    echo "<div id='fileUploaded'>Ten plik ". htmlspecialchars(basename($this->img["name"])) ." został wysłany.</div>";
                }
                else {
                    throw new Exception("Przepraszamy, wystąpił problem z wysyłaniem pliku. Spróbuj jeszcze raz.");
                }
            }
        }

        public function createNews()
        {
            $querySQLAll = $this->querySQLAll();

            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection)) {

                $this->fileUpload();

                if (empty($this->error)) {
                    $connection->query($querySQLAll);
                    echo "<div>Aktualizacja została pomyślnie dodana!</div>";
                    $connection->close();
                }
                else
                {
                    echo "<div id='fileUploaded'>$this->error</div>";
                }
            }
            else {
                echo $connection;
            }
        }
    }