<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class, 'client_id');
    }

}
