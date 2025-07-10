-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Thu Jul 10 06:55:52 2025 
-- * LUN file: E:\Development\01-Github\Repositories\others\MiniPrograms\01-Documents\Database\OctopathTravelerManager\OctopathTravelerManager.lun 
-- * Schema: OctopathTravelerManager/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database OctopathTravelerManager;
use OctopathTravelerManager;


-- Tables Section
-- _____________ 

create table characters (
     id_character int not null auto_increment,
     name varchar(100) not null,
     level int not null,
     description TEXT not null,
     image varchar(255) not null,
     backgroundImage varchar(255) not null,
     fk_game int not null,
     fk_class int not null,
     fk_secondaryClass int,
     constraint ID_characters_ID primary key (id_character));

create table abilities (
     id_ability int not null auto_increment,
     name varchar(100) not null,
     description TEXT not null,
     spCost int not null,
     image varchar(255) not null,
     fk_abilityType int not null,
     fk_element int not null,
     fk_class int not null,
     constraint ID_abilities_ID primary key (id_ability));

create table items (
     id_item int not null auto_increment,
     name varchar(100) not null,
     nbItems int not null,
     image varchar(255) not null,
     constraint ID_items_ID primary key (id_item));

create table weapons (
     id_item int not null,
     constraint FKite_wea_ID primary key (id_item));

create table armors (
     id_item int not null,
     constraint FKite_arm_ID primary key (id_item));

create table accessories (
     id_item int not null,
     constraint FKite_acc_ID primary key (id_item));

create table classes (
     id_class int not null auto_increment,
     name varchar(100) not null,
     description varchar(1000) default 'TEXT' not null,
     image varchar(255) not null,
     constraint ID_classes_ID primary key (id_class));

create table places (
     id_place char(1) not null,
     name varchar(100) not null,
     image varchar(255) not null,
     constraint ID_places_ID primary key (id_place));

create table game (
     id_game int not null auto_increment,
     name varchar(100) not null,
     image varchar(255) not null,
     constraint ID_game_ID primary key (id_game));

create table abilityTypes (
     id_abilityType int not null auto_increment,
     name varchar(100) not null,
     constraint ID_abilityTypes_ID primary key (id_abilityType));

create table passiveAbilities (
     id_ability int not null,
     constraint FKabi_pas_ID primary key (id_ability));

create table activeAbilities (
     id_ability int not null,
     constraint FKabi_act_ID primary key (id_ability));

create table divineAbilities (
     id_ability int not null,
     constraint FKabi_div_ID primary key (id_ability));

create table shops (
     id_shop int not null auto_increment,
     name char(1) not null,
     image varchar(255) not null,
     fk_place char(1) not null,
     constraint ID_shops_ID primary key (id_shop));

create table characteristics (
     id_characteristic int not null auto_increment,
     name varchar(100) not null,
     image varchar(255) not null,
     constraint ID_characteristics_ID primary key (id_characteristic));

create table elements (
     id_element int not null auto_increment,
     name varchar(100) not null,
     image varchar(255) not null,
     constraint ID_elements_ID primary key (id_element));

create table baseAbilities (
     id_ability int not null,
     constraint FKabi_bas_ID primary key (id_ability));

create table characteristics_characters (
     id_characteristic int not null,
     id_character int not null,
     value int not null,
     constraint ID_characteristics_characters_ID primary key (id_character, id_characteristic));

create table characteristics_items (
     id_characteristic int not null,
     id_item int not null,
     value int not null,
     constraint ID_characteristics_items_ID primary key (id_item, id_characteristic));

create table characters_abilities (
     id_ability int not null,
     id_character int not null,
     constraint ID_characters_abilities_ID primary key (id_ability, id_character));

create table characters_items (
     id_character int not null,
     id_item int not null,
     isWearing char not null,
     constraint ID_characters_items_ID primary key (id_item, id_character));

create table classes_weapons (
     id_class int not null,
     id_item int not null,
     constraint ID_classes_weapons_ID primary key (id_item, id_class));

create table enemies (
     id_enemy int not null auto_increment,
     name varchar(100) not null,
     shields int not null,
     image varchar(255) not null,
     constraint ID_enemies_ID primary key (id_enemy));

create table elements_enemies (
     id_element int not null,
     id_enemy int not null,
     constraint ID_elements_enemies_ID primary key (id_enemy, id_element));

create table items_shops (
     id_item int not null,
     id_shop int not null,
     price int not null,
     constraint ID_items_shops_ID primary key (id_shop, id_item));


-- Constraints Section
-- ___________________ 

alter table characters add constraint FKis_in_FK
     foreign key (fk_game)
     references game (id_game);

alter table characters add constraint FKmainClass_FK
     foreign key (fk_class)
     references classes (id_class);

alter table characters add constraint FKsecondaryClass_FK
     foreign key (fk_secondaryClass)
     references classes (id_class);

alter table abilities add constraint FKtype_FK
     foreign key (fk_abilityType)
     references abilityTypes (id_abilityType);

alter table abilities add constraint FKuse_FK
     foreign key (fk_element)
     references elements (id_element);

alter table abilities add constraint FKhas_FK
     foreign key (fk_class)
     references classes (id_class);

