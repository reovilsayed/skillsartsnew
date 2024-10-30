<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Team extends Model
{
    use HasFactory;
    use Translatable;
    protected $translatable = ['name', 'job_title'];
    protected $guarded = [];

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
