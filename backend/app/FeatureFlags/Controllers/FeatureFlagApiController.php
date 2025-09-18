<?php

namespace App\FeatureFlags\Controllers;

use App\Config\APIController;
use App\FeatureFlags\Services\FeatureFlagService;
use Illuminate\Http\Request;

class FeatureFlagApiController extends APIController
{
    protected FeatureFlagService $service;

    public function __construct(FeatureFlagService $service)
    {
        $this->service = $service;
    }
    /**
     * @OA\Get(
     *     path="/api/flags",
     *     tags={"Feature Flags"},
     *     summary="Get all feature flags",
     *     @OA\Parameter(
     *         name="userId",
     *         in="query",
     *         required=false,
     *         description="Filter flags for a specific user",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of feature flags",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/FeatureFlag"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $userId = $request->query('userId') ?? crc32(request()->ip() ?? uniqid());
        return $this->service->getAllEnabled($userId ? (int) $userId : null);
    }

    /**
     * @OA\Get(
     *     path="/api/flags/{key}",
     *     tags={"Feature Flags"},
     *     summary="Get a single feature flag",
     *     @OA\Parameter(
     *         name="key",
     *         in="path",
     *         description="Feature flag key",
     *         example="allow_delete_reports",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="userId",
     *         in="query",
     *         required=false,
     *         description="Filter flags for a specific user",
     *         @OA\Schema(type="integer", example=123)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Feature flag data",
     *         @OA\JsonContent(ref="#/components/schemas/FeatureFlag")
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Request $request, string $key)
    {
        $userId = $request->query('userId') ?? crc32(request()->ip() ?? uniqid());
        return response()->json([
            'enabled' => $this->service->isEnabledByKey($key, $userId ? (int) $userId : null)
        ]);
    }
}
