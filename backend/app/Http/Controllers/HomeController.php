<?php
namespace App\Http\Controllers;
use App\Models\{Service, ClientLogo, Testimonial, TeamMember};

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'services'     => Service::active()->take(4)->get(),
            'logos'        => ClientLogo::active()->get(),
            'testimonials' => Testimonial::active()->get(),
            'team'         => TeamMember::active()->get(),
        ]);
    }
}
