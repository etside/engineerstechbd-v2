<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() { return view('admin.testimonials.index', ['testimonials' => Testimonial::orderBy('display_order')->get()]); }
    public function create() { return view('admin.testimonials.form', ['testimonial' => new Testimonial]); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|max:255','role'=>'nullable|max:255','company'=>'nullable|max:255','quote'=>'required','rating'=>'integer|min:1|max:5','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('photo')) { $data['photo_url'] = '/storage/' . $request->file('photo')->store('testimonials','public'); }
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success','Added.');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.form', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate(['name'=>'required|max:255','role'=>'nullable|max:255','company'=>'nullable|max:255','quote'=>'required','rating'=>'integer|min:1|max:5','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('photo')) { $data['photo_url'] = '/storage/' . $request->file('photo')->store('testimonials','public'); }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success','Updated.');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return redirect()->route('admin.testimonials.index')->with('success','Deleted.'); }
}
