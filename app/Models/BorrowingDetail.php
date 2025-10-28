<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'detail_id',
        'detail_book_id',
        'detail_borrowing_id',
        'detail_quantity',
    ];


    public function book() : BelongsTo
{
    return $this->belongsTo(Book::class, 'detail_book_id', 'book_id');
}

}
