"use client";

import { carDamageReportsService } from "@/services/carDamageReports";
import { useRouter } from "next/navigation";

export default function DeleteButton({ id }: { id: number }) {
  const router = useRouter();

  const handleDelete = async () => {
    if (!confirm("Are you sure you want to delete this report?")) return;
    await carDamageReportsService.delete(id);
    router.refresh(); // refresh server data
  };

  return (
    <button onClick={handleDelete} className="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 cursor-pointer">
      Delete
    </button>
  );
}
