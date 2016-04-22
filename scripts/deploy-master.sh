#!/bin/sh
#
# Deploy to production server

# Run tests and build script
#grunt deploy
composer install --no-dev --no-interaction

# Set var
TIMESTAMP=$(date +%Y%m%d%H%M%S)

# Make a new releases folder
ssh $USERNAME@$HOST "mkdir $DEPLOY_TO/releases/$TIMESTAMP"

# Copy files
rsync -avz -e "ssh" --exclude="app/themes/ctba-2016/node_modules" ./html/ $USERNAME@$HOST:$DEPLOY_TO/releases/$TIMESTAMP

# Symlink shared folders
ssh $USERNAME@$HOST "cd $DEPLOY_TO/releases/$TIMESTAMP/app/;ln -s $SHARED/media $CURRENT/media"
ssh $USERNAME@$HOST "cd $DEPLOY_TO/releases/$TIMESTAMP/app/;ln -s $SHARED/languages $CURRENT/languages"

## Symlink previous events
ssh $USERNAME@$HOST "ln -s $DEPLOY_TO/2012/ $CURRENT/2012"
ssh $USERNAME@$HOST "ln -s $DEPLOY_TO/2013/ $CURRENT/2013"
ssh $USERNAME@$HOST "ln -s $DEPLOY_TO/2014/ $CURRENT/2014"
ssh $USERNAME@$HOST "ln -s $DEPLOY_TO/2015/ $DEPLOY_TO/releases/$TIMESTAMP/2015/"

# Update app version
#ssh $USERNAME@$HOST "rm -rf $CURRENT;ln -s $DEPLOY_TO/releases/$TIMESTAMP/ $CURRENT"
