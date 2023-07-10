<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'icon',
        'color',
        'status'
    ];

    public function task(): HasOne
    {
        return $this->hasOne(Task::class);
    }
}
