<?php

/* diner/model/validation.php
    contains functions to validate data
    in the diner app
    This is part of the Model
*/

function validMeal($meal)
{
    // if meal is not empty
    // and is in the array of
    // valid meals, return true
    // otherwise, return false
    if (!empty($meal) && in_array($meal, getMeals())) {
        return true;
    }
    else {
        return false;
    }

    // in line check
    // return (!empty($meal) && in_array($meal, getMeals()));
}

function validFood($food)
{
    $food = trim($food);
    return (strlen($food) >= 2 && !ctype_digit($food));
//    if (!empty($food) && strlen($food)>3){
//        return true;
//    }
//    else {
//        return false;
//    }
}

function validCondiments($userCondiments)
{
    $validCondiments = getCondiments();

    foreach ($userCondiments as $userCondiment) {
        if (!in_array($userCondiment, $validCondiments)){
            return false;
        }
    }
    return true;
}