<?php

/* diner/model/data-layer.php
    returns data for the diner app
*/
// get the meals for the order1 form
function getMeals()
{
    $meals = array("breakfast", "lunch", "dinner");
    return $meals;
}

// get the meals for the order2 form
function getCondiments()
{
    $condiments = array("ketchup", "mustard", "mayo", "sriracha");
    return $condiments;
}