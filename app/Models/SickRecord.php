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

class SickRecord extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const RECEIVING_MEDICINE_RADIO = [
        'yes' => 'yes',
        'no'  => 'no',
    ];

    public $table = 'sick_records';

    public static $searchable = [
        'reception_recording',
        'doctors_diagnosis',
        'laboratory_analysis',
        'receiving_medicine',
    ];

    protected $dates = [
        'reception_recording',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'p_name_id',
        'reception_recording',
        'doctors_diagnosis',
        'laboratory_analysis',
        'receiving_medicine',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function p_name()
    {
        return $this->belongsTo(Patient::class, 'p_name_id');
    }

    public function getReceptionRecordingAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setReceptionRecordingAttribute($value)
    {
        $this->attributes['reception_recording'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
