<?php

namespace App\Http\Controllers;

use App\Article;
use App\Business;
use App\Subscription;
use App\Job;
use App\JobApplicant;
use App\Slider;
use App\Sponsor;
use App\Video;
use App\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{   
    public function __construct(Request $request)
    {   
        $this->request = $request;
    }
    
    public function home() {
        $guide = Guide::first();

        return view('eventer-landing.index', compact('guide'));
    }
    
    public function download($file)
    {
        $url=public_path('/uploads/file/1606106212.pdf');

        return response()->download($url);
    }
    
    public function displayImage($filename)
    {
        $path = storage_public('images/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
