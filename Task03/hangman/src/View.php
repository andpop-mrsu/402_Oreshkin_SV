<?php

    namespace SergeyOreshkin1\hangman\View;

function showGame($faultCount, $progress)
{
    $graphic = array (
        " +---+\n     |\n     |\n     |\n    ===\n ",
        " +---+\n 0   |\n     |\n     |\n    ===\n ",
        " +---+\n 0   |\n |   |\n     |\n    ===\n ",
        " +---+\n 0   |\n/|   |\n     |\n    ===\n ",
        " +---+\n 0   |\n/|\  |\n     |\n    ===\n ",
        " +---+\n 0   |\n/|\  |\n/    |\n    ===\n ",
        " +---+\n 0   |\n/|\  |\n/ \  |\n    ===\n "
    );

    \cli\line($graphic[$faultCount]);
    \cli\line($progress);

    echo "\n";
}