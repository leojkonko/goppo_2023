<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Log extends Model
{
    use HasFactory, AsSource, Filterable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * Nível de usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Name of columns to which http filter can be applied
     *
     * @var array
     */
    protected $allowedFilters = [
        'user_name',
        'message',
        'created_at',
    ];

}
