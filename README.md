# Feature Flags Task

## Feature Flags Implementation

The project includes **4 feature flags** that demonstrate different use cases:

1. **newUI** – Sets a new title for the page.

   - This flag also supports **percentage-based rollout**.
   - Currently, the user ID is set manually because session management is not implemented yet.
   - The feature is considered enabled if the _last two digits of the user ID_ are less than the rollout percentage (e.g., `< 30` for 30%).
     - Examples:
       - User ID `12`, `312`, `322` → **Enabled**
       - User ID `42`, `155` → **Disabled**

2. **exportCSV** – Shows and hides the **Export button**.

   - The button is only displayed when the flag is enabled.
   - Clicking it currently does not perform any action (placeholder).

3. **inlineResolve** – Adds an inline block under the table.

4. **deleteReport** – Controls whether the **Delete button** is available.
   - If disabled, the button is hidden.
   - If the frontend cached the flag as enabled but it has been disabled in the admin panel, clicking it will **not delete anything**.
   - This ensures **backend validation** of feature flag state, preventing actions when the flag is off.

### Notes

- All feature flags can be controlled via the **Admin Panel** (`http://localhost:8000/admin`).
- The backend always validates feature flag state before executing actions, so the system is safe even if frontend flags are cached or outdated.

## Backend (Laravel)

This project is a backend implementation for managing feature flags.  
The goal was to demonstrate clean architecture and modularity while keeping setup and review simple.

## Architecture

- **Framework**: Built with **Laravel**.
- **Modularity**:
  - Implemented a modular approach by organizing features (e.g., `FeatureFlags`, `CarDamageReports`) into separate directories.
  - This segregation keeps features independent and easier to maintain.
  - If more time was available, I would have used a Laravel module plugin (e.g., `nwidart/laravel-modules`) to reduce boilerplate and enforce modular architecture more strictly.
- **Database**:
  - **SQLite** is used to simplify setup for the reviewer.
  - No external DB configuration required; the app is ready to run after migrations.
  - **Seeding** is included for feature flags to provide initial data for testing and review.
- **API Documentation**:
  - Implemented **Swagger** documentation.
  - This allows future integration with code generation tools (e.g., `openapi-generator`, `swagger-codegen`) to generate frontend types and clients automatically.

## Features

- **Feature Flags**
  - CRUD operations via web interface (admin panel).
  - API endpoints to fetch flags and their rules.
  - Pre-seeded data for quick testing.
- **Car Damage Reports**
  - Example secondary module to demonstrate modularity.

## URLs

- **Admin Panel**: [http://localhost:8000/admin](http://localhost:8000/admin)
  - Used for managing feature flags.
- **Swagger Docs**: [http://localhost:8000/docs](http://localhost:8000/docs)
  - Interactive API documentation.
- **API Endpoints**: [http://localhost:8000/api](http://localhost:8000/api)

## Setup

1. Clone the repository.
2. Install dependencies:

   ```bash
   composer install
   ```

3. Set ENV file and generate a new APP key:

   ```bash
      # Copy the example env file to .env
      cp env.local .env

      # Generate a new application key
      php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate
   ```
5. Seed the database (to insert example feature flags):
   ```bash
   php artisan db:seed
   ```
6. Start the server
   ```bash
   php artisan serve
   ```

## Frontend Overview

The frontend is built with **Next.js**.

### Architecture

- Uses Next.js internal data fetching and routing mechanisms.
- Forms are handled with **react-hook-form** for flexible validation and state management.
- Styling is done with **Tailwind CSS** to keep UI consistent and fast to build.

### Features

- Example page for **Car Reports** is available at:  
  [http://localhost:3000/car-reports](http://localhost:3000/car-reports)
- The page fetches data from the Laravel backend API, demonstrating fullstack integration.

### Setup

1. Navigate to the frontend folder.
2. Install dependencies:

   ```bash
   npm install
   ```

3. Start the development server:

   ```bash
   npm run dev
   ```
