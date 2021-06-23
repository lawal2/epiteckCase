# Action REAction
Automation platform of his digital life

implementing a software suite that functions similar to that of IFTTT and/or Zapier.
This software suite will be broken into three parts

<li>An application server to implement all the features listed below(seeFeatures)</li>

<li>A web client to use the application from your browser by querying the application server </li>

<li>A mobile client to use the application from your phone by querying the application server </li>


## how to start: 

 ### <ol>update dependencies need php@8 ,php-pgsql</ol>
 
 composer update && composer install 
 
 ### <ol>update webpack </ol>
 
  yarn/npm install
  
  ### <ol>set up a database (need docker to be installed)</ol>
  
  docker-compose up -d
  
  ### <ol>migrate schema</ol>
  
  symfony or php bin/console doctrine:migrations:migrate
