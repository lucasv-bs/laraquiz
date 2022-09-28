## LaraQuiz

This project was developed to practice Laravel, Heroku and AWS S3. Its goal is not to be a complete application, but a test case to apply some concepts and standards of application development and deployment.


## Project Demo

App deployed on: https://laraquizapp.herokuapp.com/

Login
- User: test@test.com
- Pass: test@123


## Steps to run this project
### Requirements

- PHP;
- Composer;
- NPM;


### Steps
1. Clone repository to local machine
    `git clone git@github.com:lucasv-bs/laraquiz.git`
2. Application Configuration
    - Acess the copied project folder on your local machine
    - Copy and paste the .env.example file in the project root folder. Then rename the duplicated file to ".env"
    - Set the database access values by filling all the "DB_*" variables
    - Set the AWS S3 access values by filling all the "AWS_*" variables.
        - If you don't want to use S3, leave the variables blank and fill the FILESYSTEM_DISK variable with "local"
3. Install Laravel and your dependencies
    - run the command `composer install`
4. Generate the app key
    - run the command `php artisan key:generate`
5. Execute the migrations
    - run the command `php artisan migrate`
        - If you want have test data, execute the database seeding `php artisan db:seed`
6. Install front-end dependencies
    - run the command `npm install`
7. Build front-end assets
    - run the command `npm run build`
8. Run the project
    - run the command `php artisan serve`


## Technologies

- Laravel
- Heroku
- AWS S3
- MySQL
- Bootstrap


## Help me keep improving

Found something I can fix or improve, please let me know sending a pull request