<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

// App\Models\Borrowing.php

public function user()
{
    return $this->belongsTo(User::class, 'borrowing_user_id', 'id');
}


public function details()
{
    return $this->hasMany(BorrowingDetail::class, 'detail_borrowing_id');
}





}
