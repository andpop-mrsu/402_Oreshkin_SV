<?php

namespace SergeyOreshkin1\hangman\Controller;

use function SergeyOreshkin1\hangman\View\showGame;

function startGame()
{
    $words = array("kotlin", "master", "chance", "winner");
    $playWord = $words[array_rand($words)];
    $remainingLetters = substr($playWord, 1, -1);
    $maxAnswers = strlen($remainingLetters);
    $maxFaults = 6;

    $progress = "______";
    $progress[0] = $playWord[0];
    $progress[-1] = $playWord[-1];

    $faultCount = 0;
    $answersCount = 0;

    do {
        showGame($faultCount, $progress);
        $letter = mb_strtolower(\cli\prompt("Буква"));
		
        $tempCount = 0;

        for ($i = 0; $i < strlen($remainingLetters); $i++) {
            if ($remainingLetters[$i] == $letter) {
                $progress[$i + 1] = $letter;
                $remainingLetters[$i] = " ";
                $answersCount++;
                $tempCount++;
            }
        }

        if ($tempCount == 0) {
            $faultCount++;
        }
    } 
	while ($faultCount < $maxFaults && $answersCount < $maxAnswers);

        showGame($faultCount, $progress);
        showResult($answersCount, $playWord);
}

function showResult($answersCount, $playWord)
{
    if ($answersCount == 4) {
        echo("Победа!\n");
    } else {
        echo("Проигрыш!\n");
    }
    echo("\nЗагаданное слово: $playWord\n\n");
}