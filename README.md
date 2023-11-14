# Laravel Project README

## Description

This is a Laravel framework project that serves as a starting point for building a web application. It includes basic authentication, a product management system, and a shopping cart functionality.

## Installation

Follow the steps below to set up the project:

1. Install dependencies using Composer:

    ```bash
    composer install
    ```

2. Copy the example environment file and configure your database credentials:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials.

3. Generate the application key:

    ```bash
    php artisan key:generate
    ```

4. Run database migrations:

    ```bash
    php artisan migrate
    ```

5. Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

## Endpoints List

1. **User Login:**
    - Endpoint: `yourlocal:8000/api/login`
    - Method: `POST`

2. **Add Product to Cart:**
    - Endpoint: `yourlocal:8000/api/addProductInCart/:product_id`
    - Method: `POST`

3. **Remove Product from Cart:**
    - Endpoint: `yourlocal:8000/api/removeProductFromCart/:product_id`
    - Method: `DELETE`

4. **Set Cart Product Quantity:**
    - Endpoint: `yourlocal:8000/api/setCartProductQuantity`
    - Method: `POST`
    - Body:
        ```json
        {
            "product_id": 5,
            "quantity": 5
        }
        ```

5. **Get User Cart:**
    - Endpoint: `yourlocal:8000/api/getUserCart`
    - Method: `GET`

## Usage

1. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

2. Access the API endpoints using a tool like Postman or your preferred API testing tool.

## Contributing

If you would like to contribute to this project, feel free to submit a pull request. Bug reports and feature requests are also welcome.

## Database Credentials

Ensure that you have provided the necessary database credentials in the `.env` file.

## License

This project is licensed under the [MIT License](LICENSE).
