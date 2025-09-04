<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;

    // 許可するカラム
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'category_id',
        'detail',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
    ];

    // カテゴリとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
