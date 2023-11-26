<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['kiosk_participant_id', 'amount'];

    protected $searchableFields = ['*'];

    public function kioskParticipant()
    {
        return $this->belongsTo(KioskParticipant::class);
    }
}
