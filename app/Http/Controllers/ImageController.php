<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function images(Request $request, $page)
    {
        $rows = [
            ['1.jpg', '2.jpg'],
            ['3.jpg', '4.jpg', '5.jpg'],
            ['6.jpg'],
            ['7.jpg', '8.jpg'],
            ['9.jpg', '10.jpg', '11.jpg'],
            ['12.jpg'],
            ['13.jpg', '14.jpg'],
            ['15.jpg', '16.jpg', '17.jpg'],
            ['18.jpg'],
            ['19.jpg', '20.jpg'],
            ['21.jpg'],
        ];
        $pageImage = $rows[$page - 1] ?? [];
        $responseImages = [];
        foreach ($pageImage as $image) {
            $path = storage_path('app/public/images/' . $image);
            if (!file_exists($path)) {
                break;
            }
            $image = Image::read($path);
            $responseImages[] =  $image->toWebp()->toDataUri();
        }
       return response()->json($responseImages);




        #return '<img src="' . $image->toWebp()->toDataUri() . '">';

        $image->scaleDown(width: 2500, height: 9000);
        return $image->toWebp()->toDataUri();
        return '<img src="' . $image->toWebp()->toDataUri() . '">';
        dd();
//        , function ($constraint) {
//            $constraint->aspectRatio();
//            $constraint->upsize();
//        });

        return $image->response();
    }
}
