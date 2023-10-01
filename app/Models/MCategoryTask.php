<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class MCategoryTask extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'm_category_task';

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted(): void
    {
        parent::booted();

        // Generate and set a UUID for the 'id' attribute when creating a new record
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'm_category_id', 'id');
    }

}
