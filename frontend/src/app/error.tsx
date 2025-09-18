"use client";
import { useEffect } from "react";

export default function GlobalError({ error, reset }: { error: Error; reset: () => void }) {
  useEffect(() => {
    console.error(error);
  }, [error]);

  return (
    <div className="p-6 text-center">
      <h1 className="text-3xl font-bold mb-4">Something went wrong</h1>
      <p className="text-gray-600">An unexpected error occurred. Please try again.</p>
      <button onClick={() => reset()} className="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Try again
      </button>
    </div>
  );
}
