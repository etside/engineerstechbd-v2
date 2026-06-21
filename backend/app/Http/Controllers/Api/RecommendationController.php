<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function services(Request $request)
    {
        $request->validate([
            'business_type' => 'required|string|max:100',
            'budget_range'  => 'nullable|string|max:50',
            'goals'         => 'nullable|string|max:500',
        ]);

        // Keyword → service category map
        $map = [
            'ecommerce'  => ['Web App', 'Mobile App', 'SaaS'],
            'retail'     => ['Web App', 'ERP/CRM'],
            'healthcare' => ['Web App', 'Mobile App', 'SaaS'],
            'fintech'    => ['SaaS', 'ERP/CRM'],
            'restaurant' => ['Web App', 'Mobile App'],
            'startup'    => ['SaaS', 'Web App', 'UI/UX'],
            'enterprise' => ['ERP/CRM', 'SaaS'],
        ];

        $type = strtolower($request->business_type);
        $categories = collect($map)->first(fn($v, $k) => str_contains($type, $k)) ?? ['Web App'];

        $services = Service::whereIn('category', $categories)->limit(5)->get();

        return response()->json([
            'recommendations' => $services,
            'based_on'        => ['business_type' => $request->business_type, 'categories' => $categories],
        ]);
    }

    public function products(Request $request)
    {
        $request->validate(['business_type' => 'required|string|max:100']);

        $products = Product::limit(4)->get();

        return response()->json(['recommendations' => $products]);
    }
}
