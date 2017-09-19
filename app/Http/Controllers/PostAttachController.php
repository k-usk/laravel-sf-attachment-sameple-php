<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

class PostAttachController extends Controller
{
    public function input(Request $request)
    {
        return view('postfile');
    }

    public function submit(Request $request)
    {
        $data = $request->all();

        $file_name = null;
        $file_encord = null;

        $files = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('temp_file'.$i)) {
                if ($request->file('temp_file' . $i)->isValid()) {
                    $file = $request->file('temp_file'. $i);
                    $file_name = $file->getClientOriginalName();
                    $file_type = $file->getMimeType();
                    $file = file_get_contents($file->getPathname());
                    $file_encord = base64_encode($file);

                    $files[] = [
                        'file_name' => $file_name,
                        'file_body' => $file_encord,
                        'file_type' => $file_type
                    ];
                }
            }
        }

        $json_body = [
            'title' => $data['title'],
            'message' => $data['message'],
            'files' => $files
        ];

        Forrest::authenticate();
        $result = Forrest::custom('/sample/attach/post', [
            'method' => 'POST',
            'body' => $json_body
        ]);

        return 'completed';
    }
}
