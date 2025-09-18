import useSWR from "swr";
import { fetcher } from "@/lib/api";

export function useFeatureFlag(key: string, userId?: number) {
  const { data } = useSWR<{ enabled: boolean }>(`/feature-flags/${key}?userId=${userId ?? ""}`, fetcher, {
    refreshInterval: 60_000, // revalidate every 60s
  });
  return data?.enabled ?? false;
}
