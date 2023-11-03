# Exam
   - Starting time: 
   - Completed time: 

## This project includes 3 docker containers 
    1. Database > db-exam
    2. Nginx > nginx-exam
    3. Php > php-app-exam
## Run the project 

   ##  Clone the project and  run command 
      `docker compose up -d`
      
   ## Change the .env file database credentials 
          DB_CONNECTION=mysql
          DB_HOST=db-exam
          DB_PORT=3306
          DB_DATABASE=exam
          DB_USERNAME=root
          DB_PASSWORD=mheladmin#1234
          
   ## Once Container is getting up run the following commands 
       docker exec -it php-app-exam sh  ----> it can go to inside container
       docker exec -it db-exam sh  ----> it can go to inside container


   
