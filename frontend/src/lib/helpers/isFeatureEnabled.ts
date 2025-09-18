import { FeatureFlag } from "@/lib/hooks/useAllFeatureFlags";

export function isFeatureEnabled(flags: FeatureFlag[], key: string): boolean {
  const flag = flags.find(f => f.key === key);
  return flag?.enabled ?? false;
}