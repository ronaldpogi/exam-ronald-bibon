# Laravel Back-End Setup

## 🚀 Steps to Run the Back-End

1. Install dependencies:
   ```bash
   composer install
   ```

2. Run migrations:
   ```bash
   php artisan migrate
   ```

3. Seed the database:
   ```bash
   php artisan db:seed
   ```

---

## 👤 Default Accounts

- **Manager**
  - Username: `manager`
  - Password: `password`

- **Developer**
  - Username: `developer`
  - Password: `password`

- **Designer**
  - Username: `designer`
  - Password: `password`

---

## 🐳 Using Docker

Build and start the containers:
```bash
docker-compose up -d --build
```

---

## 🧪 Testing with Postman

For faster API testing, you can import the provided Postman collection:  
`Back-End.postman_collection.json`
