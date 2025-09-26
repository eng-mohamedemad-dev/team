<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'image_path',
    ];


    public function getTypeNameAttribute()
    {
        return match($this->type) {
            'stadium' => 'استاد الصعيد',
            'maqassa' => 'المقاصة مباشر',
            'club' => 'نادي بني سويف',
            default => 'غير محدد'
        };
    }
}