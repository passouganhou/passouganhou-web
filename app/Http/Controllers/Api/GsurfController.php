<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\GsurfService;

class GsurfController extends Controller
{

    public function __construct(GsurfService $gsurfService)
    {
        $this->gsurfService = $gsurfService;
    }
    public function importar()
    {
        $diaDeHojeStart = date('Y-m-d');
        $diaDeHojeEnd = date('Y-m-d');
        $dateStart = '2024-05-16';
        $dateEnd = '2024-05-26';
        $response = $this->gsurfService->importTransactions($dateStart, $dateEnd);
        return response()->json($response);
    }
}
