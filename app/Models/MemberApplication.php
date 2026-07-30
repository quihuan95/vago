<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemberApplication extends Model
{
    protected $fillable = [
        'full_name', 'date_of_birth', 'gender', 'academic_title', 'specialty',
        'organization', 'job_title', 'phone', 'email', 'address', 'province',
        'member_type', 'attachment', 'notes', 'status', 'extra_fields', 'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'extra_fields' => 'array',
        ];
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(MemberApplicationStatusLog::class)->latest();
    }
}
