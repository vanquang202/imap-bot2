<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailImap extends Model
{
    use HasFactory;
    protected $table = "mail";
    protected $primaryKey = "id";
    protected $guarded = [];
}
