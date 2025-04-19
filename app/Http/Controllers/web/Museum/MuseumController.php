<?php

namespace App\Http\Controllers\web\Museum;

use App\Http\Controllers\web\BaseSectionController;

class MuseumController extends BaseSectionController
{
    protected function initializeSection()
    {
        $this->sectionType = 'gem';
        $this->layout = 'website.layouts.gem';
        $this->viewPath = 'website.gem';
    }
} 