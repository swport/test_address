<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\EmailTrait;

class Address extends Model
{
    use HasFactory, EmailTrait;

    protected $fillable = ['city', 'state', 'country'];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->notifyViaEmail();
        });
    }
}
