<?php

require('../../initialize.php');

$game = new Game();
$result = $game->find_all();

echo '$result: <pre>';
print_r($result);
echo '</pre>';

$row = $result->fetch_assoc();

echo '$row: <pre>';
print_r($row);
echo '</pre>';

$result->free();

?>