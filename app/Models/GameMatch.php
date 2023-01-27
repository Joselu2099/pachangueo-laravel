<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameMatch extends Model
{

    /**
     *  LocalDate date;
     *  LocalTime startTime;
     *  LocalTime endTime;
     *  Team team1;
     *  Team team2;
     */

    use HasFactory;

    protected $fillable = [
        'date', 'startTime', 'endTime', 'team1_id', 'team2_id'
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function validate()
    {
        return request()->validate([
            'date' => 'required|date',
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
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

    public function getStartTime()
    {
        return $this->attributes['startTime'];
    }

    public function setStartTime($startTime)
    {
        $this->attributes['startTime'] = $startTime;
    }

    public function getEndTime()
    {
        return $this->attributes['endTime'];
    }

    public function setEndTime($endTime)
    {
        $this->attributes['endTime'] = $endTime;
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
