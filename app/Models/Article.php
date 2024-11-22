<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Article extends Model
{
    use HasFactory; 

    // Define the fillable properties to prevent mass-assignment issues
    protected $fillable = ['title', 'author', 'content'];

    // Alternatively, if you are using guarded, you could do:
    // protected $guarded = []; // Allow all fields to be mass-assigned (not recommended unless necessary)
}
