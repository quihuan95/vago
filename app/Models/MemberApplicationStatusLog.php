<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberApplicationStatusLog extends Model
{
    protected $fillable = [
        'member_application_id', 'user_id', 'from_status', 'to_status', 'note',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(MemberApplication::class, 'member_application_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
