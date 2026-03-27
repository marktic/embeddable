<?php

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

// Register PSR-4 autoloader for src/ and tests/
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Marktic\\Embeddable\\Tests\\Fixtures\\' => TEST_FIXTURE_PATH . '/',
        'Marktic\\Embeddable\\Tests\\' => TEST_BASE_PATH . '/src/',
        'Marktic\\Embeddable\\' => PROJECT_BASE_PATH . '/src/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (str_starts_with($class, $prefix)) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
            if (file_exists($file)) {
                require $file;
            }
            return;
        }
    }
});

