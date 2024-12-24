# Restaurant Management System

Recipe and sales management system for restaurants.

## Requirements

- Apache ( or Xampp with Mysql and PHP )
- PHP >= 8.0
- Composer
- Laravel >= 9.0
- MySql ( SQLite optional )

## Installation

1. Clone the repository from terminal

gh repo clone angelnavas/restaurant-management
cd restaurant-management

# Postman
A POSTMAN collection has been included for easy use in the file:
postman/Restaurant Management.postman_collection.json

# Restaurant Management API
## Available endpoints:
### Recipes
- GET /api/recipes
- POST /api/recipes
- GET /api/recipes/analytics
### Products
- GET /api/products
- POST /api/products
### Sales
- POST /api/sales
- GET /api/sales/analytics

## TODO:
- Add cancellation and modification operations
- Improve documentation
- Add tests
- Add frontend for management