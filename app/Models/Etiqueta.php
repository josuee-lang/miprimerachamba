<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Etiqueta
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property EtiquetaLibro[] $etiquetaLibros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Etiqueta extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etiquetaLibros()
    {
        return $this->hasMany(\App\Models\EtiquetaLibro::class, 'id', 'etiqueta_id');
    }
    

}
