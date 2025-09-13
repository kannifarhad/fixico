<?php

namespace App\FeatureFlags\Api;

use App\Config\APIController;
use App\FeatureFlags\Services\FeatureFlagService;

class FeatureFlagController extends APIController
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
     *     @OA\Response(
     *         response=200,
     *         description="List of feature flags",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/FeatureFlag"))
     *     )
     * )
     */
    public function index()
    {
        $flags = $this->service->getAll();
        return response()->json($flags);
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
     *     @OA\Response(
     *         response=200,
     *         description="Feature flag data",
     *         @OA\JsonContent(ref="#/components/schemas/FeatureFlag")
     *     ),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(string $key)
    {
        $flag = $this->service->findByKey($key);

        return response()->json($flag);
    }
}
