<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use NumberFormatter;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'description', 'time_first', 'notes', 'time_function', 'additional_file', 'value', 'funds', 'city_id', 'description_location', 'accept', 'user_id', 'worker_id'];
    protected $appends = ['value_formatter'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'city_id'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255)
            ->skipGenerateWhen(fn () => $this->delete_at != null);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    //formate the value according state or currancy
    public function getValueFormatterAttribute()
    {
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        $formatter->formatCurrency($this->price, 'USD');
        return $formatter;
    }
}
