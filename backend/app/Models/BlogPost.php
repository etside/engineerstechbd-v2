<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BlogPost extends Model {
    protected $fillable = ['slug','title','excerpt','content','category','cover_image','is_published','published_at','author_id'];
    protected $casts = ['is_published'=>'boolean','published_at'=>'datetime'];
    public function author(){ return $this->belongsTo(User::class,'author_id'); }
    public function scopePublished($q){ return $q->where('is_published',true)->orderByDesc('published_at'); }
}
