FROM php:8.2-cli

# Copy the PHP file into the container
COPY plate-lookup.php /usr/src/myapp/
WORKDIR /usr/src/myapp/

# Run PHP's built-in web server on port 80
CMD ["php", "-S", "0.0.0.0:80", "plate-lookup.php"]
