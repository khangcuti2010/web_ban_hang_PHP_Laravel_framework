<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'content',
        'active'
    ];
    //mối quan hệ với model Product
    public function products()
    {
        return $this->hasMany(Product::class,'menu_id');
    }
    //Hàm hiển thị tên Menu Cha
    public function parentName()
    {
        if ($this->parent_id == 0) {
            return 'Menu Cha';
        } else {
            $parent = Menu::find($this->parent_id);
            return $parent->name; // giả sử trường chứa tên là 'name'
        }
    }
}
