<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\GivingType;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class GivingsTypesChart extends BaseChart
{
    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $types = GivingType::active()->withCount('givings')->get();

        return Chartisan::build()
            ->labels($types->pluck('name')->toArray())
            ->dataset('Givings', $types->pluck('givings_count')->toArray());
    }
}
