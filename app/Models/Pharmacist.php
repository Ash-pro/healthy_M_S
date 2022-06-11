<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacist extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'pharmacists';

    public static $searchable = [
        'name',
        'phone',
        'address',
        'age',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'address',
        'age',
        'user_account_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pNamePharmacistSalaries()
    {
        return $this->hasMany(PharmacistSalary::class, 'p_name_id', 'id');
    }

    public function user_account()
    {
        return $this->belongsTo(User::class, 'user_account_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
