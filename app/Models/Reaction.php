<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $table = 'reactions';

    protected $fillable = [
        'publication_id',
        'user_id',
        'ip_address',
        'type',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
=======
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
}
