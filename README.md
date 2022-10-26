# Final Year Project

A brief description of what this project does and who it's for

To make the project work

1. Install Composer (v2)
2. Run command composer install 
3. make sure the database is connected (Credentials to be input in generated-conf/config.php)
4. For mock data do the following
    // BEFORE YOU DO ANYTHING 
    // THE MOCK DATA MUST BE DONE IN A SPECIFIC ORDER
    // FIRST -> .\vendor\bin\propel sql:insert
    // SECOND -> /mock/user
    // THIRD -> /mock/product
    // LAST -> /mock/purchase


    //Note due to client not being able to submit her product images files on time to be uploaded on web application, i have unfortuantely had to use faksestoreapi for visual purpose. Apologies for random images on the website. If i however do manage to secure files then these will be uploaded to production.