<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'picture',
        'active'
    ];
    //mối quan hệ với model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
    //mối quan hệ với model Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
