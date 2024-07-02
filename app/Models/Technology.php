<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    //protected $fillable = ['name', 'slug']; //non uso mass-assignment per due proprietà, creo la nuova istanza direttamente nel Controller

    /**
     * The projects that belong to the Technology
     *
     * @return \Illuminate\Database\Projectuent\Relations\BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
