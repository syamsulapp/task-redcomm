<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteTokenModel extends Model
{
    protected $table = 'oauth_access_tokens';

    use HasFactory;
}
