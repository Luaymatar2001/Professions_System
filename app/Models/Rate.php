<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['rate', 'comment', 'accept', 'worker_id'];
    public function scopeOwner($query, $id)
    {
        return $query->where('worker_id', $id);
    }
}
