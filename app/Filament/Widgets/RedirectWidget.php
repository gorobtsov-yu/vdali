<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RedirectWidget extends Widget
{
    protected string $view = 'filament.widgets.redirect-widget';

    public function goHome()
    {
        return redirect('/');
    }
}
