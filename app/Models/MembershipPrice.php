<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPrice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
