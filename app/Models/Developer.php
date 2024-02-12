<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasFactory;

    protected $table = 'developers';
    protected $primaryKey = 'idD';
    protected $fillable = [
        'firstName', 'lastName', 'cv', 'picture'
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'idD', 'idD');
    }
}
