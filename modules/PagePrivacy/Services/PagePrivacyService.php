<?php

namespace Ellite\PagePrivacy\Services;

use Ellite\PagePrivacy\Models\PagePrivacy;

class PagePrivacyService
{
    private $page;
    
    public function __construct()
    {
        $this->page = PagePrivacy::withTranslation()->firstOrCreate();
    }

    public function getPage()
    {
        return $this->page;
    }
}
