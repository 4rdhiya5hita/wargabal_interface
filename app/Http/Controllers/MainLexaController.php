<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainLexaController extends Controller
{
    public function dashboard()
    {
        return view('main.index');
    }

    public function calendar()
    {
        return view('main.calendar');
    }

    public function emailInbox()
    {
        return view('main.email-inbox');
    }

    public function emailRead()
    {
        return view('main.email-read');
    }

    public function emailCompose()
    {
        return view('main.email-compose');
    }

    public function chat()
    {
        return view('main.chat');
    }

    public function kanbanboard()
    {
        return view('main.kanbanboard');
    }

}
