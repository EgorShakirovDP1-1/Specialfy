# Film Hunter (Beta)
Film Hunter is a new experience in online film watching industry. With that being said, Film Hunter offers you a large catalogue of movies, as much as you have ever wished.

  

### Used Technologies

  

- GitHub

- Bootstrap 5 (Bootswatch)

- Laravel 10

- Inertia

- Vue 3

  

### Test cases

  

- Test cases are in testcase.docx file

  

## Setup Instructions

  

### Prerequisites

- [PHP](https://www.php.net/) (>= 8.0)

- [Composer](https://getcomposer.org/)

- [Node.js](https://nodejs.org/) (>= 18.x)

- [NPM](https://www.npmjs.com/) (usually comes with Node.js)

  

### Steps to Setup



1.  **Clone the repository:**

  
  ```bash
  git clone https://github.com/EgorShakirovDP1-1/FH.git](https://github.com/EgorShakirovDP1-1/FH3--------.git
  ```


  

2.  **Navigate to the project directory:**

```bash

cd FH3--------

```

  

3.  **Install PHP dependencies:**

  

```bash

composer install

```

  

4.  **Install Node.js dependencies:**

  

```bash

npm install

```

  

5.  **Create a copy of the .env.example file and rename it to .env:**

  

```bash

cp .env.example .env

```

  

6.  **Generate an application key:**

  

```bash

php artisan key:generate

```

  

7.  **Run database migrations and seed (if needed):**

  

```bash

php artisan migrate:fresh && php  artisan  db:seed  --class=MainSeeder

```

  

8.  **Generate a symbolic link from "public/storage" to "storage/app/public":**

  

```bash

php artisan storage:link

```

  



  



  



  

9.  **Start the development server:**

  

```bash

php artisan serve

```

  



  

```bash

npm run dev

```

  

Your application will be available at `http://localhost:8000`.

  

10.  **Visit the application in your browser:**

  

Open your web browser and navigate to `http://localhost:8000`.

  

That's it! You should now have the project set up and running locally on your machine.
