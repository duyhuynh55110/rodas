FROM node:16 as base

# set work dir
WORKDIR /var/www/rodas-user

# COPY source
COPY ./package*.json ./

# install packages
RUN npm install

# install vue/cli (best version for this app)
RUN npm install -g @vue/cli@5.0.4
