<?php

namespace Illuminates\Views;

class View
{
    public static function make($view, null|array $data)
    {
        $view = str_replace('.', '/', $view);
        $path = config('view.path');
        extract($data);
        
        // This is what extract made
        // if (!empty($data)) {
        //     foreach ($data as $key => $value) {
        //         ${$key} = $value;
        //     }
        // }
        include $path.'/'.$view.'.tpl.php';
    }
}