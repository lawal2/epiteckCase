# Action REAction
Automation platform of his digital life

implementing a software suite that functions similar to that of IFTTT and/or Zapier.
This software suite will be broken into three parts
-
Anapplication server to implement all the features listed below(seeFeatures)
-
A web client to use the application from your browser by querying the application server 
-
A mobile client to use the application from your phone by querying the application server


# how to start: 

 ## -update dependencies need php@8 ,php-pgsql
 
 composer update && composer install 
 
 ## -update webpack
 
  yarn/npm install
  
  ## -set up a database (need docker to be installed)
  
  docker-compose up -d
  
  ## -migrate schema
  
  symfony or php bin/console doctrine:migrations:migrate
