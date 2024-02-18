<?php
spl_autoload_register(function ($classe) {
    echo $classe;
    require '../src/classes/' . $classe . '.php';
});
