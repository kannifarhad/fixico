import { apiClient } from "@/lib/apiClient";
import { FeatureFlag } from "@/types/featureFlags";

export const featureFlagsService = {
  async list(userId = 1): Promise<FeatureFlag[]> {
    return apiClient<FeatureFlag[]>(`/flags?userId=${userId}`, {
      method: "GET",
      revalidate: 60,
    });
  },

  async getByKey(key: string, userId: number = 1): Promise<{ enabled: boolean }> {
    return apiClient<{ enabled: boolean }>(`/flags/${key}?userId=${userId}`, {
      method: "GET",
      revalidate: 60,
    });
  },

  async isFeatureEnabled(key: string, userId: number = 1) {
    return this.getByKey(key, userId)
      .then((result) => result.enabled)
      .catch((e) => {
        console.error("Error while fetching feature flag", key, e?.message);
        // As fallback scenario we return false
        return false;
      });
  },
};
