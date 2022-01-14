<?php


namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Http\Request;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;

class UploadController extends Controller
{

    /**
     * Get images paths
     * @param $id
     * @param $conversion
     * @param null $filename
     * @return mixed
     */
    public function storage($id, $conversion, $filename = null)
    {
        $array = explode('.', $conversion . $filename);
        $extension = strtolower(end($array));
        if (isset($filename)) {
            return response()->file(storage_path('app/public/' . $id . '/' . $conversion . '/' . $filename));
        } else {
            $filename = $conversion;
            return response()->file(storage_path('app/public/' . $id . '/' . $filename));
        }

    }



}
