<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{

    /**
     *  String location;
     *  String description;
     *  User creator;
     *  Map<Integer,GameMatch> games;
     */

    protected $fillable = [
        'location', 'description', 'creator_id'
    ];

    public function validate()
    {
        return request()->validate([
            'location' => 'required|max:255',
            'description' => 'nullable',
            'creator' => 'required|exists:users,id',
        ]);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function matches()
    {
        return $this->hasMany(GameMatch::class);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getLocation()
    {
        return $this->attributes['location'];
    }

    public function setLocation($location)
    {
        $this->attributes['location'] = $location;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}

