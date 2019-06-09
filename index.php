<?php
require_once('vendor/autoload.php');
session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file autoload.php
require_once('model/validate.php');

//Create an instance of the Base class/ instantiate Fat-Free
$f3 = Base::instance();

//get to database
$db = new Database();

//Turn on Fat-free error reporting/Debugging
$f3->set('DEBUG', 3);

//Define a default route (use backlash / )
$f3->route('GET /', function () {
    //Display a view-set view as new template and echo out the view
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /fleet', function ($f3)
{
    if(!empty($_POST))
    {
        //Get data
        $car_id=$_POST['car_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pick_up =$_POST['pick_up'];
        $drop_off=$_POST['drop_off'];
        $age = $_POST['age'];


        //Add to hive
        $f3->set('car_id', $car_id);
        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        $f3->set('pick_up', $pick_up);
        $f3->set('drop_off', $drop_off);
        $f3->set('age', $age);

        //Validate form
        if (form())
        {
            //Session
            $_SESSION['car_id'] = $car_id;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['pick_up'] = $pick_up;
            $_SESSION['drop_off'] = $drop_off;
            $_SESSION['age'] = $age;

            $customer = new Customer($car_id,$fname,$lname,$email,$phone,$pick_up,$drop_off,$age);
            $_SESSION['customer'] = $customer;

            //reroute to profile
            $f3->reroute('/confirmation');
        }
    }
    $view=new Template();
    echo $view->render( 'views/fleet.html');
});

//confirmation
$f3->route('GET|POST /confirmation', function ($f3)
{

    $f3->set("customer", $_SESSION['customer']);
    global $db;

    $db->insertCustomer();
    $view=new Template();
    echo $view->render( 'views/confirmation.html');

});

$f3->route('GET|POST /admin', function($f3)
{
    global $db;
    $f3->set('db', $db);
    $f3->set('customers', $db->getCustomer());
    $view = new Template();
    echo $view->render('views/admin.html');
    session_destroy();
});

//contact
$f3 ->route('GET|POST /contact', function() {
    $view = new Template();
    echo $view ->render('views/contact.html');
});

//Run fat free F3
$f3->run();