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

    public function getAllEnabled(?int $userId = null): Collection
    {
        return $this->getAll()->filter(
            fn(FeatureFlag $flag) => $this->isEnabledByFlag($flag, $userId)
        );
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
        return FeatureFlag::where('key', $key)->first();
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

    public function isEnabledByFlag(FeatureFlag $flag, ?int $userId = null): bool
    {
        if (!$flag) return false;

        // Check simple enable/disable
        if (!$flag->enabled) return false;

        // Check time window
        if ($flag->starts_at && now()->lt($flag->starts_at)) return false;
        if ($flag->ends_at && now()->gt($flag->ends_at)) return false;

        // Check percentage rollout
        $rules = $flag->rules ?? [];
        if (isset($rules['percentage'])) {
            if (!$userId) return false;
            $bucket = $userId % 100;
            return $bucket < $rules['percentage'];
        }

        return true;
    }

    public function isEnabledByKey(string $key, ?int $userId = null): bool
    {
        $flag = FeatureFlag::where('key', $key)->firstOrFail();
        return $this->isEnabledByFlag($flag, $userId);
    }
}
