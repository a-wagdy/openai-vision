OpenAI Vision

# Description

Using the OpenAI API to upload an image from your computer and ask "What’s in this image".
Ref: [Vision API](https://platform.openai.com/docs/guides/vision/uploading-base-64-encoded-images)

# Tech Stack

- PHP 8.2
- Laravel 11
- Filament 3.2
- MySQL 8
- Nginx
- Redis
- Docker

# Installation

> Make sure to have Docker and docker-compose installed.

1. Clone the repo.
2. Navigate to the app's directory
3. Build the image by running `docker-compose build`. This will take a few minutes.
4. Then run `docker-compose up -d`.
5. And then `docker-compose exec vision composer install`
6. Please generate new [API key](https://www.alphavantage.co/support/#api-key) and place it as the value of `OPENAI_SECRET_KEY` in the `.env` file. 
7. Then execute `docker-compose exec task php artisan config:clear`

To make sure that the image is working, please open your browser and navigate to `http://127.0.0.1:8060/`.

# Upon successful installation

### Run the following commands

1. `docker-compose exec vision php artisan migrate`
2. `docker-compose exec vision php artisan queue:listen`
3. Create a new user `docker-compose exec vision php artisan make:filament-user`

# Identifying an image

1. Navigate to /admin/vision
2. Upload an image, click save, and wait till the background process is finished.
3. Refresh the current page to see the response.
