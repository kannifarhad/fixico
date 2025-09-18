<?php

namespace App\CarDamageReports\Services;

use App\CarDamageReports\Models\CarDamageReports;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CarDamageReportsService
{
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return CarDamageReports::latest()->paginate($perPage);
    }

    public function find(int $id): ?CarDamageReports
    {
        return CarDamageReports::find($id);
    }

    public function create(array $data): CarDamageReports
    {
        return CarDamageReports::create($data);
    }

    public function update(CarDamageReports $report, array $data): CarDamageReports
    {
        $report->update($data);
        return $report;
    }

    public function delete(CarDamageReports $report): void
    {
        $report->delete();
    }
}
