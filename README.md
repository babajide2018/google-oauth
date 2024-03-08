Clone the repository

Install Dependencies:
composer install

Configure Google OAuth:
Obtain OAuth credentials from the Google Cloud Console and update the services file:

GOOGLE_CLIENT_ID=(specified in the project)
GOOGLE_CLIENT_SECRET=(specified in the project)
GOOGLE_REDIRECT_URI='/auth/google/callback'


Serve the Application:
php artisan serve --port=4000