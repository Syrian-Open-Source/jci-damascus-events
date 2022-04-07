<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'cover',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'timestamp',
        'end_date' => 'timestamp',
        'is_active' => 'boolean',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active')->get();
    }
}
