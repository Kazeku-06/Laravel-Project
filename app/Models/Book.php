<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Shelf;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'book_id';
    protected $keyType = 'string';

    protected $fillable = [
        'book_id',
        'book_name',
        'book_isbn',
        'book_img',
        'book_description',
        'book_stock',
        'book_author_id',
        'book_category_id',
        'book_publisher_id',
        'book_shelf_id',
    ];

    // Relasi
    public function author() {
        return $this->belongsTo(Author::class, 'book_author_id', 'author_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'book_category_id', 'category_id');
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class, 'book_publisher_id', 'publisher_id');
    }

    public function shelf() {
        return $this->belongsTo(Shelf::class, 'book_shelf_id', 'shelf_id');
    }

    // UUID otomatis
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            $book->book_id = Str::uuid();
        });
    }

    // -----------------------
    // Custom CRUD Methods
    // -----------------------

    // CREATE
public static function storeBook($data)
{
    return self::create($data);
}

public function updateBook(array $data): bool
{
    return $this->update($data);
}


    // DELETE
    public function deleteBook(): ?bool
    {
        return $this->delete();
    }

    // READ (ambil semua data buku dengan relasi)
    public static function getAllBooks($paginate = 5)
    {
        return self::with(['author', 'category', 'publisher', 'shelf'])->paginate($paginate);
    }

    // READ (ambil detail 1 buku)
    public static function getBookDetail(string $bookId): ?Book
    {
        return self::with(['author', 'category', 'publisher', 'shelf'])->find($bookId);
    }



}
