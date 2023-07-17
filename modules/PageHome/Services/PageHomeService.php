<?php

namespace Ellite\PageHome\Services;

use Ellite\PageHome\Models\PageHome;

class PageHomeService
{
    private $page;
    
    public function __construct()
    {
        $this->page = PageHome::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }
}
