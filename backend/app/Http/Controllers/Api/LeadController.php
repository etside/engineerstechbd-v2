<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MCPLead;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:120',
            'email'                => 'required|email|max:120',
            'phone'                => 'nullable|string|max:30',
            'company'              => 'nullable|string|max:120',
            'service_interest'     => 'nullable|string|max:120',
            'budget_range'         => 'nullable|string|max:50',
            'platform_source'      => 'nullable|string|max:30',
            'conversation_summary' => 'nullable|string|max:2000',
        ]);

        $data['lead_score']      = MCPLead::calcScore($data);
        $data['platform_source'] = $data['platform_source'] ?? 'web';

        $lead = MCPLead::create($data);

        return response()->json([
            'id'         => $lead->id,
            'status'     => $lead->status,
            'lead_score' => $lead->lead_score,
            'message'    => 'Lead captured. Our team will contact you within 24 hours.',
        ], 201);
    }

    public function show(string $id)
    {
        $lead = MCPLead::findOrFail($id);
        return response()->json([
            'id'         => $lead->id,
            'status'     => $lead->status,
            'lead_score' => $lead->lead_score,
            'created_at' => $lead->created_at,
        ]);
    }
}
