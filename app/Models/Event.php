<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

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

    public function chairs()
    {
        return $this->hasManyThrough(ChairTable::class, FoodTable::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            Storage::delete(Str::replaceFirst('storage/', 'public/', $obj->image));
        });
    }



    public function setCoverAttribute($value)
    {
        $attribute_name = "cover";
        // destination path relative to the disk above
        $destination_path = "public/events";

        // if the Cover was erased
        if ($value == null) {
            // delete the Cover from disk
            Storage::delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // 0. Make the Cover
        $image = Image::make($value)->encode('jpg', 90);

        // 1. Generate a filename.
        $filename = md5($value . time()) . '.jpg';

        // 2. Store the image on disk.
        Storage::put($destination_path . '/' . $filename, $image->stream());

        // 3. Delete the previous image, if there was one.
        Storage::delete(Str::replaceFirst('storage/', 'public/', $this->{$attribute_name}));

        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it
        // from the root folder; that way, what gets saved in the db
        // is the public URL (everything that comes after the domain name)
        $public_destination_path = Str::replaceFirst('public/', 'storage/', $destination_path);
        $this->attributes['cover'] = $public_destination_path . '/' . $filename;
    }

    // public function setCoverAttribute($value)
    // {
    //     $attribute_name = "image";
    //     $disk = "public";
    //     $destination_path = "folder_1/subfolder_1";

    //     $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    // }
}
