<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','category','short_description','description','requirements','duration','is_featured','is_active','sort_order'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];
}
