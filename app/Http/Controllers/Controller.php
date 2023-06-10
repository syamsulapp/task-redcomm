<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function builder($data, $message = 'Successfully Data', $statusCode = 200)
    {
        switch ($statusCode) {
            case 200:
                $result = [
                    'message' => $message,
                    'data' => $data
                ];
                break;
            default:
                $result = [
                    'message' => $message,
                    'data' => $data
                ];
                break;
        }
        return response()->json($result, $statusCode);
    }
    public function customError($validator)
    {
        $req = collect($validator);
        $res = collect([]);

        $req->keys();

        foreach ($req as $key => $value) {
            $custom = [
                'field' => $key,
                'message' => $value[0]
            ];
            $res->push($custom);
        }
        return response()->json(['message' => 'data tidak lengkap', 'errors' => $res], 422);
    }
}
