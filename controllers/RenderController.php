<?php

class RenderController {

    public static function render($viewName, $data = []) {

        require_once 'views/'.$viewName.'.php';
    }
}