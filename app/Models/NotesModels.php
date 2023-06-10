<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotesModels extends Model
{
    protected $table = 'notes';

    protected $fillable = ['title', 'desc', 'text'];

    use HasFactory;
}
