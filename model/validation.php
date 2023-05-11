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