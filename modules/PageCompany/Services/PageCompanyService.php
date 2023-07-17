<?php

namespace Ellite\PageCompany\Services;

use Ellite\PageCompany\Models\PageCompany;

class PageCompanyService
{
    private $page;
    
    public function __construct()
    {
        $this->page = PageCompany::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }
}
