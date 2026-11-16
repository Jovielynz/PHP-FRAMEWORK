<?php
/**
 * public/index.php - the single entry point (front controller).
 * Every request is rewritten to this file, which boots the framework.
 */
require __DIR__ . '/../app/Core/App.php';

App\Core\App::run();
