##TO INSTALL THIS CMS

JUST OPEN THE INDEX PAGE

IF IT DETECTS THAT YOU HAVE NOT INSTALL IT YU WILL BE REDIRECTED TO CREATE AN ACCOUNT

TO MODIFY THE DATABASE INFORMATIONS

OPEN THE THE FILE conf.json inside the admin/includes/ folder

#inside the `database` 
modify the 
#name of your database,an all the rest to your preference an 

set user_registert to false
and already_created to false

"database": {
        "name": "you_data_base_name",
        "user": "user_name",
        "pswd": "",
        "host": "host"
}