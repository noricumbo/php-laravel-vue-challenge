<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::slug( $value ),
            set: fn (string $value) => Str::slug( $value ),
        );
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
