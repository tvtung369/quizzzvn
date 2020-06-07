<?php

namespace Phplite\View;

use Phplite\File\File;
use Jenssegers\Blade\Blade;

class View {
    /**
     * View constructor
     */
    private function __construct() {}

    /**
     * Render view file
     *
     * @param sting $path
     * @param array $data
     * @return string
     */
    public static function render($path, $data=[]) {
        return static::bladeRender($path, $data);
    }

    /**
     * Render the view files using blade engine
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    private static function bladeRender($path, $data=[]) {
        $blade = new Blade(File::path('views'), File::path('storage/cache'));

        return $blade->make($path, $data)->render();
    }
    
    /**
     * Render view fiel
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    private static function viewRender($path, $data = []) {
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