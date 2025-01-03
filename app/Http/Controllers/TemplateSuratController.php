<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    public function SuratPernyataan(){
        
        return view('administrator.template.surat-pernyataan');
    }
}
