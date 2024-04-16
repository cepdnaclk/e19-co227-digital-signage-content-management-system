@echo off
REM Build the Docker image
docker build -t my-php-app:latest .

REM Run the Docker container
docker run -d -p 8000:80 my-php-app:latest

REM Display the sucess message
echo Apache server with PHP application is now running on port 8000 locally and port 80 internaly(container)!
