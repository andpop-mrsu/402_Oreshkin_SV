<?php

	$autoloadPathForGithub = __DIR__.'/../vendor/autoload.php';
    $autoloadPathForPackagist = __DIR__.'/../../../autoload.php';

    if (file_exists($autoloadPathForGithub)) {
        require_once($autoloadPathForGithub);
    } else {
        require_once($autoloadPathForPackagist);
    }

    use function SergeyOreshkin1\hangman\Controller\mainMenu;

    if(isset($argv[1]))
   		mainMenu($argv);
   	else
   		\cli\line("Ключ не введен");
