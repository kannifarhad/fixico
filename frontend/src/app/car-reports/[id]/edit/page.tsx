import { CarReportForm, CarReportFormData } from "@/components/CarReportForm";
import { carDamageReportsService } from "@/services/carDamageReports";
import Link from "next/link";
import { notFound, redirect } from "next/navigation";

interface Props {
  params: { id: string };
}

export default async function CarReportEditPage(props: Props) {
  // Await params before using them
  const { params } = await props;
  const id = Number(params.id);

  // Fetch report server-side
  let report: CarReportFormData;
  try {
    report = await carDamageReportsService.get(id);
  } catch (err) {
    return notFound();
  }

  const handleSubmit = async (data: CarReportFormData) => {
    "use server"; // optional for server actions
    await carDamageReportsService.update(id, data);
    redirect("/car-reports");
  };

  return (
    <div className="p-6">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-xl font-bold">Add New Car Damage Report</h1>
        <Link href="/car-reports" className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Report List
        </Link>
      </div>
      <div className="p-6 max-w-lg mx-auto">
        <CarReportForm onSubmit={handleSubmit} submitLabel="Update Report" defaultValues={report} />
      </div>
    </div>
  );
}
