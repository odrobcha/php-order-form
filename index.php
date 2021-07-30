<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

if(!empty($_GET)){
    foreach ($_GET as $key=>$get){
        if(!in_array($key, ['order'])){
            unset($_GET[$key]);
        }
    }

    if(!in_array($_GET['order'], ['food', 'drinks'])){
        unset($_GET['order']);
    }
}

$order = $_GET['order'] ?? 'drinks';

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';

    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    echo('<pre>');
    var_dump($_POST);
    echo ('</pre>');

    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
whatIsHappening();

// TODO: provide some products (you may overwrite the example)
$drinks = [
    ['name' => 'Fanta', 'price' => 2.5],
    ['name' => 'Coca Cola', 'price' => 2.5],
    ['name' => 'Black tea', 'price' => 3],
    ['name' => 'Coffee', 'price' => 3.5],
    ['name' => 'Iced Coffee', 'price' => 4],
    ['name' => 'Irish Coffee', 'price' => 6],
];

$food = [
    ['name' => 'Apple', 'price' => 2.5],
    ['name' => 'Watter melon', 'price' => 2.5],
    ['name' => 'Orange', 'price' => 3],
    ['name' => 'Black Berries', 'price' => 3.5],
    ['name' => 'Pear', 'price' => 4],
    ['name' => 'Lemon', 'price' => 6],
];
//function totalValue ($productsList) use ($products){ to use var wicch are out of this function
function totalValue ($productsList){
    $chosenProduct = $_POST['products'];
    $totalPrice = 0;
    foreach($chosenProduct as $productNumber => $product) {
        $totalPrice +=$productsList[$productNumber]['price'];
    };
    return $totalPrice;
};

function validate(): array
{
    $errors = [];
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_POST['email'] = '';
        array_push($errors, 'Please, check your email address');
    }
    if ($_POST['street'] == ''){
        $_POST['street'] = '';
        array_push($errors, 'Street field can not be empty');
    }
    if ($_POST['city'] == ''){
        $_POST['city'] = '';
        array_push($errors, 'City field can not be empty');
    }
    if (($_POST['streetnumber'] == '') || !(is_numeric(($_POST['streetnumber'])))){
        $_POST['streetnumber'] = '';
        array_push($errors, 'Street number field can not be empty and has to be a number');
    }
    if (($_POST['zipcode'] == '')|| !(is_numeric(($_POST['zipcode'])))){
        $_POST['zipcode'] = '';
        array_push($errors, 'Zip code field can not be empty and has to be a number');
    }
    $_SESSION["street"] = $_POST['street'];
    $_SESSION["city"] = $_POST['city'];
    $_SESSION["streetnumber"] = $_POST['streetnumber'];
    $_SESSION["zipcode"] = $_POST['zipcode'];
    // This function will send a list of invalid fields back
    return $errors;
}

function handleForm($productsList): string
{
    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        return '<div class="alert alert-danger">' . implode(" </br> ", $invalidFields) .'</div>';
    }
    // TODO: form related tasks (step 1)

    $chosenProduct = $_POST['products'];
    $orderList = [];

    foreach($chosenProduct as $productNumber => $product) {
        $totalPrice +=$productsList[$productNumber]['price'];
        array_push($orderList, $productsList[$productNumber]['name']);
    }


    return ' <div class="alert alert-success"> 
            Your order is sumbited </br> Your address is: ' .$_POST['street'] . ' ' .$_POST['streetnumber'] . ' ' . ' ' .$_POST['city']
            .'</br>Your email is: ' .$_POST['email']
            .'</br> You have chosen: ' .implode(" , ", $orderList)
            .'</br> The total price is: &euro;' .number_format($totalPrice, 2)
            .'</div>';
}

// TODO: replace this if by an actual check
function changeTheProducts($defineFood){
    return $defineFood;
}
$confirmationMessage = "";
if (!empty($_POST)) {
    $confirmationMessage = handleForm(${$order});
}


require 'form-view.php';
//test
$arr = [];

function addValue(&$array){
    $array[] = 'string';
}

addValue($arr);

//var_dump($arr);
