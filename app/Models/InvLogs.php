<?php

namespace App\Models;

use App\Models\Inv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvLogs extends Model
{
    use HasFactory;

    protected $table = 'inv_logs';

    protected $fillable = [
        'user_id', 'inv_id', 'inv_date', 'stock', 'return_date'
    ];

    /**
     * Get the user that owns the InvLogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the InvLogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inv(): BelongsTo
    {
        return $this->belongsTo(Inv::class, 'inv_id', 'id');
    }
}
