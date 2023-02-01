<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Game extends Model
{

    use HasFactory, Notifiable, HasApiTokens;

    /**
     *  String location;
     *  String description;
     *  User creator;
     *  Map<Integer,GameMatch> games;
     */

    protected $fillable = [
        'location', 'date', 'sport', 'description', 'creator',
    ];

    public static function validate()
    {
        return request()->validate([
            'location' => 'required|max:255',
            'date' => 'required|date',
            'sport' => 'required|in:Futbol Sala,Futbol 7,Baloncesto',
            'description' => 'nullable|max:150',
            'creator' => 'required|exists:users,id',
        ]);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function matches()
    {
        return $this->hasMany(GameMatch::class);
    }

    public function players()
    {
        return $this->belongsToMany(User::class, 'players', 'game_id', 'user_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'players', 'game_id', 'team_id');
    }

    public function storeWithCreator()
    {
        $this->save();
        $this->players()->attach(auth()->id());
    }

    public function getMatches(){

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

    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($date)
    {
        $this->attributes['date'] = $date;
    }

    public function getSport(){
        return $this->attributes['sport'];
    }

    public function setSport($sport){
        $this->attributes['sport'] = $sport;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getCreator()
    {
        return $this->attributes['description'];
    }

    public function setCreator($creator)
    {
        $this->attributes['creator'] = $creator;
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

