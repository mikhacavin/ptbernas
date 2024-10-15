<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function clientFeedback()
    {
        return $this->belongsTo(clientFeedback::class, 'client_feedback_id');
    }

    public function clients()
    {
        return $this->hasOneThrough(Clients::class, ClientFeedback::class, 'id', 'id', 'client_feedback_id', 'client_id');
    }
}
