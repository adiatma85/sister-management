<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Sister extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const STATUS_SELECT = [
        'assigned' => 'Sedang Bekerja',
        'open'     => 'Belum Bekerja',
        'unknown'  => 'Tidak diketahui',
    ];

    public const TYPE_SELECT = [
        'Pembantu'       => 'Pembantu',
        'Baby Sister'    => 'Baby Sister',
        'Patient Sister' => 'Suster Pasien',
    ];

    public $table = 'sisters';

    protected $appends = [
        'self_image',
        'ktp_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'province',
        'city',
        'sub_district',
        'ward',
        'address',
        'number',
        'age',
        'status',
        'prefered_salary',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getSelfImageAttribute()
    {
        $files = $this->getMedia('self_image');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getKtpImageAttribute()
    {
        $files = $this->getMedia('ktp_image');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}