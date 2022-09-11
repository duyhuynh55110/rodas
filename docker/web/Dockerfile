FROM node:16 as base

# install vue/cli (best version for this app)
RUN npm install -g @vue/cli@5.0.4

# set work dir
WORKDIR /var/www/rodas-user

# COPY source
COPY ./resources/assets/user ./

# install packages
RUN npm install
