<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
        protected int $page_items = 10;

        public function scopeSearchFilter($query, $search_filter, $search)
        {
            return $query->where($search_filter, 'ilike', '%' . $search . '%');
        }

        public function scopeWithFilter($query, $search_filter, $search)
        {
            $column = request()->column ? request()->column : 'id';
            $order = request()->order ? request()->order : 'asc';

            return $query->when(request()->has(['search', 'column', 'order']), function($query) {
                $query->searchFilter(request()->search_filter, request()->search);
                $query->orderBy( request()->column, request()->order );
            })
                ->when(request()->has(['search']), function ($query) {
                    $query->where(request()->search_filter, 'ilike', '%' . request()->search . '%');
                })
                ->orderBy( $column, $order )
                ->paginate($this->page_items)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => Carbon::parse($user->created_at)->format('M d Y'),
                ]);
        }

        public function scopeWithoutFilter($query, $search)
        {
            $column = request()->column ? request()->column : 'id';
            $order = request()->order ? request()->order : 'asc';

            return $query->when(request()->has(['search', 'column', 'order']), function($query) {
                $query->where('name', 'ilike', '%' . request()->search . '%');
                $query->orderBy( request()->column, request()->order );
            })
                ->when(request()->has(['search']), function ($query) {
                    $query->where('name', 'ilike', '%' . request()->search . '%');
                })
                ->orderBy( $column, $order )
                ->paginate($this->page_items)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => Carbon::parse($user->created_at)->format('M d Y'),
                ]);
        }
