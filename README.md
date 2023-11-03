## This project includes 3 docker containers 
    1. Database > db-spotrate
    2. Nginx > nginx-spotrate
    3. Php > php-app-spotrate

## Run the project 

   ##  Clone the project
      `git clone https://github.com/sachin56/Lead-Lanka.git`

   ## Run command   
      `docker compose up -d`

   ## Migarete table
   - Go to php container > docker exec -it php-app-spotrate sh
   - install composer > composer install
   - Migarte table > php artisan migrate
   - Running Seeders > php artisan db:seed

   ## If you want db backup add
   - please copy and paste the below command database Backup is in the folder
   # Restore
      `cat backup.sql | docker exec -i db-spotrate /usr/bin/mysql -u root --password=leadlanka#1234 spotrate`

   # Backup
      `docker exec CONTAINER /usr/bin/mysqldump -u root --password=root DATABASE > backup.sql` 

   - NOTE DATABASE WILL BE AUTOMATICLY CREATE WHEN DOCKER UP

   ## Container Down command   
      `docker compose down`   
      
   ## Change the .env file database credentials 
          DB_CONNECTION=mysql
          DB_HOST=db-spotrate
          DB_PORT=3306
          DB_DATABASE=spotrate
          DB_USERNAME=root
          DB_PASSWORD=exam
          
   ## Once Container is getting up run the following commands 

       docker exec -it php-app-spotrate sh  ----> it can go to inside container
       docker exec -it db-spotrate sh  ----> it can go to inside container




   
