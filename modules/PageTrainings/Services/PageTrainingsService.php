<?php

namespace Ellite\PageTrainings\Services;

use Ellite\PageTrainings\Models\PageTraining;

class PageTrainingsService
{
    private $page;
    
    public function __construct()
    {
        $this->page = PageTraining::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }
}
