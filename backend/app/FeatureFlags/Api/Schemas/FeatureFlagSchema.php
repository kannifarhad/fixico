<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="FeatureFlag",
 *     type="object",
 *     title="FeatureFlag",
 *     required={"id","key","name","enabled"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="key", type="string"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="enabled", type="boolean"),
 *     @OA\Property(property="rules", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="starts_at", type="string", format="date-time"),
 *     @OA\Property(property="ends_at", type="string", format="date-time")
 * )
 */
class FeatureFlagSchema
{
    // Empty class, only for Swagger
}