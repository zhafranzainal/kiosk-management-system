<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'kiosk_participant_id',
        'course_id',
        'matric_no',
        'year',
        'semester',
    ];

    protected $searchableFields = ['*'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function kioskParticipant()
    {
        return $this->belongsTo(KioskParticipant::class);
    }
}
