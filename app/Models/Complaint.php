<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'complainant_id',
        'subject',
        'description',
        'status',
        'admin_response',
    ];

    public function complainant()
    {
        return $this->belongsTo(User::class, 'complainant_id');
    }
}