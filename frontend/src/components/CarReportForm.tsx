"use client";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useEffect } from "react";

const schema = z.object({
  reporter_name: z.string().min(1, "Reporter name is required"),
  car_model: z.string().min(1, "Car model is required"),
  license_plate: z.string().min(1, "License plate is required"),
  description: z.string().min(1, "Description is required"),
  damage_level: z.enum(["minor", "moderate", "severe"]),
  is_resolved: z.boolean(),
});

export type CarReportFormData = z.infer<typeof schema>;

type CarReportFormProps = {
  defaultValues?: Partial<CarReportFormData>;
  onSubmit: (data: CarReportFormData) => Promise<void>;
  submitLabel?: string;
};

export function CarReportForm({ defaultValues, onSubmit, submitLabel = "Save" }: CarReportFormProps) {
  const {
    register,
    handleSubmit,
    reset,
    formState: { errors, isSubmitting },
  } = useForm<CarReportFormData>({
    resolver: zodResolver(schema),
    defaultValues: {
      reporter_name: "",
      car_model: "",
      license_plate: "",
      description: "",
      damage_level: "minor",
      is_resolved: false,
      ...defaultValues,
    },
  });

  useEffect(() => {
    if (defaultValues) {
      reset(defaultValues);
    }
  }, [defaultValues, reset]);

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
      <div>
        <input {...register("reporter_name")} placeholder="Reporter Name" className="w-full border p-2 rounded" />
        {errors.reporter_name && <p className="text-red-500 text-sm">{errors.reporter_name.message}</p>}
      </div>

      <div>
        <input {...register("car_model")} placeholder="Car Model" className="w-full border p-2 rounded" />
        {errors.car_model && <p className="text-red-500 text-sm">{errors.car_model.message}</p>}
      </div>

      <div>
        <input {...register("license_plate")} placeholder="License Plate" className="w-full border p-2 rounded" />
        {errors.license_plate && <p className="text-red-500 text-sm">{errors.license_plate.message}</p>}
      </div>

      <div>
        <textarea {...register("description")} placeholder="Description" className="w-full border p-2 rounded" />
        {errors.description && <p className="text-red-500 text-sm">{errors.description.message}</p>}
      </div>

      <div>
        <select {...register("damage_level")} className="w-full border p-2 rounded">
          <option value="minor">Minor</option>
          <option value="moderate">Moderate</option>
          <option value="severe">Severe</option>
        </select>
      </div>

      <label className="flex items-center space-x-2">
        <input type="checkbox" {...register("is_resolved")} />
        <span>Resolved</span>
      </label>

      <button type="submit" disabled={isSubmitting} className="w-full bg-blue-600 text-white py-2 rounded cursor-pointer disabled:opacity-50">
        {isSubmitting ? "Saving..." : submitLabel}
      </button>
    </form>
  );
}
