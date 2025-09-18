<?php

namespace App\CarDamageReports\Controllers;

use Illuminate\Http\JsonResponse;
use App\Config\APIController;
use App\CarDamageReports\Services\CarDamageReportsService;
use App\FeatureFlags\Services\FeatureFlagService;
use App\CarDamageReports\Controllers\CarDamageReportRequest;

class CarDamageReportsApiController extends APIController
{
    protected CarDamageReportsService $service;
    protected FeatureFlagService $featureFlagService;

    public function __construct(CarDamageReportsService $service, FeatureFlagService $featureFlagService)
    {
        $this->service = $service;
        $this->featureFlagService = $featureFlagService;
    }

    /**
     * @OA\Get(
     *     path="/api/carReports",
     *     summary="Get all car damage reports",
     *     tags={"CarDamageReports"},
     *     @OA\Response(
     *         response=200,
     *         description="List of car damage reports",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CarDamageReports"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @OA\Get(
     *     path="/api/carReports/{id}",
     *     summary="Get a single car damage report",
     *     tags={"CarDamageReports"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car damage report details",
     *         @OA\JsonContent(ref="#/components/schemas/CarDamageReports")
     *     ),
     *     @OA\Response(response=404, description="Report not found")
     * )
     */
    public function show(int $id): JsonResponse
    {
        $report = $this->service->find($id);
        if (!$report) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($report);
    }

    /**
     * @OA\Post(
     *     path="/api/carReports",
     *     summary="Create a new car damage report",
     *     tags={"CarDamageReports"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarDamageReportsInput")
     *     ),
     *     @OA\Response(response=201, description="Report created", @OA\JsonContent(ref="#/components/schemas/CarDamageReports")),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(CarDamageReportRequest $request): JsonResponse
    {
        $report = $this->service->create($request->validated());
        return response()->json($report, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/carReports/{id}",
     *     summary="Update an existing car damage report",
     *     tags={"CarDamageReports"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarDamageReportsInput")
     *     ),
     *     @OA\Response(response=200, description="Report updated", @OA\JsonContent(ref="#/components/schemas/CarDamageReports")),
     *     @OA\Response(response=404, description="Report not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(CarDamageReportRequest $request, int $id): JsonResponse
    {
        $report = $this->service->find($id);
        if (!$report) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $updated = $this->service->update($report, $request->validated());
        return response()->json($updated);
    }

    /**
     * @OA\Delete(
     *     path="/api/carReports/{id}",
     *     summary="Delete a car damage report",
     *     tags={"CarDamageReports"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Report deleted"),
     *     @OA\Response(response=404, description="Report not found")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $report = $this->service->find($id);
        $isReporteDeleteEnabled = $this->featureFlagService->isEnabledByKey('deleteReport');
        
        if (!$report || !$isReporteDeleteEnabled) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $this->service->delete($report);
        return response()->json(['message' => 'Deleted']);
    }
}
