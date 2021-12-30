<?php

namespace App\Http\Controllers;

use App\Models\Giver;
use App\Models\Giving;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard.index', $this->getAnalyticsData());
    }

    protected function getAnalyticsData(): array
    {
        return [
            'totalGivers' => Giver::all()->count(),
            'givingsAmount' => Giving::approved()->thisMonth()->sum('amount'),
            'successfulGivings' => Giving::approved()->thisMonth()->count(),
            'failedGivings' => Giving::failed()->thisMonth()->count(),
        ];
    }
}
