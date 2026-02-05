<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCompany
{
    protected static function bootHasCompany(): void
    {
        static::addGlobalScope('company_filter', function (Builder $builder) {
            if (auth()->check() && auth()->user()->company_id) {
                // qualifyColumn es la clave: convierte 'company_id' en 'products.company_id' automáticamente
                $builder->where($builder->qualifyColumn('company_id'), auth()->user()->company_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->company_id) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }
}