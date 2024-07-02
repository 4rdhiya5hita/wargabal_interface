<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class TrackLinkClick
{
    protected $filePath = 'link_clicks.json';

    public function handle(Request $request, Closure $next)
    {
        $link = $request->fullUrl();
        $this->incrementClickCount($link);

        return $next($request);
    }

    protected function incrementClickCount($link)
    {
        $data = $this->readClicks();
        
        if (isset($data[$link])) {
            $data[$link]++;
        } else {
            $data[$link] = 1;
        }

        $this->writeClicks($data);
    }

    protected function readClicks()
    {
        $path = storage_path($this->filePath);
        if (!File::exists($path)) {
            return [];
        }

        $json = File::get($path);
        return json_decode($json, true) ?? [];
    }

    protected function writeClicks($data)
    {
        $path = storage_path($this->filePath);
        if (!File::exists($path)) {
            File::put($path, json_encode([])); // Ensure the file is created
        }

        $json = json_encode($data, JSON_PRETTY_PRINT);
        File::put($path, $json);
    }

    public function clearClicks()
    {
        $path = storage_path($this->filePath);
        if (File::exists($path)) {
            File::put($path, json_encode([])); // Mengosongkan isi file
            return redirect()->route('link-clicks')->with('success', 'Link clicks have been cleared.');
        }

        return redirect()->route('link-clicks')->with('error', 'File not found.');
    }
}
