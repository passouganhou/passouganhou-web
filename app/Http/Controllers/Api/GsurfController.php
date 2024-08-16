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
        $request = request();
        $this->validateRequest($request);
        $dateStart = $request->get('start_date');
        $dateEnd = $request->get('end_date');
        $response = $this->gsurfService->importTransactions($dateStart, $dateEnd);
        return response()->json($response);
    }

    public function getMerchants()
    {
        $response = $this->gsurfService->getMerchants();
        return response()->json($response);
    }

    public function validateRequest($request)
    {
        if (!$request->has('start_date')) {
            $request->merge(['start_date' => date('Y-m-d')]);
        }
        if (!$request->has('end_date')) {
            $request->merge(['end_date' => date('Y-m-d')]);
        }
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
        try {
            $request->validate($rules);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return true;
    }
}
