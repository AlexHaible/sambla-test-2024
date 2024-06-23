# Sambla PHP Test

## Installation
- `git clone` the project into a folder of your choice.
- `cd` into the project folder.
- Run `composer install` to install the dependencies.
- Run `npm install && npm run build` to install the frontend dependencies and build the frontend assets.
- Create a `.env` file in the root of the project and copy the contents of the `.env.example` file into it.
- - Adjust for your local environment.

## Usage
This project is a simple PHP application that allows you to create, read, update and delete users. It uses a SQLite database to store the user data.
There's an included JSON file with some sample data that can be imported by using `php artisan import:json`

Beyond that, there's a webform that can be filled out to add more users to the database.

There's also access via an API to the user data. It can be accessed via the `/api/employees` endpoint.
