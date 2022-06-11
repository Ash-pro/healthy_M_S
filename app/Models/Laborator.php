<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laborator extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'laborators';

    public static $searchable = [
        'name',
        'specialty',
        'address',
        'phone',
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
        'specialty',
        'address',
        'phone',
        'birthday',
        'user_account_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function laboratoriesSalaryLabs()
    {
        return $this->hasMany(SalaryLab::class, 'laboratories_id', 'id');
    }

    public function getBirthdayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
