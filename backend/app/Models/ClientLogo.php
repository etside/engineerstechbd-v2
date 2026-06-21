<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ClientLogo extends Model {
    protected $fillable = ['name','logo_url','website_url','display_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function scopeActive($q){ return $q->where('is_active',true)->orderBy('display_order'); }
}
