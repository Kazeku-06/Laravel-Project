<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['category_name', 'category_description'];

    public static function createCategory(array $data)
    {
        return self::create($data);
    }

    public static function getAllCategoriesPaginated($perPage = 5)
    {
        return self::paginate($perPage);
    }

    public static function updateCategory(string $id, array $data)
    {
        return self::where('category_id', $id)->update($data);
    }

    public static function deleteCategory(string $id)
    {
        return self::where('category_id', $id)->delete();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->category_id = (string) Str::uuid();
        });
    }
}
