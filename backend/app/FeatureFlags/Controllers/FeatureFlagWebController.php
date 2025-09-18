<?php

namespace App\FeatureFlags\Controllers;

use App\Config\AppController;
use App\FeatureFlags\Services\FeatureFlagService;
use App\FeatureFlags\Models\FeatureFlag;
use App\FeatureFlags\Controllers\FeatureFlagWebRequest;

class FeatureFlagWebController extends AppController
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
    public function store(FeatureFlagWebRequest $request)
    {

        $data = $request->validated();

        // If "rules" comes as string from form → convert to array
        if (is_string($data['rules'])) {
            $data['rules'] = json_decode($data['rules'], true);
        }
        $this->service->create($data);

        return redirect()->route('featureFlags.index')
            ->with('success', 'Feature flag created!');
    }

    // Show form to edit existing flag
    public function edit(FeatureFlag $flag)
    {
        return view('featureFlags.edit', compact('flag'));
    }

    // Update existing flag
    public function update(FeatureFlagWebRequest $request, FeatureFlag $flag)
    {
        $data = $request->validated();

        // Normalize "enabled" to true/false (always present because of hidden input)
        $data['enabled'] = $request->boolean('enabled');

        // If "rules" comes as string from form → convert to array
        if (is_string($data['rules'])) {
            $data['rules'] = json_decode($data['rules'], true);
        }

        $this->service->update($flag, $data);

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
