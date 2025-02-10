<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;

// Substitua pelo caminho correto do seu arquivo de chave privada
$serviceAccount = __DIR__ . '\loja-virtual-67780-firebase-adminsdk-fbsvc-299bf396fb.json';

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();

// Agora você pode usar $database para interagir com o Firebase