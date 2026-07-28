<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\EmailForm;
use App\Models\Form;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalServices = Service::count();
        $totalForms = Form::count();
        $totalEmailForms = EmailForm::count();

        $recentForms = Form::latest()->take(5)->get();
        $recentEmailForms = EmailForm::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalClients', 'totalServices', 'totalForms', 'totalEmailForms', 'recentForms', 'recentEmailForms'));
    }
}
