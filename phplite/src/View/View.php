<?php

namespace Phplite\View;

use Phplite\File\File;

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
        $path = 'views' . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.php';

        if (! File::exists($path)) {
            throw new \Exception("The view file {$path} is not exists");
        }

        ob_start();
        // ['name' => 'Tung', 'age' => 20]
        extract($data);
        include File::path($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}