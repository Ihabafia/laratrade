<?php

namespace App\Services;

class TemplateParser
{
    public $message;
    public $model;
    public array $vars;

    /**
     * TemplateParser constructor.
     *
     * @param $message
     * @param $model
     * @param array $vars
     */
    public function __construct($message, $model, $vars = [])
    {
        $this->message = $message;
        $this->model = $model;
        $this->vars = $vars;
    }

    public function parse()
    {
        preg_match_all('/[^{]+(?=})/', $this->message->subject, $matches);

        if (count($matches[0]) > 0) {
            $this->replaceVars($matches[0], 'subject');
        }

        if (count($this->vars) > 0) {
            preg_match_all('/[^{@]+(?=@})/', $this->message->body, $matches);
            if (count($matches[0]) > 0) {
                $this->replaceExtraVars($matches[0], 'body');
            }
        }

        preg_match_all('/[^{_]+(?=_})/', $this->message->body, $matches);

        if (count($matches[0]) > 0) {
            foreach ($matches[0] as $match) {
                $button = $this->generateButton($match);
                $this->message->body = str_replace('{_'.$match.'_}', $button, $this->message->body);
            }
        }

        preg_match_all('/[^{]+(?=})/', $this->message->body, $matches);

        if (count($matches[0]) > 0) {
            $this->replaceVars($matches[0], 'body');
        }

        return $this->message;
    }

    private function replaceVars($vars, $type)
    {
        foreach ($vars as $var) {
            if ('phone' == $var) {
                $this->model->$var = formatPhone($this->model->$var);
            }
            if ('amount' == $var) {
                $this->model->$var = formatCurrency($this->model->$var);
            }
            $this->message->$type = isset($this->model->$var) ? str_replace('{'.$var.'}', $this->model->$var, $this->message->$type) : $this->message->$type;
            if(isset($this->vars[$var])) {
                $this->message->$type = str_replace('{'.$var.'}', $this->vars[$var], $this->message->$type);
            }
        }
    }

    private function replaceExtraVars($vars, string $string)
    {
        foreach ($vars as $var) {
            $this->message->$string = str_replace('{@'.$var.'@}', $this->vars[$var], $this->message->$string);
        }
    }

    private function generateButton($vars)
    {
        $properties = explode(',', $vars);
        $url = $properties[0];
        $color = $this->getColor($properties[1]);
        $label = $properties[2];

        $html = "<div style = 'display: block; text-align: center;'>
            <a href='$url' style='display: inline-block; padding: 11px 30px; margin: 15px 0 10px; font-size: 15px; color: #fff; background: {$color}; border-radius: 60px; text-decoration:none;'>
                {$label}
            </a>
        </div>";

        return $html;
    }

    private function getColor(string $color)
    {
        switch ($color) {
            case 'success':
                $color = '#28a745';
                break;
            case 'danger':
            case 'red':
                $color = '#dc3545';
                break;
            case 'warning':
                $color = '#fd7e14';
                break;
            case 'info':
                $color = '#007bff';
                break;

            default:
                $color = '#214287';
                break;
        }

        return $color;
    }
}

