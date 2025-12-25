# Products CRUD API (Produts_CRUD)

A small Laravel-based RESTful API for managing **Categories** and **Products**. It demonstrates standard CRUD operations, request validation, API resources, soft deletes, and seeders for sample data.

---

## ✅ Key Features

-   Full CRUD API for Products and Categories (resourceful controllers)
-   Request validation and clear JSON error responses
-   API Resources that shape the response payloads
-   Soft delete support on models
-   Factory-based seeders for quick local data

---

## 🧰 Tech Stack & Requirements

-   PHP ^8.1
-   Laravel ^10
-   Composer
-   Node.js & npm (for frontend assets if needed)
-   A supported database (MySQL, SQLite, PostgreSQL, etc.)

---

## 🚀 Quick Start (Windows)

1. Clone the repo and enter the project:

    ```bash
    git clone <repo-url>
    cd Produts_CRUD
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JS dependencies (optional if you need to build assets):

    ```bash
    npm install
    npm run dev   # or npm run build for production
    ```

4. Copy and configure environment file:

    ```bash
    copy .env.example .env
    php artisan key:generate
    ```

    Update `.env` values (DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD) for your local database.

5. Run migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

6. Serve the app locally:

    ```bash
    php artisan serve
    ```

    The API will be available at http://127.0.0.1:8000

---

## 📚 API Endpoints

This project exposes two main resource endpoints under `/api`:

Categories

-   GET /api/categories — list all categories
-   GET /api/categories/{id} — get a single category
-   POST /api/categories — create a category
    -   body: { name: string, description: string }
-   PUT|PATCH /api/categories/{id} — update a category
-   DELETE /api/categories/{id} — delete a category (returns 403 if category contains products)

Products

-   GET /api/products — list all products
-   GET /api/products/{id} — get a single product
-   POST /api/products — create a product
    -   body: { name: string, price: number, is_available: boolean, category_id: integer }
-   PUT|PATCH /api/products/{id} — update a product
-   DELETE /api/products/{id} — delete a product

All endpoints return JSON. Standard validation errors return a 400 with an `errors` object.

---

## 🔍 Example Requests

Create a category:

```bash
curl -X POST http://127.0.0.1:8000/api/categories \
  -H "Content-Type: application/json" \
  -d '{"name":"Electronics","description":"Devices and gadgets"}'
```

Create a product:

```bash
curl -X POST http://127.0.0.1:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"Headphones","price":59.99,"is_available":true,"category_id":1}'
```

Example JSON response for a product (created/updated):

```json
{
    "message": "Product created",
    "status": 201,
    "data": {
        "id": 1,
        "name": "Headphones",
        "price": 59.99,
        "is_available": true,
        "category": "Electronics",
        "created_at": "2025-12-25 12:00"
    }
}
```

---

## 🧪 Running Tests

Run the automated tests with PHPUnit / Artisan test runner:

```bash
php artisan test
# or
vendor/bin/phpunit
```

---

## ⚙️ Notes & Implementation Details

-   Models use SoftDeletes; deleted records are not removed from the database.
-   `CategoryController::destroy` prevents deleting categories that still have products (returns 403).
-   API responses are shaped with `CategoryResource` and `ProductResource`.
-   Seeders and factories are provided to generate sample data quickly.

---

## 🤝 Contributing

Contributions are welcome. If you plan to make changes:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Make your changes and add tests
4. Open a pull request with a clear description

Please follow PSR standards and include tests for new functionality.

---

## 📄 License

This project is licensed under the MIT License.

---

If you want, I can add example Postman collections or automated API documentation (OpenAPI) next. 👋
