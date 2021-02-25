<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Task extends Model
{
    use HasFactory;

    /**
     * Returns all users relation with the given task
     * @return \Illuminate\Database\Eloquent\Concerns\HasRelationships
     */
    public function users()
    {
    	return $this->belongsToMany(User::class, 'users_tasks');
    }
}
