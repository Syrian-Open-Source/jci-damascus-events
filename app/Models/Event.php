<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
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

    public function foodTables()
    {
        return $this->hasMany(FoodTable::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->get();
    }

    public function chairs(){
        return $this->hasManyThrough(ChairTable::class, FoodTable::class);
    }

    // public function setCoverAttribute($value)
    // {
    //     $attribute_name = "image";
    //     $disk = "public";
    //     $destination_path = "folder_1/subfolder_1";

    //     $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    // }
}
