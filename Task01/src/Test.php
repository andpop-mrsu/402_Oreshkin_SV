<?php

namespace App\Test;

use App\Vector;

function runTest()
{
    $v1 = new Vector(2, 2.3, 7);
    echo "v1 = " . $v1 . "\n"; // (2; 2.3; 7)
    
    $v2 = new Vector(1, 2.7, -3);
    echo "v2 = " . $v2 . "\n\n"; // (1; 2.7; -3)

    $vectorAddition = $v1->add($v2);
    $vectorDifference = $v1->sub($v2);
    $vectorNumberProduct = $v1->product(2);
    $scalarProduct = $v1->scalarProduct($v2);
    $vectorProduct = $v1->vectorProduct($v2); 

    echo "Тесты операций над векторами\n\n";
    echo "Сумма векторов\n";
    echo $vectorAddition; // (3; 5; 4)
    echo "\nРазность векторов\n";
    echo $vectorDifference; // (1; -0.4; 10)
    echo "\nУмножение вектора на число\n";
    echo $vectorNumberProduct; // (4; 4.6; 14)
    echo "\nСкалярное произведение\n";
    echo $scalarProduct; // -12.79
    echo "\nВекторное произведение\n";
    echo $vectorProduct; // (25.8; -13; -3.1)
}
