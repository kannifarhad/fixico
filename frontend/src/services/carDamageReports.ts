// services/carDamageReports.ts
import { apiClient } from "@/lib/apiClient";
import { CarDamageReport } from "@/types/carDamageReport";
import { PaginatedResponse } from "@/types/pagination";

export const carDamageReportsService = {
  async list(page = 1): Promise<PaginatedResponse<CarDamageReport>> {
    return apiClient(`/carReports?page=${page}`);
    // cache for 60s
  },

  async get(id: number): Promise<CarDamageReport> {
    return apiClient(`/carReports/${id}`);
  },

  async create(data: Partial<CarDamageReport>): Promise<CarDamageReport> {
    return apiClient(`/carReports`, {
      method: "POST",
      body: JSON.stringify(data),
    });
  },

  async update(id: number, data: Partial<CarDamageReport>): Promise<CarDamageReport> {
    return apiClient(`/carReports/${id}`, {
      method: "PUT",
      body: JSON.stringify(data),
    });
  },

  async delete(id: number): Promise<void> {
    await apiClient(`/carReports/${id}`, { method: "DELETE" });
  },
};
