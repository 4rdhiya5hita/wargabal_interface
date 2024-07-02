<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LinkClickController extends Controller
{
    protected $filePath = 'link_clicks.json';

    public function readClicks()
    {
        $path = storage_path($this->filePath);
        if (!File::exists($path)) {
            return [];
        }

        $json = File::get($path);
        return json_decode($json, true) ?? [];
    }
}
