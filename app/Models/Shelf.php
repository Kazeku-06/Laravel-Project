<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelf extends Model
{
    use HasFactory;

    protected $table = "shelfs";
    protected $primaryKey = 'shelf_id'; // Ganti dari category_id ke shelf_id
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['shelf_name', 'shelf_position'];

    // Create shelf
    public static function createShelf(array $data)
    {
        return self::create($data);
    }

    // Get shelves paginated
    public static function getAllShelvesPaginated($perPage = 5)
    {
        return self::paginate($perPage);
    }

    // Update shelf
    public static function updateShelf(string $id, array $data)
    {
        return self::where('shelf_id', $id)->update($data);
    }

    // Delete shelf
    public static function deleteShelf(string $id)
    {
        return self::where('shelf_id', $id)->delete();
    }

    // Auto-generate UUID for shelf_id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shelf) {
            $shelf->shelf_id = (string) Str::uuid();
        });
    }
}
