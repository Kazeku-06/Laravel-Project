<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrowing_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'borrowing_id',
        'borrowing_user_id',
        'borrowing_isreturned',
        'borrowing_notes',
        'borrowing_fine',
        'borrowing_date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'borrowing_user_id', 'id');
    }

    // Relasi ke detail peminjaman
    public function details()
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_borrowing_id');
    }

    // Accessor untuk menghitung denda
    public function getFineAttribute()
    {
        if ($this->borrowing_isreturned) {
            return $this->borrowing_fine;
        }

        $dateToUse = $this->borrowing_date ?: $this->created_at;
        $borrowingDate = Carbon::parse($dateToUse);
        $now = now();
        $weeksOverdue = floor($borrowingDate->diffInWeeks($now, false) - 1); // grace period 1 minggu

        return max(0, $weeksOverdue * 500);
    }
}
