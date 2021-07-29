<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';

    var_dump($_GET);
    echo '<h2>$_POST</h2>';
  //   echo('<pre>');
    var_dump($_POST);

    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
whatIsHappening();

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Fanta', 'price' => 2.5],
    ['name' => 'Coca Cola', 'price' => 2.5],
    ['name' => 'Black tea', 'price' => 3],
    ['name' => 'Coffee', 'price' => 3.5],
    ['name' => 'Iced Coffee', 'price' => 4],
    ['name' => 'Irish Coffee', 'price' => 6],

];

$totalValue = 0;

function validate(): array
{
    // This function will send a list of invalid fields back
    return [];
}

/**
 * @return string
 */
function handleForm(): string
{
    $products = [
        ['name' => 'Fanta', 'price' => 2.5],
        ['name' => 'Coca Cola', 'price' => 2.5],
        ['name' => 'Black tea', 'price' => 3],
        ['name' => 'Coffee', 'price' => 3.5],
        ['name' => 'Iced Coffee', 'price' => 4],
        ['name' => 'Irish Coffee', 'price' => 6],

    ];

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
    // TODO: form related tasks (step 1)
    $chosenProduct = $_POST[products];
    $orderList = [];
    $totalPrice = 0;

    foreach($chosenProduct as $i => $product) {
        $totalPrice +=$products[$i][price];

        array_push($orderList, $products[$i][name]);

    }


    return ' <div class="alert alert-success"> 
            Your orderd is sumbited </br> Your address is:' .$_POST[street] . ' ' .$_POST[streetnumber] . ' ' . ' ' .$_POST[city]
            .'</br>Your email is: ' .$_POST[email]
            .'</br> You have chosen: ' .implode(" , ", $orderList)
            .'</br> The total Price is: ' .$totalPrice .' euro'
        //.$products[0][name]
        .'</div>';
}

// TODO: replace this if by an actual check
$formSubmitted = (!empty($_POST));
$confirmationMessage = "";
if ($formSubmitted) {
    $confirmationMessage = handleForm();
}

require 'form-view.php';
