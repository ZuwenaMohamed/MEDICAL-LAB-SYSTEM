<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description'])]
class Feature extends Model
{
    public function permissions(): HasMany
    {
        return $this->hasMany(
            \Spatie\Permission\Models\Permission::class,
            'feature_id'
        );
    }
}