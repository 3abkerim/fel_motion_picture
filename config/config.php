<?php
spl_autoload_register(function ($classe) {
    echo $classe;
    require '../classes/' . $classe . '.php';
});
