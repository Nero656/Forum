<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'author_id', 'subject', 'content', 'like', 'date',
    ];

    // protected $dates = [
    //     'created_at' => 'date:Y-m',
    //     'updated_at',
    //     'deleted_at'];
}
