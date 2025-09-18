export type CarDamageLevel = "minor" | "moderate" | "severe";

export interface CarDamageReport {
  id: number;
  reporter_name: string;
  car_model: string;
  license_plate: string;
  description: string;
  damage_level: CarDamageLevel;
  is_resolved: boolean;
  created_at: string;
  updated_at: string;
}
