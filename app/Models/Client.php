<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($client) {
            if ($client->isDirty('image') && ($client->getOriginal('image') !== null)) {
                Storage::disk('public')->delete($client->getOriginal('image'));
            }
        });

        static::deleting(function ($client) {
            Storage::disk('public')->delete($client->image);
        });
}
}
