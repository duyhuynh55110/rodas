#!/bin/sh
WORKSPACE="/var/www/rodas-user"

cd $WORKSPACE

# Install app dependencies
npm install

# Run the CMD
exec "$@"

echo "install dependencies completed!!!"

# keep container don't exit code
tail -f /etc/issue
