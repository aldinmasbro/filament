<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon',
        'title',
        'description',
        'sort',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($service) {
            if ($service->isDirty('icon') && ($service->getOriginal('icon') !== null)) {
               Storage::disk('public')->delete($service->getOriginal('icon'));
            }
        });

        static::deleting(function ($service){
            Storage::disk('public')->delete($service->icon);
        });

    }
}
