<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotesModels extends Model
{
    protected $table = 'notes';

    protected $fillable = ['title', 'desc', 'text', 'users_id'];

    public function users_id(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    use HasFactory;
}
