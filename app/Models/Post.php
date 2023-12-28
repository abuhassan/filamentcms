<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_published',
        'meta_description',
        'user_id',
        'is_featured'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function excerpt(): string
    {
        return Str::limit(strip_tags($this->content), 200, '...');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


}
