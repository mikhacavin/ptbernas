<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioClients extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_page',
        'title_client',
        'title_portfolio',
        'subtitle_portfolio',
        'image_url',
    ];
}
