<?php

namespace App\Http\Controllers;

use App\Uploads;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function imageUpload()
    {
        // getting all of the post data
        $file = ['file' => Input::file('file')];
        // setting up rules
        $rules = ['file' => 'required|mimes:jpeg,bmp,png']; //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return false;
        } else {
            // checking file is valid.
            if (Input::file('file')->isValid()) {
                $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/images/'; // upload path
                $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
                $fileName = md5(date('YmdHis')) . '.' . $extension; // renaming image
                Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                return ['filelink' => '/uploads/images/'.$fileName];
            } else {
                // sending back with error message.
                return false;
            }
        }
    }

    public function fileUpload()
    {
        // getting all of the post data
        $file = ['file' => Input::file('file')];
        // setting up rules
        $rules = ['file' => 'required']; //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return false;
        } else {
            // checking file is valid.
            if (Input::file('file')->isValid()) {
                $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/files/'; // upload path

                $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
                $fileName = md5(date('YmdHis')) . '.' . $extension; // renaming image
                Uploads::create([
                    'name' => Input::file('file')->getClientOriginalName(),
                    'original_name' => $fileName,
                    'mime_type' => Input::file('file')->getMimeType(),
                    'size' => Input::file('file')->getClientSize()
                ]);

                Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                return ['filelink' => '/uploads/files/'.$fileName];
            } else {
                // sending back with error message.
                return false;
            }
        }
    }

    public function imageManager()
    {
        $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/images/'; // upload path
        $files = File::allFiles($destinationPath);

        $result = [];
        foreach ($files as $file)
        {
            $fileName = str_replace($destinationPath, '/uploads/images/', (string)$file);
            $result[] = [
                'thumb' => $fileName,
                'image' => $fileName,
                'title' => 'Image'
            ];
        }
        return $result;
    }

    public function fileManager()
    {
        $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/files/'; // upload path
        $files = File::allFiles($destinationPath);

        $result = [];
        foreach ($files as $file)
        {
            $fileName = str_replace($destinationPath, '/uploads/files/', (string)$file);
            $result[] = [
                'link' => $fileName,
                'size' => filesize((string)$file),
                'title' => 'File',
                'name' => 'File',
            ];
        }
        return $result;
    }

    public function file($id)
    {
        $file = Uploads::findOrFail($id);
        return $file;
    }
}
