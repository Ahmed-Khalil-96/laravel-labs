<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SocialUser extends Model
{
    use HasFactory;
    protected $table = "socialusers";
    protected $fillable = [
        'provider',
        'provider_user_id',
        'user_id',
        'token',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
