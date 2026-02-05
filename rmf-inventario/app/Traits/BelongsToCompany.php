<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToCompany
{
    protected static function bootBelongsToCompany()
    {
        static::addGlobalScope('company_filter', function (Builder $builder) {
            if (auth()->check() && auth()->user()->company_id) {
                // Obtenemos el nombre de la tabla actual automáticamente
                $table = $builder->getModel()->getTable();
                
                // Forzamos que siempre use 'tabla.company_id'
                $builder->where($table . '.company_id', auth()->user()->company_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->company_id) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }
}