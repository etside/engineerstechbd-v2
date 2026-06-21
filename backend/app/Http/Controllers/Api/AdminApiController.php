<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Service, Product, Project, BlogPost, TeamMember, Testimonial, ClientLogo, ContactSubmission, SiteSetting};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminApiController extends Controller
{
    public function stats()
    {
        return response()->json([
            'services'     => Service::count(),
            'products'     => Product::count(),
            'projects'     => Project::count(),
            'blog_posts'   => BlogPost::count(),
            'team'         => TeamMember::count(),
            'testimonials' => Testimonial::count(),
            'logos'        => ClientLogo::count(),
            'submissions'  => ContactSubmission::where('is_read', false)->count(),
        ]);
    }

    // ─── Services ────────────────────────────────────────────────
    public function servicesIndex()    { return Service::orderBy('display_order')->get(); }
    public function servicesStore(Request $r)
    {
        $data = $r->validate(['title'=>'required','description'=>'nullable','icon'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        return Service::create($data);
    }
    public function servicesUpdate(Request $r, $id)
    {
        $s = Service::findOrFail($id);
        $s->update($r->validate(['title'=>'required','description'=>'nullable','icon'=>'nullable','display_order'=>'integer','is_active'=>'boolean']));
        return $s;
    }
    public function servicesDestroy($id) { Service::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Products ────────────────────────────────────────────────
    public function productsIndex()    { return Product::orderBy('display_order')->get(); }
    public function productsStore(Request $r)
    {
        $data = $r->validate(['name'=>'required','description'=>'nullable','icon'=>'nullable','external_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        return Product::create($data);
    }
    public function productsUpdate(Request $r, $id)
    {
        $p = Product::findOrFail($id);
        $p->update($r->validate(['name'=>'required','description'=>'nullable','icon'=>'nullable','external_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']));
        return $p;
    }
    public function productsDestroy($id) { Product::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Blog ─────────────────────────────────────────────────────
    public function blogIndex()    { return BlogPost::orderByDesc('created_at')->get(); }
    public function blogStore(Request $r)
    {
        $data = $r->validate(['title'=>'required','slug'=>'nullable','excerpt'=>'nullable','content'=>'nullable','category'=>'nullable','cover_image'=>'nullable','is_published'=>'boolean','published_at'=>'nullable']);
        if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']);
        if ($data['is_published'] ?? false) $data['published_at'] = $data['published_at'] ?? now();
        return BlogPost::create($data);
    }
    public function blogUpdate(Request $r, $id)
    {
        $p = BlogPost::findOrFail($id);
        $data = $r->validate(['title'=>'required','slug'=>'nullable','excerpt'=>'nullable','content'=>'nullable','category'=>'nullable','cover_image'=>'nullable','is_published'=>'boolean','published_at'=>'nullable']);
        if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']);
        if (($data['is_published'] ?? false) && !$p->published_at) $data['published_at'] = now();
        $p->update($data);
        return $p;
    }
    public function blogDestroy($id) { BlogPost::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Team ─────────────────────────────────────────────────────
    public function teamIndex()    { return TeamMember::orderBy('display_order')->get(); }
    public function teamStore(Request $r)
    {
        $data = $r->validate(['name'=>'required','designation'=>'nullable','bio'=>'nullable','photo_url'=>'nullable','linkedin_url'=>'nullable','whatsapp_number'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        return TeamMember::create($data);
    }
    public function teamUpdate(Request $r, $id)
    {
        $m = TeamMember::findOrFail($id);
        $m->update($r->validate(['name'=>'required','designation'=>'nullable','bio'=>'nullable','photo_url'=>'nullable','linkedin_url'=>'nullable','whatsapp_number'=>'nullable','display_order'=>'integer','is_active'=>'boolean']));
        return $m;
    }
    public function teamDestroy($id) { TeamMember::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Testimonials ─────────────────────────────────────────────
    public function testimonialsIndex()    { return Testimonial::orderBy('display_order')->get(); }
    public function testimonialsStore(Request $r)
    {
        $data = $r->validate(['name'=>'required','role'=>'nullable','company'=>'nullable','quote'=>'required','photo_url'=>'nullable','rating'=>'integer','display_order'=>'integer','is_active'=>'boolean']);
        return Testimonial::create($data);
    }
    public function testimonialsUpdate(Request $r, $id)
    {
        $t = Testimonial::findOrFail($id);
        $t->update($r->validate(['name'=>'required','role'=>'nullable','company'=>'nullable','quote'=>'required','photo_url'=>'nullable','rating'=>'integer','display_order'=>'integer','is_active'=>'boolean']));
        return $t;
    }
    public function testimonialsDestroy($id) { Testimonial::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Logos ────────────────────────────────────────────────────
    public function logosIndex()    { return ClientLogo::orderBy('display_order')->get(); }
    public function logosStore(Request $r)
    {
        $data = $r->validate(['name'=>'required','logo_url'=>'nullable','website_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        return ClientLogo::create($data);
    }
    public function logosUpdate(Request $r, $id)
    {
        $l = ClientLogo::findOrFail($id);
        $l->update($r->validate(['name'=>'required','logo_url'=>'nullable','website_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']));
        return $l;
    }
    public function logosDestroy($id) { ClientLogo::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Submissions ──────────────────────────────────────────────
    public function submissions()
    {
        return ContactSubmission::orderByDesc('created_at')->get();
    }
    public function submissionMarkRead($id)
    {
        $s = ContactSubmission::findOrFail($id);
        $s->update(['is_read' => true]);
        return $s;
    }

    // ─── Settings ─────────────────────────────────────────────────
    public function settingsIndex()
    {
        return SiteSetting::all()->pluck('value', 'key');
    }
    public function settingsUpdate(Request $r)
    {
        foreach ($r->all() as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return response()->json(['ok' => true]);
    }

    // ─── Projects ─────────────────────────────────────────────────
    public function projectsIndex()    { return Project::orderBy('display_order')->get(); }
    public function projectsStore(Request $r)
    {
        $data = $r->validate(['name'=>'required','description'=>'nullable','url'=>'nullable','logo_url'=>'nullable','features'=>'nullable','login_username'=>'nullable','login_password'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        return Project::create($data);
    }
    public function projectsUpdate(Request $r, $id)
    {
        $p = Project::findOrFail($id);
        $p->update($r->validate(['name'=>'required','description'=>'nullable','url'=>'nullable','logo_url'=>'nullable','features'=>'nullable','login_username'=>'nullable','login_password'=>'nullable','display_order'=>'integer','is_active'=>'boolean']));
        return $p;
    }
    public function projectsDestroy($id) { Project::findOrFail($id)->delete(); return response()->json(['ok'=>true]); }

    // ─── Upload ───────────────────────────────────────────────────
    public function upload(Request $r)
    {
        $r->validate(['file' => 'required|file|image|max:5120', 'folder' => 'nullable|string']);
        $folder = $r->input('folder', 'general');
        $path   = $r->file('file')->store($folder, 'public');
        $url    = rtrim(config('app.url'), '/') . '/storage/' . $path;
        return response()->json(['url' => $url]);
    }
}
