<?php

namespace App\FeatureFlags\Web;

use App\Config\AppController;
use App\FeatureFlags\Services\FeatureFlagService;
use App\FeatureFlags\Models\FeatureFlag;
use App\FeatureFlags\Web\FeatureFlagRequest;

class FeatureFlagController extends AppController
{
    protected FeatureFlagService $service;

    public function __construct(FeatureFlagService $service)
    {
        $this->service = $service;
    }

    // Display all feature flags
    public function index()
    {
        $flags = $this->service->getAll();
        return view('featureFlags.index', compact('flags'));
    }

    // Show form to create a new flag
    public function create()
    {
        return view('featureFlags.create');
    }

    // Store a new flag
    public function store(FeatureFlagRequest $request)
    {

        $this->service->create($request->validated());

        return redirect()->route('featureFlags.index')
            ->with('success', 'Feature flag created!');
    }

    // Show form to edit existing flag
    public function edit(FeatureFlag $flag)
    {
        return view('featureFlags.edit', compact('flag'));
    }

    // Update existing flag
    public function update(FeatureFlagRequest $request, FeatureFlag $flag)
    {
        $this->service->update($flag, $request->validated());

        return redirect()->route('featureFlags.index')
            ->with('success', 'Feature flag updated!');
    }

    // Delete flag
    public function destroy(FeatureFlag $flag)
    {
        $this->service->delete($flag);

        return redirect()->route('featureFlags.index')
            ->with('success', 'Feature flag deleted!');
    }
}
