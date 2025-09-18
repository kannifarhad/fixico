import { fetcher } from "@/lib/api";
import { FeatureFlag } from "@/types/featureFlags";
import useSWR from "swr";

export function useAllFeatureFlags() {
  const { data, error, isLoading, mutate } = useSWR<FeatureFlag[]>("/flags", fetcher, {
    refreshInterval: 60_000, // revalidate every 60s
  });

  return {
    flags: data ?? [],
    isLoading,
    isError: error,
    refresh: mutate,
  };
}
