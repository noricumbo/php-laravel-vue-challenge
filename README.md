## About this repository

This project was made as part of a technical challenge using PHP, Laravel, PostgreSQL, Inertia, Vue3 and Pinia.

It's a User manager application with Teams organization tool.

Once installed, migrated and seeded, you can manage a users list, modify and create them. 

You can add Users as Team members with a multi-step and dynamic form.

This application uses Pinia to store User information from the beginning. 

If you uncomment a prompt on the resources/js/Shared/Layout.vue template it's going to ask for your name, store it with Pinia and it's going to be available throughout your visit.

As it is an SPA, once you refresh the browser, Pinia storage is going to be restored and the prompt will ask again for your name. 
This prompt is originally commented becuase it could be a bit anoying during the review and debugging process.

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

Both models have it's own Resources managing information passed to the Frontend.

User creation and updates are handled through Inertia/Vue requests without a page refresh.

Team updates are handled also through a single Inertia/Vue request affecting two tables at the same time: Users and Teams.

	- On the User table it adds a team_id as a foreign key value.
	- On the Teams table it can modify Team's name and color (hexadecimal value).

## Tech Stack

Laravel 10
Inertia.js 1
Vue.js 3
PostgreSQL 15
Pinia 3
Pest 2

## Installation instructions

