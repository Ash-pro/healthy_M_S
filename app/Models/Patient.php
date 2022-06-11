<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Patient extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const CHRONIC_DISEASES_RADIO = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    public const BLOOD_TYPE_SELECT = [
        'A+'  => 'A+',
        'A-'  => 'A-',
        'B+'  => 'B+',
        'B-'  => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+'  => 'O+',
        'O-'  => 'O-',
    ];

    public $table = 'patients';

    public static $searchable = [
        'name',
        'address',
        'birthday',
        'blood_type',
        'chronic_diseases',
        'notes',
    ];

    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'birthday',
        'blood_type',
        'chronic_diseases',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function pNameSickRecords()
    {
        return $this->hasMany(SickRecord::class, 'p_name_id', 'id');
    }

    public function patientCustomerPayments()
    {
        return $this->hasMany(CustomerPayment::class, 'patient_id', 'id');
    }

    public function getBirthdayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
