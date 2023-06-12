<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Upload extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'filename',
        'created_at',
        'updated_at',
        'expired_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function expiredAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (int $value) => Carbon::now()->addHours($value),
        );
    }

    public function getOriginalNameAttribute(): string
    {
        return $this->getFirstMedia('uploads')->file_name;
    }

    public function getExtension(): string
    {
        return $this->getFirstMedia('uploads')->extension;
    }

    public function getSize()
    {
        return $this->getFirstMedia('uploads')->human_readable_size;
    }

    public function isImage(Media $media): bool
    {
        return in_array($media->extension, ['jpg', 'png', 'webp']);
    }
}
