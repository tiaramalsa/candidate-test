# CLT Toolbox Feature Test

A Laravel-based backend management system for handling Suppliers, CLT Layups, and CLT Layers.

This project was built as part of the CLT Toolbox Feature Test Assignment.

---

# Features

## Authentication
- Login
- Register

## Supplier Management
- Create Supplier
- Update Supplier
- Delete Supplier
- Supplier Detail Page
- Export Supplier
- Import Supplier

## CLT Layup Management
- Create Layup
- Update Layup
- Delete Layup

## CLT Layer Management
- Create Layer
- Update Layer
- Delete Layer

## Nested Hierarchy
The application follows the required structure:

Supplier-Layup-Layer

## Import / Export JSON

### Export
- Export supplier data as JSON
- Includes:
    - Supplier
    - Related Layups
    - Related Layers

### Import
- Import supplier JSON data
- Automatically creates or updates:
    - Layups
    - Layers

## Conflict Resolution
When duplicate data is detected during import:

### Update Existing Data
Existing records are updated using imported data.

### Keep Current Data
Existing records remain unchanged and duplicate imported data is ignored.

### Import Summary
After import, the system displays:
- New data created
- Existing data updated
- Duplicate data skipped

---

# Tech Stack

- Laravel 12
- PHP 8+
- MySQL
- Tailwind CSS
- Blade Template

---

# Installation

Clone repository:

```bash
git clone https://github.com/tiaramalsa/candidate-test.git
```

Go to project directory:

```bash
cd candidate-test
```

Install dependencies:

```bash
composer install
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database in `.env`

Run migration:

```bash
php artisan migrate
```

Run development server:

```bash
php artisan serve
```

Run Vite:

```bash
npm run dev
```

---

# Import JSON Example

```json
{
  "name": "Supplier Import",
  "email": "import@test.com",
  "phone": "08123456789",
  "address": "Jakarta",
  "layups": [
    {
      "name": "Layup A",
      "description": "First Layup",
      "layers": [
        {
          "layer_order": 1,
          "thickness": 10,
          "width": 20,
          "angle": 45
        }
      ]
    }
  ]
}
```

---

# Application Pages

- Dashboard
- Suppliers
- Supplier Detail
- Layups
- Layers
- Import JSON

---

# Demo Features

The demo includes:
- CRUD functionality
- Detail Supplier Include Layup and Layer
- JSON export
- JSON import
- Duplicate data handling
- Conflict resolution summary
