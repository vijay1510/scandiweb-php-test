<?php

namespace Src\database;
use PDO;




class Database {

    private $connection = null;

     public function __construct()
    {
        try {
             $this->connection =  new PDO('mysql:host=' . HOST, USER, PASSWORD);
             //$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $this->connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'products_server';");
            if (!$statement->fetchColumn()) {
            $statement = $this->connection->prepare(
                "CREATE DATABASE products_server;
                USE products_server;
                CREATE TABLE `products` (
                    `sku` varchar(255) COLLATE utf8_bin NOT NULL,
                    `name` varchar(255) COLLATE utf8_bin NOT NULL,
                    `price` float NOT NULL,
                    `type` varchar(255) COLLATE utf8_bin NOT NULL,
                    `value` varchar(255) COLLATE utf8_bin NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
              
                INSERT INTO `products` (`sku`, `name`, `price`, `type`, `value`) VALUES
                    ('GGWP0007', 'War and Peace', 20, 'Book', 'Weight: 2 KG'),
                    ('JVC200123', 'Acme DISC', 1, 'DVD', 'Size: 700 MB'),
                    ('TR120555', 'Chair', 40, 'Furniture', 'Dimensions: 24x45x15 CM');
              
              
                ALTER TABLE `products`
                    ADD PRIMARY KEY (`sku`);
                COMMIT;"
            );
            $statement->execute();
            $statement->closeCursor();
            echo "database connected";
        }

        } catch (PDPException $e) {
            echo $e->getMessage();
        }


       $this->connection->query("USE products_server;");
    }

   
}