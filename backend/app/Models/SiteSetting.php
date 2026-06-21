<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SiteSetting extends Model {
    protected $fillable = ['key','value'];
    protected $casts = ['value'=>'array'];
    public static function get(string $key, $default = null) {
        $s = static::where('key',$key)->first();
        return $s ? $s->value : $default;
    }
    public static function set(string $key, $value) {
        return static::updateOrCreate(['key'=>$key],['value'=>$value]);
    }
}
