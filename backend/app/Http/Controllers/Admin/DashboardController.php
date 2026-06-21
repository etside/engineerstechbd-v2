<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Service, Product, Project, BlogPost, TeamMember, Testimonial, ClientLogo, ContactSubmission};

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'services'     => Service::count(),
                'products'     => Product::count(),
                'projects'     => Project::count(),
                'blog_posts'   => BlogPost::count(),
                'team'         => TeamMember::count(),
                'testimonials' => Testimonial::count(),
                'logos'        => ClientLogo::count(),
                'submissions'  => ContactSubmission::where('is_read', false)->count(),
            ]
        ]);
    }
}
