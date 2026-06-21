<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model {
    protected $fillable = ['name','designation','bio','photo_url','linkedin_url','whatsapp_number','display_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function scopeActive($q){ return $q->where('is_active',true)->orderBy('display_order'); }
}
