<?php

namespace App\CarDamageReports\Controllers;

use App\Config\AppController;
use App\CarDamageReports\Services\CarDamageReportsService;
use App\CarDamageReports\Controllers\CarDamageReportRequest;
use App\CarDamageReports\Models\CarDamageReports;

class CarDamageReportsWebController extends AppController
{
    protected CarDamageReportsService $service;

    public function __construct(CarDamageReportsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $reports = $this->service->getAll();
        return view('carReports.index', compact('reports'));
    }

    public function create()
    {
        return view('carReports.create');
    }

    public function store(CarDamageReportRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('carReports.index')
            ->with('success', 'Report created.');
    }

    public function show(CarDamageReports $carReport)
    {
        return view('carReports.show', compact('carReport'));
    }

    public function edit(CarDamageReports $carReport)
    {
        return view('carReports.edit', compact('carReport'));
    }

    public function update(CarDamageReportRequest $request, CarDamageReports $carReport)
    {
        $this->service->update($carReport, $request->validated());
        return redirect()->route('carReports.index')
            ->with('success', 'Report updated.');
    }
}
