<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', ['team' => TeamMember::active()->get()]);
    }
}
