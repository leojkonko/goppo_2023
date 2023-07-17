<?php

namespace Ellite\Differentials\Services;

use Ellite\Differentials\Models\Differential;

class DifferentialsService
{
    public function getDifferentials(
        int $quantity = 10,
    )
    {
        $differentials = Differential::where('active', 1)
            ->withTranslation()
            ->orderBy('order')
            ->paginate($quantity);
        
        return $differentials;
    }
}
