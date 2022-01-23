<?php

    namespace SergeyOreshkin1\hangman\Controller;
	
	use function SergeyOreshkin1\hangman\View\showGame;
	
	function startGame() 
	{
        echo "The game has begun".PHP_EOL;
		
        showGame();
    }

?>	