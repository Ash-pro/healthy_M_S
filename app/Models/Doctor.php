<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'doctors';

    public static $searchable = [
        'name',
        'phone',
        'address',
        'specialty',
        'birthday',
    ];

    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'address',
        'specialty',
        'birthday',
        'department_id',
        'user_account_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function dNameSalaries()
    {
        return $this->hasMany(Salary::class, 'd_name_id', 'id');
    }

    public function getBirthdayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
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
