import { API_URL } from "@/constants/config";

export const fetcher = async <T>(url: string): Promise<T> => {
  const res = await fetch(`${API_URL}${url}`, { cache: "no-store" });
  if (!res.ok) {
    throw new Error(`Failed to fetch ${url}, status: ${res.status}`);
  }
  return res.json();
};


export default fetcher;
