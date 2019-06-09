<?php
/**
 * Class customer
 */
class Customer
{
    /**
     * @var fname, lname, age, phone, email, pickup, dropoff
     */
    //declare attribute
    private $_car_id;
    private $_fname;
    private $_lname;
    private $_email;
    private $_phone;
    private $_pick_up;
    private $_drop_off;
    private $_age;

    /**
     * Customer constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $email
     * @param $phone
     * @param $pick_up
     * @param $drop_off
     */
    //parameterized constructor
    function __construct($car_id,$fname, $lname,  $email, $phone,$pick_up,$drop_off, $age)
    {
        $this->_car_id = $car_id;
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_pick_up = $pick_up;
        $this->_drop_off = $drop_off;
        $this->_age = $age;
    }
    //Setter and getter

    /**
     * @return car_id
     */
    public function getCar_id()
    {
        return $this->_car_id;
    }
    public function setCar_id($car_id)
    {
        $this->_car_id = $car_id;
    }
    /**
     * @return first name String
     */
    public function getFname()
    {
        return $this->_fname;
    }
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }
    /**
     * @return last name String
     */
    public function getLname()
    {
        return $this->_lname;
    }
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return email
     */
    public function getEmail()
    {
        return $this->_email;
    }
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return phone number integer
     */
    public function getPhone()
    {
        return $this->_phone;
    }
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return pickup date
     */
    public function getPick_up()
    {
        return $this->_pick_up;
    }
    public function setPick_up($pick_up)
    {
        $this->_pick_up = $pick_up;
    }

    /**
     * @return dropoff date
     */
    public function getDrop_off()
    {
        return $this->_drop_off;
    }
    public function setDrop_off($drop_off)
    {
        $this->_drop_off = $drop_off;
    }

    /**
     * @return age integer
     */
    public function getAge()
    {
        return $this->_age;
    }
    public function setAge($age)
    {
        $this->_age = $age;
    }

}
