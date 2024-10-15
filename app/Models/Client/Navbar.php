<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Navbar::class, 'parent')->orderBy('index');
    }
}
