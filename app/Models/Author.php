<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';
     public $incrementing = false; // WAJIB kalau UUID
    protected $keyType = 'string'; // Wajib juga kalau UUID
    
    protected $fillable = array(
        'author_id',
        'author_name',
        'author_description',
        'created_at',
        'updated_at'
    );
    protected $casts = array(
        'author_id' => 'string',
    );



protected static function boot()
{
    parent::boot();

    static::creating(function ($author) {
        $author->author_id = Str::uuid();
    });
}


public static function updateAuthor (array $data, string $author_id) {
    $author = self::where('author_id', $author_id)->first();

    if ($author) {
        $author->update($data);
    }

    return $author;
}


public static function deleteAuthor (string $author_id) {
    $author = self::where('author_id', $author_id)->first();

    if ($author) {
        $author->delete();
    }

    return $author;
}


public static function getAuthorsByName(string $name)
{
    return self::where('author_name', 'like', "%$name%")->paginate(10);
}
}
