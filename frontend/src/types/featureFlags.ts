export interface FeatureFlag {
  id: number;
  key: string;
  name: string;
  description?: string;
  enabled: boolean;
  rules?: Record<string, unknown>;
  starts_at?: string | null;
  ends_at?: string | null;
  created_at: string;
  updated_at: string;
}