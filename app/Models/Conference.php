<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'location',
        'description',
        'thumbnail',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'conference_user')->withTimestamps();
    }
}
