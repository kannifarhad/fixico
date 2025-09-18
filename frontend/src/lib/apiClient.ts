import { API_URL } from "@/constants/config";

type FetchOptions = RequestInit & {
  revalidate?: number; // seconds for ISR cache
};

export async function apiClient<T>(endpoint: string, options: FetchOptions = {}): Promise<T> {
  const { revalidate, body, ...init } = options;

  let finalBody = body;
  if (body && typeof body === "object" && !(body instanceof FormData)) {
    finalBody = JSON.stringify(body);
  }
  const URL = `${API_URL}${endpoint}`;
  const res = await fetch(URL, {
    ...init,
    body: finalBody,
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      ...(init.headers || {}),
    },
    next: revalidate ? { revalidate } : { revalidate: 0 }, // 0 = no cache, always fresh
  });

  if (!res.ok) {
    throw new Error(`API error: ${res.status} ${res.statusText}`);
  }

  return res.json() as Promise<T>;
}
