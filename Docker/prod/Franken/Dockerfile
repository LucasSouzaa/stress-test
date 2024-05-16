FROM dunglas/frankenphp

# Be sure to replace "your-domain-name.example.com" by your domain name
ENV SERVER_NAME=ec2-15-228-157-54.sa-east-1.compute.amazonaws.com
# If you want to disable HTTPS, use this value instead:
#ENV SERVER_NAME=:80

# Enable PHP production settings
RUN mv "Docker/prod/php.ini" "$PHP_INI_DIR/php.ini"

# Copy the PHP files of your project in the public directory
COPY . /app/public
# If you use Symfony or Laravel, you need to copy the whole project instead:
#COPY . /app
