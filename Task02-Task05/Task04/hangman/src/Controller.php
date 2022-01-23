<?php

namespace SergeyOreshkin1\hangman\Controller;

use function SergeyOreshkin1\hangman\Model\addAttemptsInfo;
use function SergeyOreshkin1\hangman\View\showGame;
use function SergeyOreshkin1\hangman\Model\openDB;
use function SergeyOreshkin1\hangman\Model\createRecord;
use function SergeyOreshkin1\hangman\Model\gameList;
use function SergeyOreshkin1\hangman\Model\gameReplay;
use function SergeyOreshkin1\hangman\Model\updateDB;

function menu($key)
{
    if ($key == "--new" || $key == "-n") {
        startGame();
    } elseif ($key == "--list" || $key == "-l") {
        gameList();
    } elseif ($key == "--help" || $key == "-h") {
        \cli\line("
        --new or -n: Новая игра\n
        --list or -l: Прошлые игры\n
        --help or -h: Помощь\n
        --replay [id] or -r [id]: Повтор игры");
    } else {
        \cli\line("Неверный ключ");
    }
}

function menuReplay($key1, $key2)
{
    if ($key1 == "--replay" || $key1 == "-r") {
        if (is_numeric($key2)) {
            gameReplay($key2);
        } else {
            \cli\line("Неверный ключ");
        }
    } else {
        \cli\line("Неверный ключ");
    }
}

function showResult($word, $result)
{
    echo("$result");

    echo("Загаданное слово: $word\n");
}

function startGame()
{
    $root = openDB();
    date_default_timezone_set("Europe/Moscow");
    $gameDate = date("d") . "." . date("m") . "." . date("Y");
    $gameTime = date("H") . ":" . date("i") . ":" . date("s");
    $nickname = getenv("username");

    $wordBase = array("kotlin", "master", "chance", "winner", "string");
    $randomChoice = random_int(0, count($wordBase) - 1);
    $word = $wordBase[$randomChoice];
    $lengthWord = strlen($word);
    $remaining = $word;

    $id = createRecord($gameDate, $gameTime, $nickname, $word);

    $entryField = "";
    for ($i = 0; $i < $lengthWord; $i++) {
        $entryField .= "_";
    }

    $fails = 0;
    $rightAnswers = 0;
    $progress = 0;

    while ($fails != 6 && $rightAnswers != $lengthWord) {
        showGame($fails, $entryField);
        $letter = mb_strtolower(readline("Буква: "));
        $attempt = 0;

        for ($i = 0; $i < strlen($remaining); $i++) {
            if ($remaining[$i] == $letter) {
                $entryField[$i] = $letter;
                $remaining[$i] = " ";
                $rightAnswers++;
                $attempt++;
            }
        }

        if ($attempt == 0) {
            $fails++;
            $result = 0;
        } else {
            $result = 1;
        }
        $progress++;

        addAttemptsInfo($id, $progress, $letter, $result);
    }

    $result = "";

    if ($rightAnswers == $lengthWord) {
        $result = "Победа!\n";
    } else {
        $result = "Проигрыш!\n";
    }

    showGame($fails, $entryField);
    showResult($word, $result);
    updateDB($id, $result);
}
