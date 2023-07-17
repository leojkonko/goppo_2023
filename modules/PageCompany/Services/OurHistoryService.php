<?php

namespace Ellite\PageCompany\Services;

use Ellite\PageCompany\Models\OurHistory;

class OurHistoryService
{
    public function getOurHistory(
        int $quantity = 25,
    )
    {
        $ourHistory = OurHistory::where('active', 1)
            ->withTranslation()
            ->orderBy('order')
            ->paginate($quantity);
        
        return $ourHistory;
    }
}
