<?php

require('../../initialize.php');

echo json_encode(Game::find_all());

?>