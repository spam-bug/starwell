<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public string $title;

    public function __construct(string $title = null)
    {
        if (empty($title)) {
            $this->title = Str::title($this->currentPage());
        }
    }

    private function currentPage(): string
    {
        $page = explode("/", request()->path());

        if (! isset($page[1])) {
            $page[] = 'dashboard';
        }

        return $page[1];
    }

    public function render(): View
    {
        return view('layouts.admin');
    }
}
