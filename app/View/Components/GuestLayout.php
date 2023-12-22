<?php

namespace App\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class GuestLayout extends Component
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
        $page = explode("/", request()->path())[0];

        if (empty($page[0])) {
            $page = 'home';
        }

        return $page;
    }

    public function render(): View
    {
        return view('layouts.guest');
    }
}
