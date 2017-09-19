<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

class GetAttachController extends Controller
{
    public function getAttach(){
        //クエリからIDを受け取り、SFで確認する
        $sfid = Input::get('id');

        if (empty($sfid)) {
            abort(404, 'パラメータがありません');
        }

        Forrest::authenticate();
        $result = Forrest::custom('/sample/attach/get', [
            'method' => 'get',
            'parameters' => ['id' => $sfid]
        ]);

        return view('getfile', compact('result'));
    }

    public function download(){
        //クエリからIDを受け取り、SFで確認する
        $sfid = Input::get('id');

        if (empty($sfid)) {
            abort(404, 'パラメータがありません');
        }

        Forrest::authenticate();
        $result = Forrest::custom('/sample/attach/get', [
            'method' => 'post',
            'parameters' => ['id' => $sfid]
        ]);

        $fileData = base64_decode($result['file_body']);
        file_put_contents('/tmp/' . $result['file_name'], $fileData);

        //ダウンロード
        $fpath = '/tmp/'.$result['file_name'];
        $fname = $result['file_name'];

        //IE空DL対策
        $data = file_get_contents($fpath) or die('ERROR:cannot get');

        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type:application/octet-stream');
        header('Content-Disposition: attachment; filename="'. rawurlencode($fname) .'"');
        header('Content-Length: '. strlen($data));// IE空DL対策。

        ob_end_clean();
        readfile($fpath);

        return '';
    }
}
