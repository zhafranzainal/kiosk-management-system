<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kiosk extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'business_type_id',
        'name',
        'location',
        'suggested_action',
        'comment',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function kioskParticipants()
    {
        return $this->hasMany(KioskParticipant::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }
}
