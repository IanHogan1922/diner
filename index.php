<?php

/*
 * Ian Schroeder
 * 05/11/2023
 * 328/diner/index.php
 * Controller for diner project
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');

//var_dump(getMeals());
//var_dump(getCondiments());

////test validation functions
//if (validMeal('breakfast')){
//    print ('valid');
//}
//else{
//    print('not valid');
//}

// Create an F3 (Fat-Free Framework) object
$f3 = Base::instance();
// Base $f3 = new Base();

// Define a default route
$f3->route('GET /', function() {

    //echo '<h1>Welcome to My Diner!</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/bfast.html');
});

// Define a breakfast route
$f3->route('GET /happy-hour', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/happyHour.html');
});

// Create a route "/order1" -> orderForm1.html
$f3->route('GET|POST /order1', function($f3) {

    $food = "";
    $meal = "";

    // If the form has been posted
    // "Auto-global" arrays:  $_SERVER, $_GET, $_POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data
        // ["food"]=>"ramen" ["meal"]=>"lunch"
        //var_dump($_POST);
        if (isset($_POST['food'])){
            $food = $_POST['food'];
        }

        if (isset ($_POST['meal'])){
            $meal = $_POST['meal'];
        }

        //echo ("Food: $food, Meal: $meal");

        // Validate the data
        if (validMeal($meal)) {
            $f3->set('SESSION.meal', $meal);
        }
        else {
            $f3->set('errors["meal"]','Invalid Meal Selected');
        }

        // Store the data in the session array
        $f3->set('SESSION.food', $food);

        //$_SESSION['food'] = $food;

        // Redirect to order2 route
        // if there are no errors
        if (empty($f3->get('errors'))){
            $f3->reroute('order2');
        }

    }

    //get the data from the model and add it to the hive
    $f3->set('meals', getMeals());

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

// Create a route "/order2" -> orderForm2.html
$f3->route('GET|POST /order2', function($f3) {

    //echo '<h1>Breakfast Menu</h1>';

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get the data
        //var_dump($_POST);
        //["conds"]=> array(2) { [0]=> string(7) "mustard" [1]=> string(4) "mayo" }
        $conds = implode(", ", $_POST['conds']);
        //echo $conds;

        //Validate the data
        if (validCondiments($conds)) {
            $f3->set('SESSION.conds', $conds);
        }
        else {
            $f3->set('errors["conds"]','Those are not what was displayed');
        }

        //Store the data in the session array
        $f3->set('SESSION.condiments', $conds);

        //Redirect to the summary route
        $f3->reroute('summary');
    }

    // get the data from the model and add it to the hive
    $f3->set('condiments', getCondiments());

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

// Create a route "/summary" -> summary.html
$f3->route('GET /summary', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

// Run Fat-Free
$f3->run();