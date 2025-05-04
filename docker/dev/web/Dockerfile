FROM node:18-alpine

# Set working directory
WORKDIR /var/www/user

# Copy all source files
COPY ./resources/assets/user /var/www/user

# Install dependencies
RUN npm install

EXPOSE 8080
