"use client";
import { useAllFeatureFlags } from "@/lib/hooks/useAllFeatureFlags";
import Link from "next/link";

export default function Home() {
  const { flags, isLoading } = useAllFeatureFlags();

  if (isLoading) return <p>Loading feature flags...</p>;

  return (
    <main className="p-8">
      <h1 className="text-2xl font-bold mb-4">Feature Flags Demo</h1>
      <Link href="/car-reports" className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Go To Car Reports
      </Link>

      <pre className="bg-gray-100 p-4 mt-4 rounded">{JSON.stringify(flags, null, 2)}</pre>
    </main>
  );
}
