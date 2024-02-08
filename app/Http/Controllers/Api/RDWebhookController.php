<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RDWebhookController extends Controller
{
    private int $maxItemsInCacheStory = 10;
    public function listenOportunities(Request $request)
    {
        $cache = cache('rd_webhook:oportunities') ?? [];
        $cache[] = $request->all();
        if (count($cache) > $this->maxItemsInCacheStory) {
            array_shift($cache);
        }
        cache(['rd_webhook:oportunities' => $cache], now()->addDays(8));
        return response()->json(['status' => 'ok']);
    }

    public function getOportunities()
    {
        $oportunities = cache('rd_webhook:oportunities') ?? [];
        $count = count($oportunities) ?? 0;
        $response = [
            'count' => $count,
            'oportunities' => $oportunities
        ];
        return response()->json($response);
    }
}
