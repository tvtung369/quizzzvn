<?php

namespace Phplite\View;

class View {
    /**
     * View constructor
     */
    private function __construct() {}

    /**
     * Render view fiel
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    public static function render($path, $data = []) {
        $path = 'C:\xampp\htdocs\quizzz\views' . $path. '.php';
        if (! file_exists($path)) {
            throw new \Exception("The view file {$path} is not exists");
        }
        return $path;
    }
}