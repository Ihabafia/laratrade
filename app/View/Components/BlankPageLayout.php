<?php

namespace App\View\Components;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\View\Component;

class BlankPageLayout extends Component
{
    public string $title;
    public string|null $pageTitle;

    public function __construct($title, $pageTitle = null)
    {
        $this->title = $title;
        if(! $pageTitle) {
            $this->pageTitle = $title;
        } else {
            $this->pageTitle = $pageTitle;
        }
    }

    public function render()
    {
        return view('layouts.blank-page');
    }
}
