<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Item extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'code',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
