<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtrasLexaController extends Controller
{
    public function layoutsLightSidebar()
    {
        return view('extras.layouts-light-sidebar');
    }

    public function layoutsCompactSidebar()
    {
        return view('extras.layouts-compact-sidebar');
    }

    public function layoutsIconSidebar()
    {
        return view('extras.layouts-icon-sidebar');
    }
    
    public function layoutsBoxed()
    {
        return view('extras.layouts-boxed');
    }

    public function layoutsPreloader()
    {
        return view('extras.layouts-preloader');
    }

    public function layoutsColoredSidebar()
    {
        return view('extras.layouts-colored-sidebar');
    }

    public function layoutsHorizontal()
    {
        return view('extras.layouts-horizontal');
    }

    public function layoutsHoriTopbarDark()
    {
        return view('extras.layouts-hori-topbar-dark');
    }

    public function layoutsHoriPreloader()
    {
        return view('extras.layouts-hori-preloader');
    }

    public function layoutsHoriBoxedWidth()
    {
        return view('extras.layouts-hori-boxed-width');
    }

    public function pagesLogin()
    {
        return view('extras.pages-login');
    }

    public function pagesRegister()
    {
        return view('extras.pages-register');
    }

    public function pagesRecoverpw()
    {
        return view('extras.pages-recoverpw');
    }

    public function pagesLockScreen()
    {
        return view('extras.pages-lock-screen');
    }

    public function pagesTimeline()
    {
        return view('extras.pages-timeline');
    }

    public function pagesInvoice()
    {
        return view('extras.pages-invoice');
    }

    public function pagesDirectory()
    {
        return view('extras.pages-directory');
    }

    public function pagesBlank()
    {
        return view('extras.pages-blank');
    }

    public function pages404()
    {
        return view('extras.pages-404');
    }

    public function pages500()
    {
        return view('extras.pages-500');
    }

}
