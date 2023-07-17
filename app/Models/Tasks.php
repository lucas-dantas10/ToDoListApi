<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status_task', 'iduser', 'dtInicio', 'idcategory', 'created_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'idcategory')->withDefault();
    }
}
