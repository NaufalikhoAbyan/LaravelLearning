<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'];

    protected $sortable = ['created_at', 'price'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeMostRecent($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeWithoutSold(Builder $query): Builder
    {
        return $query->whereDoesntHave('offers')->orWhereHas('offers', fn (Builder $query) => $query->whereNull('accepted_at')->whereNull('rejected_at'));
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(isset($filters['priceFrom']), fn ($query) => $query->where('price', '>=', $filters['priceFrom']))
            ->when(isset($filters['priceTo']), fn ($query) => $query->where('price', '<=', $filters['priceTo']))
            ->when(isset($filters['beds']), fn ($query) => $query->where('beds', (int)$filters['beds'] < 6 ? "=" : ">=", (int)$filters['beds']))
            ->when(isset($filters['baths']), fn ($query) => $query->where('baths', (int)$filters['baths'] < 6 ? "=" : ">=" , (int)$filters['baths']))
            ->when(isset($filters['areaFrom']), fn ($query) => $query->where('area', '>=', $filters['areaFrom']))
            ->when(isset($filters['areaTo']), fn ($query) => $query->where('area', '<=', $filters['areaTo']))
            ->when($filters['deleted'] ?? false, fn ($query) => $query->withTrashed())
            ->when(isset($filters['by']), fn ($query) => !in_array($filters['by'], $this->sortable) ? $query : $query->orderBy($filters['by'] ?? 'created_at', $filters['order'] ?? 'desc'));
    }
}
