<?php

namespace SergeyOreshkin1\hangman\Controller;

use function SergeyOreshkin1\hangman\View\showGame;
use function SergeyOreshkin1\hangman\Model\startGameDB;
use function SergeyOreshkin1\hangman\Model\addGameStep;
use function SergeyOreshkin1\hangman\Model\updateResult;
use function SergeyOreshkin1\hangman\Model\listGames;
use function SergeyOreshkin1\hangman\Model\replayGame;

function mainMenu($key)
{
    if ($key[1] == "--new") {
        startGame();
    } elseif ($key[1] == "--list") {
        listGames();
    } elseif ($key[1] == "--replay") {
        if (isset($key[2])) {
            replayGame((int)$key[2]);
        } else {
            \cli\line("Нужно указать id игры");
        }
    } else {
        \cli\line("Неверный ключ");
    }
}


function startGame()
{
    $words = array("kotlin", "master", "chance", "winner");
    date_default_timezone_set("Europe/Moscow");
    $gameData = date("d") . "." . date("m") . "." . date("Y");
    $gameTime = date("H") . ":" . date("i") . ":" . date("s");

    $playerName = \cli\prompt("Введите ваше имя");
    if ($playerName  == "exit") {
            \cli\line("Произведен выход из игры");
            return;
    }
    
    $playWord = $words[array_rand($words)];

    $idGame = startGameDB($words, $gameData, $gameTime, $playerName, $playWord);

    $remainingLetters = substr($playWord, 1, -1);
    $maxAnswers = strlen($remainingLetters);
    $maxFaults = 6;
    $progress = "______";
    $progress[0] = $playWord[0];
    $progress[-1] = $playWord[-1];

    $faultCount = 0;
    $answersCount = 0;
    $attempts = 0;

    do {
        showGame($faultCount, $progress);
        $letter = mb_strtolower(\cli\prompt("Буква"));
        $tempCount = 0;

        if ($letter == "exit") {
            \cli\line("Произведен выход из игры");
            return;
        }

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
            $result = 0;
        } else {
            $result = 1;
        }

        $attempts++;
        addGameStep($idGame, $attempts, $letter, $result);
    } while ($faultCount < $maxFaults && $answersCount < $maxAnswers);

    if ($faultCount < $maxFaults) {
        $result = "ПОБЕДА";
    } else {
        $result = "ПОРАЖЕНИЕ";
    }

    showGame($faultCount, $progress);
    showResult($answersCount, $playWord);
    updateResult($idGame, $result);
}



function showResult($answersCount, $playWord)
{
    if ($answersCount == 4) {
        \cli\line("Победа!");
    } else {
        \cli\line("\nПроигрыш!");
    }
    \cli\line("\nЗагаданное слово: $playWord\n");
}
