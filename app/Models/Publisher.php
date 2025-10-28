<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'publisher_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['publisher_name', 'publisher_description'];

    public static function createPublisher(array $data)
    {
        return self::create($data);
    }

    public static function getAllPublishersPaginated($perPage = 5)
    {
        return self::paginate($perPage);
    }

    public static function updatePublisher(string $id, array $data)
    {
        return self::where('publisher_id', $id)->update($data);
    }

    public static function deletePublisher(string $id)
    {
        return self::where('publisher_id', $id)->delete();
    }


    protected static function boot()
{
    parent::boot();

    static::creating(function ($publisher) {
        $publisher->publisher_id = Str::uuid();
    });
}
}
