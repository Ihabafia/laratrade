<?php

namespace App\Mail;

use App\Models\Communication;
use App\Services\NotificationsVariables;
use App\Services\TemplateParser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public Communication $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Communication $template)
    {
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vars = [];
        if($this->template->method) {
            $vars = $this->buildVars();
        }

        $parser = (new TemplateParser($this->template, null, $vars));
        $message = $parser->parse();

        return $this->view('mail.general-template', [
                'body' => $message->body,
            ]);
    }

    private function buildVars(): array
    {
        $method = $this->template->method;
        $class = new NotificationsVariables();
        $variables = $class->{$method}();

        if(!$variables) {
            return [];
        }

        foreach ($variables['email'] as $variable => $attributes) {
            $vars[$variable] = $attributes['dummy'];
        }

        return $vars;
    }
}
