<?php

/* diner/model/data-layer.php
    returns data for the diner app
*/
// get the meals for the order form
function getMeals()
{
    $meals = array("breakfast", "lunch", "dinner");
    return $meals;
}

function getCondiments()
{
    $condiments = array("ketchup", "mustard", "mayo", "sriracha");
    return $condiments;
}