<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
 protected $fillable=['title','slug','excerpt','content','image','published_at','is_active'];
 protected $casts=['is_active'=>'boolean','published_at'=>'datetime'];
 public function getRouteKeyName(): string { return 'slug'; }
}
