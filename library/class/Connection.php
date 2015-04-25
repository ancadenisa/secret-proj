<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '/../config.php';

/**
 * Description of Connection
 *
 * @author radu
 * 
 */
class Connection 
    {

        static protected $instance = null;
        protected $conn = null;
        protected $host = "127.0.0.1";
        protected $dbname = "avizier";
        protected $dbuser = "root";
        protected $dbpassword = "";


        /** Conection Constructor
         *
         */
        public function __construct()
        {

            try {
                $this->conn = new PDO
                ('mysql:host=' . $this->host . ';port=3306;dbname=' . $this->dbname, $this->dbuser, $this->dbpassword, array(PDO::ATTR_PERSISTENT => true));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Exception: " . $e->getMessage() . "<br>";
                die ('Could not connect to database!');
            }

        }


        /** Getting Instance of Connection
         *
         * @return DatabaseConnection|null
         */
        static public function getInstance()
        {

            if (self::$instance == null) {
                self::$instance = new self();

                return self::$instance;
            }
            else {
                return self::$instance;
            }

        }


        /** Getting Connection
         *
         * @return null|PDO
         */
        public function getConnection()
        {

            return $this->conn;

        }

    }
