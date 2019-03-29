<?php

namespace App\Classes;

use App\MagicTrait;

class View
{
    use MagicTrait;

    /**
     * @param $template  string Путь к шаблону
     * @return false|string  шаблон
     */
    public function render($template)
    {
        ob_start();
        if(!empty($this->data)) {
            foreach ($this->data as $prop => $value) {
                $$prop = $value;
            }
        }
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @param $template string Путь к шаблону
     */
    public function display($template)
    {
        echo $this->render($template);
    }

}