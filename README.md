# Personal Expense Tracker

A web application for tracking personal expenses built with Laravel, Laravel Breeze, and Tailwind CSS.

## Features

- User authentication and registration
- Dashboard with expense summary and statistics
- Add, edit, and delete expenses
- Add, edit, and delete categories
- Categorize expenses

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or PostgreSQL
- Git

## Installation

Follow these steps to get the application running on your local machine:

### 1. Clone the repository

```bash
git clone https://github.com/sksheikh/expense-tracker.git
cd expense-tracker
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install and compile frontend dependencies

```bash
npm install
npm run build
```

### 4. Set up environment variables

```bash
cp .env.example .env
```

Edit the `.env` file to configure your database connection:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense_tracker
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Run database migrations and seeders

```bash
php artisan migrate
php artisan db:seed
```

### 7. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage

1. Register a new account or login with the following demo credentials:
   - Email: admin@app.com
   - Password: password

2. Navigate to the dashboard to view your expense summary
   
3. Add new expenses using the "Add Expense" button

4. View and manage your expenses in the "Expenses" section

5. Generate reports in the "Reports" section

## Database Schema

The application uses the following main tables:

- `users` - Stores user authentication information
- `expenses` - Stores expense records
- `categories` - Stores expense categories

## Troubleshooting

### Common Issues

1. **Migration errors**: Make sure your database exists and credentials are correctly set in the `.env` file.

2. **Permission issues**: Ensure the `storage` and `bootstrap/cache` directories are writable:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

3. **Composer errors**: Make sure you have the correct PHP version installed:
   ```bash
   php -v
   ```

### Still Having Problems?

If you encounter any issues during installation or usage, please open an issue on GitHub with the following information:
- Error message
- Steps to reproduce
- PHP and Laravel versions
- Operating system

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request