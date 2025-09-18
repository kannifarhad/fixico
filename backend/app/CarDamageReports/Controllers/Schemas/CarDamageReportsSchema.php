<?php

namespace App\CarDamageReports\Controllers\Schemas;

/**
 * @OA\Schema(
 *     schema="CarDamageReports",
 *     type="object",
 *     title="Car Damage Report",
 *     required={"reporter_name","car_model","license_plate","description","damage_level"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="reporter_name", type="string", example="John Doe"),
 *     @OA\Property(property="car_model", type="string", example="Toyota Corolla"),
 *     @OA\Property(property="license_plate", type="string", example="ABC-1234"),
 *     @OA\Property(property="description", type="string", example="Front bumper dented"),
 *     @OA\Property(property="damage_level", type="string", enum={"minor","moderate","severe"}, example="moderate"),
 *     @OA\Property(property="is_resolved", type="boolean", example=false),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-13T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-13T12:34:56Z")
 * )
 */
class CarDamageReportsSchema
{
    // Empty class, only for Swagger
}
