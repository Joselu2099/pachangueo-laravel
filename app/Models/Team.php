<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model
{
    /**
     *  String name
     *  String color
     *  String image
     *  List<User> users
     */

    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'color', 'image'
    ];

    protected $attributes = [
        'image' => 'shield.png'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'players', 'team_id', 'user_id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'players', 'team_id', 'game_id');
    }

    public static function validate()
    {
        return request()->validate([
            'name' => 'required',
            'color' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getColor()
    {
        return $this->attributes['color'];
    }

    public function setColor($color)
    {
        $this->attributes['color'] = $color;
    }

    public function getImage()
    {
        if(is_null($this->attributes['image']) || !isset($this->attributes['image'])){
            return "shield.png";
        }
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
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
