<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservar
 *
 * @property $id
 * @property $user_id
 * @property $libro_id
 * @property $reservar_at
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Libro $libro
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reservar extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'libro_id', 'reservar_at', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->status)) {
                $model->status = 'pendiente';
            }
        });
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libro()
    {
        return $this->belongsTo(\App\Models\Libro::class, 'libro_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    

}
