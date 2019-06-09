<?php
/*
 CREATE TABLE customer (
customer_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
car_id int NOT NULL,
fname varchar(40)NOT NULL,
lname varchar(40)NOT NULL,
email varchar(255) NOT NULL,
phone varchar(30) NOT NULL,
pick_up date NOT NULL,
drop_off date NOT NULL,
age int(11) NOT NULL,
FOREIGN KEY (car_id) REFERENCES car(car_id)
);

INSERT INTO car(name, seat,speed) VALUES
('Audi R8 V10', '2 seats', '2.9 seconds'),
('BMW I8 Coupe','2 seats', '3.8 seconds'),
('Ferrari 458 Italia','2 seats','3.0 seconds'),
('Lamborghini Aventador LP400-4','2 seats','2.8 seconds'),
('Lamborghini Huracan LP610-4','2 seats','2.5 seconds'),
('McLaren 650S','2 seats','3.0 seconds');
 */

$user = $_SERVER['USER'];
require '/home2/tluugree/config-car.php';
class Database
{
    private $_dbh;
    function __construct()
    {
        $this->connect();
    }
    function connect()
    {
        try
        {
            //instantiate a db object
            $this->_dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
            //echo "Connected!!";
            //return $this->_dbh;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function insertCustomer()
    {
        global $f3;
        $customer = $f3->get('customer');
        //1.Define the query
        $sql = "INSERT INTO customer(car_id,fname, lname, email, phone, pick_up, drop_off, age) 
        VALUES (:car_id,:fname, :lname, :email,:phone, :pick_up, :drop_off,:age)";

        //2.Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3.Bind the parameters
        $statement->bindParam(':car_id', $customer->getCar_id(), PDO::PARAM_STR);
        $statement->bindParam(':fname', $customer->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $customer->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':email', $customer->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $customer->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':pick_up', $customer->getPick_up(), PDO::PARAM_STR);
        $statement->bindParam(':drop_off', $customer->getDrop_off(), PDO::PARAM_STR);
        $statement->bindParam(':age', $customer->getAge(), PDO::PARAM_STR);


        //4.Execute the statement
        $statement->execute();
        $err = $statement->errorInfo();
        if(isset($err[2]))
        {
            print $err[2];
        }
        //5.Return the result

    }
    function getCustomer()
    {
        //1.Define the query
        $sql = "SELECT * FROM customer ORDER BY customer_id";
        //2.Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //3.Bind the parameters
        //4.Execute the statement
        $statement->execute();
        //5.Return the result
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function getConfirmation($customer_id)
    {
        //1.Define the query
        $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
        //2.Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        //3.Bind the parameters
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        //4.Execute the statement
        $statement->execute();
        //5.Return the result
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}