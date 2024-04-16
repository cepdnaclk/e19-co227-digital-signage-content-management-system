# Use the official PHP image with Apache
FROM php:7.4-apache

# Set the working directory in the container to /var/www/html
WORKDIR /var/www/html

# Copy your PHP application files into the container
COPY frontend/ .  
COPY backend/ .   

# Grant permissions for all content (optional, adjust as needed)
RUN chown -R www-data:www-data .

# Expose port 80 to allow HTTP traffic into the container
EXPOSE 80
