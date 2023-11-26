<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KioskParticipant extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['user_id', 'kiosk_id', 'bank_id', 'account_no'];

    protected $searchableFields = ['*'];

    protected $table = 'kiosk_participants';

    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
