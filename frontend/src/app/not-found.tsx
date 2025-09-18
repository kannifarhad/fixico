import Link from "next/link";

export default function NotFoundPage() {
  return (
    <div className="p-6 text-center">
      <h1 className="text-3xl font-bold mb-4">404 - Page Not Found</h1>
      <p className="text-gray-600">Sorry, the page you are looking for does not exist.</p>
      <Link href="/" className="text-blue-600 hover:underline mt-4 inline-block">
        Go back home
      </Link>
    </div>
  );
}
