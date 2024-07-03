<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Libro
 *
 * @property $id
 * @property $titulo
 * @property $autor
 * @property $genero
 * @property $isbn
 * @property $copias
 * @property $reservado_por
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property EtiquetaLibro[] $etiquetaLibros
 * @property Prestamo[] $prestamos
 * @property Reservar[] $reservars
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Libro extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'autor', 'genero', 'isbn', 'copias','imagen','reservado_por'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'reservado_por', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany(\App\Models\Prestamo::class, 'id', 'libro_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservars()
    {
        return $this->hasMany(\App\Models\Reservar::class, 'id', 'libro_id');
    }
    

}
