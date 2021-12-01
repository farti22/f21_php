<?php
spl_autoload_register(function ($class) {
    include_once 'models/' . strtolower($class) . '.php';
});
