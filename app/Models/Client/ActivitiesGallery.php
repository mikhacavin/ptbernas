<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesGallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }

    // Relasi ke Client melalui Portofolio
    public function clients()
    {
        return $this->hasOneThrough(Clients::class, Portfolio::class, 'id', 'id', 'portfolio_id', 'client_id');
    }
}
