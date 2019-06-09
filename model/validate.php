<?php
//name

function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}
//age
function validAge($age)
{
    return !empty($age) && ctype_digit($age) && (int)$age >= 25 && (int)$age <= 118;
}
//phone
function validPhone($phone)
{
    return ctype_digit($phone) && strlen($phone) === 10;
}
//email
function validEmail($email)
{
    return filter_var($email);
}

//form
function form()
{
    global $f3;
    $isValid = true;
    if (!validName($f3->get('fname'))) {
        $isValid = false;
        $f3->set("errors['fname']", "Please enter your first name");
    }
    if (!validName($f3->get('lname'))) {
        $isValid = false;
        $f3->set("errors['lname']", "Please enter your last name");
    }
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter your age ");
    }
    if (!validPhone($f3->get('phone'))) {
        $isValid = false;
        $f3->set("errors['phone']", "Please enter your phone number");
    }
    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }
    return $isValid;
}
