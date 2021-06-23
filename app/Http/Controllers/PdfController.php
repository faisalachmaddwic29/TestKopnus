<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filepath = storage_path('cv') . "/" . $request->filename;
        if (!File::exists($filepath)) abort(404);

        $file = File::get($filepath);
        $type = File::mimeType($filepath);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);
        ob_end_clean();
        return $response;
    }
}
