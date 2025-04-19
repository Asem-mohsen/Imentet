<?php

namespace App\Http\Controllers\web\Pyramids;

use App\Http\Controllers\web\BaseSectionController;

class PyramidController extends BaseSectionController
{
    protected function initializeSection()
    {
        $this->sectionType = 'pyramids';
        $this->layout = 'website.layouts.pyramids';
        $this->viewPath = 'website.pyramids';
    }
} 