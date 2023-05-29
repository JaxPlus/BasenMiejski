<?php
    class Resigntaion {
        private $querySQLResignation;
        private $querySQLResignation2;
        private $querySQLResignationOfTicket;

        public function __construct($idOfOrder) {
            $this->querySQLResignation = "SELECT idOrder, orderDate, price, numberOfTickets, numberOfReducedTickets FROM `order` WHERE idOrder = $idOfOrder;";
            $this->querySQLResignation2 = "DELETE FROM `order` WHERE idOrder = $idOfOrder";
            $this->querySQLResignationOfTicket = "DELETE FROM ticket WHERE FK_idOrder = $idOfOrder";
        }

        public function getQuerySQLResignation()
        {
            return $this->querySQLResignation;
        }

        public function executeQueries($connection)
        {
            $connection->query($this->querySQLResignationOfTicket);
            $connection->query($this->querySQLResignation2);
        }
    }