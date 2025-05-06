## About this repository

This project was made as part of a technical challenge using PHP, Laravel, PostgreSQL, Inertia, Vue3 and Pinia.

It's a User manager application with Teams organization tool.

Once installed, migrated and seeded, you can manage a users list, modify and create them. 

You can add Users as Team members with a multi-step and dynamic form.

This application uses Pinia to store User information from the beginning. 

If you uncomment a prompt on the resources/js/Shared/Layout.vue template it's going to ask for your name, store it with Pinia, and it's going to be available throughout your visit.

As it is an SPA, once you refresh the browser, Pinia storage is going to be restored and the prompt will ask again for your name. 
This prompt is originally commented because it could be a bit annoying during the review and debugging process.

## First task of the challenge

The **Users section** completes the first task of the challenge. It lets you: 

	- Filter Users dynamically by Name, Email and User ID
	- Sort table information by User ID, Name, Email and Creation date columns
	- It's paginated by 10 items per page using Laravel pagination through Inertia/Vue rendering

## Second task of the challenge

The **Teams section** completes the second task of the challenge. It lets you:

	- Manage Teams information with a multi-step form
	- Each Team can have a name, a color and members
	- Each member (user) can be related just to one Team
	- Add members to a Team dynamically searching for them by name

Each time you edit Team information it's being gathered and stored using Pinia.

At the final step all information related with the Team modified goes to Laravel backend.

## Backend details

From Laravel point of vue this application extends the original User Model and build a related Team Model.

Both models have its own Resources managing information passed to the Frontend.

User creation and updates are handled through Inertia/Vue requests without a page refresh.

Team updates are handled also through a single Inertia/Vue request affecting two tables at the same time: Users and Teams.

	- On the User table it adds a team_id as a foreign key value.
	- On the Teams table it can modify Team's name and color (hexadecimal value).

## Tech Stack

	- Laravel 10
	- Inertia.js 1
	- Vue.js 3
	- PostgreSQL 15
	- Pinia 3
	- Pest 2

## Installation requirements

	- Git updated version installed on your machine
	- Composer updated version installed on your machine
	- Node and npm updated versions installed on your machine
	- PostgreSQL 15 (preferably, but it also should work with SQLite) installed on your machine

## Installation instructions

1. Clone this repository

2. Enter the new directory:

        cd php-laravel-vue-challenge

3. Execute: 

        composer install

4. Execute:

        cp .env.example .env

5. Execute:

        php artisan key:generate

6. Create database in your PostgreSQL installation. Take note of the name access information.

7. Open and identify this .env file section:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=

8. Modify the .env file section as this:

        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=your_database_name
        DB_USERNAME=postgres_user_owner_of_the_database
        DB_PASSWORD=postgres_user_password

This is going to work in a normal installation of PostgreSQL. If you modified your default host, port, username or password you need to fill that information accordingly on the Laravel .env file. 

**IMPORTANT:** The database needs to be empty and the owner needs to have all privileges associated with it.

9. Execute:

        php artisan migrate --seed

10. Execute: 

        npm install

11. Execute:

        php artisan test

Both tests need to pass.

12. Inside the project directory run PHP/Laravel server in one terminal window: 

        php artisan serve

13. Inside the project directory run Node server in a second terminal window: 

        npm run dev

14. Access http://127.0.0.1:8000 on your web browser

## Happy Paths to test

### Happy Path 01

1. Enter the Users section and create a new user
2. Search for the new user using the name filter
3. Search for this or other users changing to the email filter
4. Search for this or other users changing to the user id filter
5. Sort table information by columns User ID, Name, Email, Created at

### Happy Path 02

1. Enter the Teams section
2. View one Team details
3. Edit Team details
4. Modify Team's name
5. Modify Team's color
6. Continue
7. Search for users to add as Team members
8. Click on a user name and add it to the Team
9. Remove users from team clicking on the list below
10. Save Team information
11. Verify if new Team's information correspond to what you modified

That's all. I hope we can have the opportunity to review this together.

Thanks for your time.

nori (: