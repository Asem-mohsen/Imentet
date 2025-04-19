<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

abstract class BaseSectionController extends Controller
{
    protected $sectionType;
    protected $layout;
    protected $viewPath;

    public function __construct()
    {
        $this->initializeSection();
    }

    abstract protected function initializeSection();

    public function index()
    {
        return view($this->viewPath . '.index', [
            'sectionType' => $this->sectionType,
            'layout' => $this->layout
        ]);
    }

    public function show($id)
    {
        return view($this->viewPath . '.show', [
            'sectionType' => $this->sectionType,
            'layout' => $this->layout,
            'id' => $id
        ]);
    }
} 