alter table weapons add constraint FKite_wea_FK
     foreign key (id_item)
     references items (id_item);

alter table armors add constraint FKite_arm_FK
     foreign key (id_item)
     references items (id_item);

alter table accessories add constraint FKite_acc_FK
     foreign key (id_item)
     references items (id_item);

alter table passiveAbilities add constraint FKabi_pas_FK
     foreign key (id_ability)
     references abilities (id_ability);

alter table activeAbilities add constraint FKabi_act_FK
     foreign key (id_ability)
     references abilities (id_ability);

alter table divineAbilities add constraint FKabi_div_FK
     foreign key (id_ability)
     references abilities (id_ability);

alter table shops add constraint FKplace_FK
     foreign key (fk_place)
     references places (id_place);

alter table baseAbilities add constraint FKabi_bas_FK
     foreign key (id_ability)
     references abilities (id_ability);

alter table characteristics_characters add constraint FKcha_cha_2
     foreign key (id_character)
     references characters (id_character);

alter table characteristics_characters add constraint FKcha_cha_1_FK
     foreign key (id_characteristic)
     references characteristics (id_characteristic);

alter table characteristics_items add constraint FKcha_ite
     foreign key (id_item)
     references items (id_item);

alter table characteristics_items add constraint FKcha_cha_FK
     foreign key (id_characteristic)
     references characteristics (id_characteristic);

alter table characters_abilities add constraint FKcha_cha_4_FK
     foreign key (id_character)
     references characters (id_character);

alter table characters_abilities add constraint FKcha_abi
     foreign key (id_ability)
     references abilities (id_ability);

alter table characters_items add constraint FKcha_ite_1
     foreign key (id_item)
     references items (id_item);

alter table characters_items add constraint FKcha_cha_3_FK
     foreign key (id_character)
     references characters (id_character);

alter table classes_weapons add constraint FKcla_wea
     foreign key (id_item)
     references weapons (id_item);

alter table classes_weapons add constraint FKcla_cla_FK
     foreign key (id_class)
     references classes (id_class);

alter table elements_enemies add constraint FKele_ene
     foreign key (id_enemy)
     references enemies (id_enemy);

alter table elements_enemies add constraint FKele_ele_FK
     foreign key (id_element)
     references elements (id_element);

alter table items_shops add constraint FKite_sho
     foreign key (id_shop)
     references shops (id_shop);

alter table items_shops add constraint FKite_ite_FK
     foreign key (id_item)
     references items (id_item);


-- Index Section
-- _____________ 

create unique index ID_characters_IND
     on characters (id_character);

create index FKis_in_IND
     on characters (fk_game);

create index FKmainClass_IND
     on characters (fk_class);

create index FKsecondaryClass_IND
     on characters (fk_secondaryClass);

create unique index ID_abilities_IND
     on abilities (id_ability);

create index FKtype_IND
     on abilities (fk_abilityType);

create index FKuse_IND
     on abilities (fk_element);

create index FKhas_IND
     on abilities (fk_class);

create unique index ID_items_IND
     on items (id_item);

create unique index FKite_wea_IND
     on weapons (id_item);

create unique index FKite_arm_IND
     on armors (id_item);

create unique index FKite_acc_IND
     on accessories (id_item);

create unique index ID_classes_IND
     on classes (id_class);

create unique index ID_places_IND
     on places (id_place);

create unique index ID_game_IND
     on game (id_game);

create unique index ID_abilityTypes_IND
     on abilityTypes (id_abilityType);

create unique index FKabi_pas_IND
     on passiveAbilities (id_ability);

create unique index FKabi_act_IND
     on activeAbilities (id_ability);

create unique index FKabi_div_IND
     on divineAbilities (id_ability);

create unique index ID_shops_IND
     on shops (id_shop);

create index FKplace_IND
     on shops (fk_place);

create unique index ID_characteristics_IND
     on characteristics (id_characteristic);

create unique index ID_elements_IND
     on elements (id_element);

create unique index FKabi_bas_IND
     on baseAbilities (id_ability);

create unique index ID_characteristics_characters_IND
     on characteristics_characters (id_character, id_characteristic);

create index FKcha_cha_1_IND
     on characteristics_characters (id_characteristic);

create unique index ID_characteristics_items_IND
     on characteristics_items (id_item, id_characteristic);

create index FKcha_cha_IND
     on characteristics_items (id_characteristic);

create unique index ID_characters_abilities_IND
     on characters_abilities (id_ability, id_character);

create index FKcha_cha_4_IND
     on characters_abilities (id_character);

create unique index ID_characters_items_IND
     on characters_items (id_item, id_character);

create index FKcha_cha_3_IND
     on characters_items (id_character);

create unique index ID_classes_weapons_IND
     on classes_weapons (id_item, id_class);

create index FKcla_cla_IND
     on classes_weapons (id_class);

create unique index ID_enemies_IND
     on enemies (id_enemy);

create unique index ID_elements_enemies_IND
     on elements_enemies (id_enemy, id_element);

create index FKele_ele_IND
     on elements_enemies (id_element);

create unique index ID_items_shops_IND
     on items_shops (id_shop, id_item);

create index FKite_ite_IND
     on items_shops (id_item);

