FROM node:18-alpine

# Set working directory
WORKDIR /var/www/html

# Copy all source files
COPY ./resources/assets/user /var/www/html

# Install dependencies
RUN npm install

EXPOSE 8080
