import Link from "next/link";
import { carDamageReportsService } from "@/services/carDamageReports";
import { featureFlagsService } from "@/services/featureFlags";
import { CarDamageReport } from "@/types/carDamageReport";
import DeleteButton from "./DeleteButton";

// Currently, the user ID is set manually because we do not have session management implemented yet.
// Two feature flags depend on the user ID:
// 1. A whitelist-based feature, enabled only for specific user IDs: [21, 42, 55].
// 2. A percentage-based feature, enabled for approximately 30% of users.
//    The feature is considered enabled if the tens digit (last two digits) of the user ID is less than 30.
//    For example:
//      - Enabled for user IDs: 12, 312, 322
//      - Disabled for user IDs: 42, 155, etc.

const USER_ID = 39;

export default async function CarReportsListPage(props: { searchParams: Promise<{ page?: string }> }) {
  const { page } = await props.searchParams;
  const currentPage = Number(page) || 1;

  //we can fetch all enabled feature flags or one by one
  const [reports, newUI, exportCSV, inlineResolve, deleteReport] = await Promise.all([
    carDamageReportsService.list(currentPage),
    featureFlagsService.isFeatureEnabled("newUI", USER_ID),
    featureFlagsService.isFeatureEnabled("exportCSV", USER_ID),
    featureFlagsService.isFeatureEnabled("inlineResolve", USER_ID),
    featureFlagsService.isFeatureEnabled("deleteReport", USER_ID),
  ]);

  // const newUI = await featureFlagsService.isFeatureEnabled("newUI", USER_ID);
  // const exportCSV = await featureFlagsService.isFeatureEnabled("exportCSV", USER_ID);
  // const inlineResolve = await featureFlagsService.isFeatureEnabled("inlineResolve", USER_ID);
  // const deleteReport = await featureFlagsService.isFeatureEnabled("deleteReport", USER_ID);

  return (
    <div className="p-6">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-xl font-bold"> {newUI ? "🚗 Car Reports Dashboard" : "Car Damage Reports"}</h1>
        <div className="flex  gap-2 ml-auto">
          <Link href="/car-reports/new" className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Add Report
          </Link>
          {exportCSV && <button className="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Export CSV</button>}
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="min-w-full border border-gray-300">
          <thead className="bg-gray-300">
            <tr>
              <th className="border px-4 py-2 text-left">ID</th>
              <th className="border px-4 py-2 text-left">Reporter</th>
              <th className="border px-4 py-2 text-left">Car Model</th>
              <th className="border px-4 py-2 text-left">License Plate</th>
              <th className="border px-4 py-2 text-left">Damage Level</th>
              <th className="border px-4 py-2 text-left">Resolved</th>
              <th className="border px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            {reports.data.map((report: CarDamageReport) => (
              <tr key={report.id} className="hover:bg-gray-50">
                <td className="border px-4 py-2">{report.id}</td>
                <td className="border px-4 py-2">{report.reporter_name}</td>
                <td className="border px-4 py-2">{report.car_model}</td>
                <td className="border px-4 py-2">{report.license_plate}</td>
                <td className="border px-4 py-2 capitalize">{report.damage_level}</td>
                <td className="border px-4 py-2">{report.is_resolved ? <span className="text-green-600 font-medium">Yes</span> : <span className="text-red-600 font-medium">No</span>}</td>
                <td className="border px-4 py-2 space-x-2">
                  <Link href={`/car-reports/${report.id}/edit`} style={{ display: "inline-block" }} className="px-4 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    Edit
                  </Link>
                  {deleteReport && <DeleteButton id={report.id} />}
                </td>
              </tr>
            ))}

            {reports.data.length === 0 && (
              <tr>
                <td colSpan={7} className="text-center py-4 text-gray-500">
                  No reports found.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>

      <div className="flex justify-center mt-4 space-x-2">
        {Array.from({ length: reports.last_page }).map((_, i) => (
          <Link
            key={i}
            href={`/car-reports?page=${i + 1}`}
            className={`px-3 py-1 border rounded ${reports.current_page === i + 1 ? "bg-blue-600 text-white" : "bg-white text-gray-700 hover:bg-gray-100"}`}
          >
            {i + 1}
          </Link>
        ))}
      </div>

      {inlineResolve && <p className="text-sm text-gray-600 mt-4">✅ Inline resolve is enabled, you can mark reports as resolved directly.</p>}
    </div>
  );
}
