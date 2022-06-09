<?php

$user = "CREATE TABLE IF NOT EXISTS users(
        id int not null AUTO_INCREMENT,
        `login` varchar(60) not null unique,
        `password` varchar(255) not null,
        `email` varchar(100) not null unique,
        `registered` datetime not null default CURRENT_TIMESTAMP,
        primary key(id)
    )";

$region = "CREATE TABLE IF NOT EXISTS regions(
        id int not null AUTO_INCREMENT,
        nom varchar(30) not null unique,
        primary key(id)
    )";

$departement = "CREATE TABLE IF NOT EXISTS departements(
        id int not null AUTO_INCREMENT,
        id_region int,
        nom varchar(30) not null unique,
        primary key(id),
        foreign key (id_region) references regions(id)
    )";

$arrondissement = "CREATE TABLE IF NOT EXISTS arrondissements(
        id int not null AUTO_INCREMENT,
        id_departement int not null,
        nom varchar(30) not null unique,
        primary key(id)
        -- foreign key (id_departement) references departements(id)
    )
    ";

$marie = "CREATE TABLE IF NOT EXISTS maries(
        id int not null AUTO_INCREMENT,
        nom varchar(60) not null,
        id_region int,
        id_departement int,
        id_arrondissement int,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key (id_region) references regions(id),
        foreign key(id_departement) references departements(id),
        foreign key(id_arrondissement) references arrondissements(id)

    )";

$histoire = "CREATE TABLE IF NOT EXISTS histoires(
        id int not null AUTO_INCREMENT,
        content text not null,
        id_marie int,   
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$conseil_municipal = "CREATE TABLE IF NOT EXISTS conseil_municipal(
        id int not null AUTO_INCREMENT,
        id_marie int,
        primary key(id),
        created datetime not null default CURRENT_TIMESTAMP,
        foreign key(id_marie) references maries(id)
    )";

$personnel_marie = "CREATE TABLE IF NOT EXISTS personnel(
        id int not null AUTO_INCREMENT,
        nom varchar(40) not null,
        parcours text not null,
        poste varchar(40),
        cv varchar(255),
        photo varchar(255),
        id_marie int not null,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$mission = "CREATE TABLE IF NOT EXISTS missions(
        id int not null AUTO_INCREMENT,
        content text not null,
        id_marie int not null,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";


$projet = "CREATE TABLE IF NOT EXISTS projets(
        id int not null AUTO_INCREMENT,
        nom varchar(50),
        `image` varchar(40),
        content text not null,
        id_marie int not null,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$activity = "CREATE TABLE IF NOT EXISTS activity(
        id int not null AUTO_INCREMENT,
        nom varchar(50),
        `image` varchar(50),
        content text not null,
        id_marie int not null,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$annonce = "CREATE TABLE IF NOT EXISTS annonce(
        id int not null AUTO_INCREMENT,
        `type` varchar(30) not null,
        nom varchar(30) not null,
        content text not null,
        `image` varchar(255),
        id_marie int not null, 
        created datetime not null default CURRENT_TIMESTAMP,

        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$lieux = "CREATE TABLE IF NOT EXISTS lieu_touristic(
        id int not null AUTO_INCREMENT,
        nom varchar(255) not null,
        `image` varchar(255) not null,
        `description` text not null,  
        id_marie int not null,
        created datetime not null default CURRENT_TIMESTAMP,
        primary key(id),
        foreign key(id_marie) references maries(id)
    )";

$pub = "CREATE TABLE IF NOT EXISTS pubs(
        id int not null AUTO_INCREMENT,
        title varchar(255) not null,
        content text not null,
        `image` varchar(255) not null,
        visitors int default 0, 
        id_marie int not null,
        primary key(id),
        created datetime not null default CURRENT_TIMESTAMP,
        foreign key(id_marie) references maries(id)
    )";


$tables[] = $user;
$tables[] = $region;
$tables[] = $departement;
$tables[] = $arrondissement;
$tables[] = $marie;
$tables[] = $histoire;
$tables[] = $conseil_municipal;
$tables[] = $personnel_marie;
$tables[] = $mission;
$tables[] = $projet;
$tables[] = $activity;
$tables[] = $annonce;
$tables[] = $lieux;
$tables[] = $pub;



