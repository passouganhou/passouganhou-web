<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Settings\FaqPageSettings;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    // public function __construct(FaqPageSettings $settings)
    // {
    //     dd($settings->maquininhas);
    // }
    public function index(FaqPageSettings $settings)
    {
        $faqs = Faq::all();

        return view('pages.faq', ['faqs' => $faqs, 'maquininhas' => $settings->maquininhas]);
    }
}
