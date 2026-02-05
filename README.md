# LocalGoCommerce

**LocalGoCommerce** is a modern, full-stack E-commerce application built with **Laravel 10** and **Livewire 3**. It features a comprehensive admin dashboard, product management, user authentication, and a responsive shopping experience.

## 🚀 Features

-   **User Authentication**: Secure login and registration system.
-   **Admin Dashboard**: Dedicated area for administrators to manage the store.
-   **Product Management**: CRUD operations for products and categories.
-   **Wishlist**: Real-time wishlist functionality using Livewire.
-   **Responsive Design**: Optimized for both desktop and mobile devices.
-   **Social Login**: Integration with social platforms (via Laravel Socialite).
-   **Contact Form**: Integrated contact messaging system.

## 🛠️ Tech Stack

-   **Backend**: Laravel 10 (PHP 8.1+)
-   **Frontend**: Blade Templates, Livewire 3
-   **Database**: MySQL
-   **Styling**: Tailwind CSS (via Vite)

## 📦 Installation

Follow these steps to set up the project locally:

1.  **Clone the repository**
    ```bash
    git clone https://github.com/Rahmat-dkh/localgocommerce.git
    cd localgocommerce
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
    Then configure your database credentials in the `.env` file.

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations & Seeders**
    ```bash
    php artisan migrate --seed
    ```

6.  **Run the Application**
    Start the local development server:
    ```bash
    npm run dev
    php artisan serve
    ```

    Visit `http://127.0.0.1:8000` in your browser.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
