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

    protected $fillable = ['name', 'description', 'time_first', 'notes', 'time_function', 'additional_file', 'value', 'funds', 'city_id', 'description_location', 'accept', 'user_id', 'worker_id', 'profession_id'];
    protected $appends = ['value_formatter'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function profession()
    {
        //fk ->pk
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
    //accessor function
    //formate the value according state or currancy
    public function getValueFormatterAttribute()
    {
        $formatter = new NumberFormatter('en', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->value, 'USD');
    }
    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        if (isset($request['city_id'])) {
            $query->where('city_id', $request['city_id']);
        }
        if (isset($request['profession_id'])) {
            $query->where('profession_id', $request['profession_id']);
        }
    }
}
