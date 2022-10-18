# TO INSTALL THIS CMS

JUST OPEN THE INDEX PAGE

IF IT DETECTS THAT YOU HAVE NOT INSTALL IT YU WILL BE REDIRECTED TO THE INSTALLATION PAGE 
TO CONFIGURE THE DATABASE INFORMATION AND LATER CREATE AN ACCOUNT
CREATE AN ACCOUNT

## TO MODIFY THE DATABASE INFORMATIONS MANUALLY

OPEN THE THE FILE conf.json inside the admin/includes/ folder( `CMS_MARIE/admin/includes/conf.json` )

## inside the json file

set `user_register` to `false`

```json
{
    ...,
    "user_register":false,
    ....,
}
```

and `already_created` to `false`
this is 
```json
{
    ...,
    "already_created":false,
    ....,
}
```

modify the `name` of your database,an all the rest to your preference an make sure it is a `mysql database` 

```json
{
   ...,
   "database": {
        "name": "you_data_base_name",
        "user": "user_name",
        "pswd": "",
        "host": "host"
   },
   ...,
}
```


at the end it must look like

```json
{
   "database":{
        "name":"",
        "user":"",
        "pswd":"",
        "host":""
   },
   "already_created":false,
   "user_register":false,
   "website":{
        "name":""
    }
    
}
```
