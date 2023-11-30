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
        'title', 'description', 'iduser', 'idcategory', 'status_id', 'priority_id', 'schedule_id', 'created_at', 'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'idcategory')->withDefault();
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id')->withDefault();
    }

    public function priority(): HasOne
    {
        return $this->hasOne(Priority::class, 'id', 'priority_id')->withDefault();
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id')->withDefault();
    }
}
