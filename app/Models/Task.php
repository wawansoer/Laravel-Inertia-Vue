<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $primaryKey = 'id';

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

    protected $fillable = ['name', 'detail', 'user_id', 'm_category_id'];


    public function category()
    {
        return $this->belongsTo(MCategoryTask::class, 'm_category_id', 'id');
    }
}
