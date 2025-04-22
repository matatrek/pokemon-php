<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->safeLoad();

require __DIR__ . '/./helpers.php';
require __DIR__ . '/./database.php';

Models\PokemonModel::setConnection($connection);