#!/bin/bash

source migration_site.config.sh


## cleanup
if [ $DO_CLEANUP == true ]
then
	echo "cleanup ..."
	rm -Rf tmp
fi


## preparing
mkdir -p tmp
cd tmp


## getting source
if [ $DO_IMPORT == true ]
then
	echo "getting source ..."
	echo "$SRC_SHELL_PASSWORD" > sshpass.txt
	
	if [ ! -z $SRC_DB_NAME ]
	then
		echo "getting source database ..."
		sshpass -f sshpass.txt ssh -oStrictHostKeyChecking=no $SRC_SHELL_USER@$SRC_SHELL_HOST "export MYSQL_PWD=$SRC_DB_PASSWORD && mysqldump $SRC_DB_NAME -u $SRC_DB_USER | lbzip2" | lbunzip2 > database.sql
	fi
	
	echo "getting source website ..."
	mkdir -p website
	if [ $USE_RSYNC == false ]
	then
		sshpass -f sshpass.txt ssh -oStrictHostKeyChecking=no $SRC_SHELL_USER@$SRC_SHELL_HOST "tar cf - -C $SRC_SHELL_DIRECTORY ./ | lbzip2" | lbunzip2 | tar x -C website
	else
		sshpass -f sshpass.txt rsync -zrlpt $SRC_SHELL_USER@$SRC_SHELL_HOST:$SRC_SHELL_DIRECTORY/ website/
	fi
	
	rm sshpass.txt
fi


## applying modifications to website
if [ $DO_MODIFICACTIONS == true ]
then
	echo "applying modifications to website ..."
	if [ ! -z $SRC_DB_NAME ]
	then
		grep -rl --include="*.php" $SRC_DB_NAME website | xargs sed -i "s|$SRC_DB_NAME|$DEST_DB_NAME|g"
		grep -rl --include="*.php" $SRC_DB_USER website | xargs sed -i "s|$SRC_DB_USER|$DEST_DB_USER|g"
		grep -rl --include="*.php" $SRC_DB_PASSWORD website | xargs sed -i "s|$SRC_DB_PASSWORD|$DEST_DB_PASSWORD|g"
	fi
	grep -rl --include="*.php" $SRC_URL_SCHEME://$SRC_URL_HOST/$SRC_URL_DIRECTORY/ website | xargs sed -i "s|$SRC_URL_SCHEME://$SRC_URL_HOST/$SRC_URL_DIRECTORY/|$DEST_URL_SCHEME://$DEST_URL_HOST/$DEST_URL_DIRECTORY/|g"
	
	if [ ! -z $SRC_DB_NAME ]
	then
		src=$SRC_URL_SCHEME://$SRC_URL_HOST
		if [ ! -z $SRC_URL_DIRECTORY ]
			then src=$src/$SRC_URL_DIRECTORY
		fi
		dest=$DEST_URL_SCHEME://$DEST_URL_HOST
		if [ ! -z $DEST_URL_DIRECTORY ]
			then dest=$dest/$DEST_URL_DIRECTORY
		fi
		sed -i "s|$src|$dest|g" database.sql
		
		src=$SRC_URL_HOST
		if [ ! -z $SRC_URL_DIRECTORY ]
			then src=$src/$SRC_URL_DIRECTORY
		fi
		dest=$DEST_URL_HOST
		if [ ! -z $DEST_URL_DIRECTORY ]
			then dest=$dest/$DEST_URL_DIRECTORY
		fi 
		sed -i "s|$src|$dest|g" database.sql
		
		if [ ! -z $SRC_URL_DIRECTORY ]
		then
			src=$SRC_URL_DIRECTORY/
			if [ ! -z $DEST_URL_DIRECTORY ]
			then
				dest=$DEST_URL_DIRECTORY/
			else
				dest=''
			fi
			sed -i "s|$src|$dest|g" database.sql
		fi
	fi
fi


## extra modifications
if [ $DO_EXTRA_MODIFICATIONS == true ]
then
	echo "doing extra modifications ..."
	../extra_modifications.sh
fi



## cleanup destination (tables and files) ??



## pushing destination
if [ $DO_EXPORT == true ]
then
	echo "pushing destination ..."
	echo "$DEST_SHELL_PASSWORD" > sshpass.txt
	
	if [ ! -z $SRC_DB_NAME ] && [ ! -z $DEST_DB_NAME ]
	then
		echo "pushing destination database ..."
		sshpass -f sshpass.txt ssh $DEST_SHELL_USER@$DEST_SHELL_HOST "printf \"[client]\npassword=$DEST_DB_PASSWORD\n\" > mysqlpass.txt"
		cat database.sql | lbzip2 | sshpass -f sshpass.txt ssh -oStrictHostKeyChecking=no $DEST_SHELL_USER@$DEST_SHELL_HOST "lbunzip2 | mysql --defaults-extra-file=mysqlpass.txt -u $DEST_DB_USER $DEST_DB_NAME"
		sshpass -f sshpass.txt ssh $DEST_SHELL_USER@$DEST_SHELL_HOST "rm mysqlpass.txt"
	fi
	
	
	
	echo "pushing destination website ..."
	sshpass -f sshpass.txt ssh -oStrictHostKeyChecking=no $DEST_SHELL_USER@$DEST_SHELL_HOST "mkdir -p $DEST_SHELL_DIRECTORY"
	
	if [ $USE_RSYNC == false ]
	then
		tar cf - -C website ./ | lbzip2 | sshpass -f sshpass.txt ssh -oStrictHostKeyChecking=no $DEST_SHELL_USER@$DEST_SHELL_HOST "lbunzip2 | tar x -C $DEST_SHELL_DIRECTORY"
	else
		sshpass -f sshpass.txt rsync -zrlpt website/ $DEST_SHELL_USER@$DEST_SHELL_HOST:$DEST_SHELL_DIRECTORY/
	fi
	
	rm sshpass.txt
fi


## ending
cd ..


## cleanup
if [ $DO_CLEANUP == true ]
then
	echo "cleanup ..."
	rm -Rf tmp
fi
