<?php

namespace App\FeatureFlags\Services;

use App\FeatureFlags\Models\FeatureFlag;
use Illuminate\Database\Eloquent\Collection;

class FeatureFlagService
{
    public function getAll(): Collection
    {
        return FeatureFlag::all();
    }

    public function create(array $data): FeatureFlag
    {
        return FeatureFlag::create($data);
    }

    public function find(int $id): ?FeatureFlag
    {
        return FeatureFlag::find($id);
    }

    public function findByKey(string $key): ?FeatureFlag
    {
        return FeatureFlag::where('key', $key)->firstOrFail();
    }

    public function update(FeatureFlag $flag, array $data): FeatureFlag
    {
        $flag->update($data);
        return $flag;
    }

    public function delete(FeatureFlag $flag): void
    {
        $flag->delete();
    }
}
