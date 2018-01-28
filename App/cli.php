<?php
define('BASEPATH', realpath(__DIR__ . '/../') . '/');
define('APPPATH', BASEPATH . 'App/');

// Register autoloader
require_once BASEPATH . 'vendor/autoload.php';

// Load dotenv
(new Dotenv\Dotenv(APPPATH))->load();

use App\Repositories\UserRepository;

// Read command line args
$args = getopt('', ['multi']);

$userRepository = new UserRepository;

do {
    fwrite(STDOUT, 'Enter username: ');
    $input = trim(fgets(STDIN));
    if (isset($args['multi']) && $input === '\quit') {
        exit;
    }
    $user = $userRepository->findByUsername($input);
    if ($user) {
        fwrite(STDOUT, "\033[32mHi, " . ucwords(strtolower($user->fullname)) . "!\033[0m\n");
        if (!isset($args['multi'])) {
            exit;
        }
    } else {
        fwrite(STDOUT, "\033[31mUser not found. Please try again.\033[0m\n");
    }
} while(true);
