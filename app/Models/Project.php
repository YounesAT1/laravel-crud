<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'idP';
    protected $fillable = [
        'name',	'description', 'picture'	
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'idP', 'idP');
    }
}
