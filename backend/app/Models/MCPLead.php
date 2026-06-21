<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCPLead extends Model
{
    protected $table = 'mcp_leads';

    protected $fillable = [
        'name', 'email', 'phone', 'company',
        'service_interest', 'budget_range',
        'platform_source', 'conversation_summary',
        'status', 'lead_score', 'contacted_at',
    ];

    protected $casts = ['contacted_at' => 'datetime'];

    /** Simple scoring: higher budget + known service = higher score */
    public static function calcScore(array $data): int
    {
        $score = 10;
        $budgetMap = ['under-10k' => 5, '10k-50k' => 20, '50k-100k' => 35, '100k+' => 50];
        $score += $budgetMap[$data['budget_range'] ?? ''] ?? 0;
        if (!empty($data['service_interest'])) $score += 20;
        if (!empty($data['company']))          $score += 10;
        if (!empty($data['phone']))            $score += 10;
        return min($score, 100);
    }
}
