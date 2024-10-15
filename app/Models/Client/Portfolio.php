<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function clients()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    // New function to get other portfolios for the client
    public function getOtherPortfolios($excludeId)
    {
        return $this->clients->portfolio()->where('id', '!=', $excludeId)->get();
    }

    public function service_items()
    {
        return $this->belongsTo(ServiceItems::class, 'service_id');
    }


    public function activities_gallery()
    {
        return $this->hasMany(ActivitiesGallery::class, 'portfolio_id');
    }
}
