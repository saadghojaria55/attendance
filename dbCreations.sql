CREATE TABLE `usersdb`.`userlist`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(20) NOT NULL,
    `lastName` VARCHAR(20) NOT NULL,
    `teacherPic` TEXT NOT NULL,
    `gender` VARCHAR(7) NOT NULL,
    `email` VARCHAR(30) NOT NULL,
    `phone` INT NOT NULL,
    `dob` DATE NOT NULL,
    `institutionName` VARCHAR(30) NOT NULL,
    `institutionType` VARCHAR(30) NOT NULL,
    `address` TEXT NOT NULL,
    `username` VARCHAR(15) NOT NULL,
    `password` VARCHAR(34) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;


INSERT INTO `userlist`(`firstName`, `lastName`, `teacherPic`, `gender`, `email`, `phone`, `dob`, `institutionName`, `institutionType`, `address`, `username`, `password`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12]);


INSERT INTO `usersdb`.`userlist`(`firstName`, `lastName`, `teacherPic`, `gender`, `email`, `phone`, `dob`, `institutionName`, `institutionType`, `address`, `username`, `password`) VALUES ("ffsf","dmd","dmd","dmd","dmd",9852,9/5/78,"dmd","dmd","ddcccccmd","dmd","dmd");


CREATE TABLE `iharis`.`TYBSC IT` ( `s1` VARCHAR(20) NOT NULL ,  `s2` VARCHAR(20) NOT NULL ,  `s3` VARCHAR(20) NOT NULL ,  `s4` VARCHAR(20) NOT NULL ,  `s5` VARCHAR(20) NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `iharis`.`kk` ( `h` TINYINT(1) NOT NULL ) ENGINE = InnoDB;

SELECT s1.COLUMN_NAME, s1.COLUMN_COMMENT
FROM information_schema.COLUMNS s1 
WHERE s1.TABLE_NAME = 'tybsc it';

SELECT 
    COLUMN_COMMENT
FROM 
    information_schema.COLUMNS
WHERE
    TABLE_NAME = 'tybsc it' AND COLUMN_NAME = 's1';


    CREATE TABLE `iharis`.`tybsc` ( `s1` INT(1) NOT NULL COMMENT 'Haris' , `s2` INT(1) NOT NULL COMMENT 'Enamul' , `s3` INT(1) NOT NULL COMMENT 'Shayan' , `s4` INT(1) NOT NULL COMMENT 'Saba' ) ENGINE = InnoDB;



CREATE TABLE `iharis`.`tybsc` ( `dateOfAttendance` DATE NOT NULL , `s1` INT(1) NOT NULL COMMENT 'Enamul' , `s2` INT(1) NOT NULL COMMENT 'Shayan' , `s3` INT(1) NOT NULL COMMENT 'Saba' , `s4` INT(1) NOT NULL COMMENT 'Haris' ) ENGINE = InnoDB;


SELECT COLUMN_NAME FROM `tybsc` WHERE COLUMN_COMMENT='Haris';


SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='yourdatabasename' 
    AND `TABLE_NAME`='yourtablename';



SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='iharis' 
AND `TABLE_NAME`='tybsc' AND COLUMN_COMMENT='Haris';

SELECT `COLUMN_COMMENT` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='iharis' AND `TABLE_NAME`='tybsc' AND `COLUMN_NAME`='s1';

SELECT table_comment
FROM INFORMATION_SCHEMA.TABLES
WHERE table_name = 'my_table' and 
      table_schema = 'my_database'



CREATE TABLE `demouser`.`tybsc` ( `id` INT NOT NULL AUTO_INCREMENT , `dateofattendance` DATE NOT NULL , `s1` TINYINT(1) NOT NULL COMMENT 'Asad Sheikh' , `s2` TINYINT(1) NOT NULL COMMENT 'Saquib Alam' , `s3` TINYINT(1) NOT NULL COMMENT 'Sejal Trekar' , `s4` TINYINT(1) NOT NULL COMMENT 'Kavita Sahu' , `s5` TINYINT(1) NOT NULL COMMENT 'Prathamesh Parab' , `s6` TINYINT(1) NOT NULL COMMENT 'Anuj Singh' , `s7` TINYINT(1) NOT NULL COMMENT 'Atif Alam' , `s8` TINYINT(1) NOT NULL COMMENT 'Raman Kumar' , `s9` TINYINT(1) NOT NULL COMMENT 'Treyan Fernandes' , `s10` TINYINT(1) NOT NULL COMMENT 'Ghanshayam Yadav' , `s11` TINYINT(1) NOT NULL COMMENT 'Fatima Navarpalli' , `s12` TINYINT(1) NOT NULL COMMENT 'Saba Parween' , `s13` TINYINT(1) NOT NULL COMMENT 'Schezan Mansuri' , `s14` TINYINT(1) NOT NULL COMMENT 'Shubham Parab' , `s15` TINYINT(1) NOT NULL COMMENT 'Fehad Lone' ,  PRIMARY KEY (`id`)) ENGINE = InnoDB;


SELECT `s1` FROM `tybsc` WHERE dateofattendance='2018-3-13' AND WHERE dateofattendance='2018-3-12';


SELECT `s1` FROM `tybsc` WHERE dateofattendance='2018-3-13' OR dateofattendance='2018-3-12' WHERE NOT EXISTS (dateofattendance='2018-3-13');

SELECT COUNT(*) FROM `tybsc`;

SELECT `username` FROM `usersdb`.`userlist` WHERE id=38;





SELECT count(*) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='iharis' AND `TABLE_NAME`='tybsc';


    SELECT `COLUMN_NAME` 
    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    WHERE `TABLE_SCHEMA`='iharis'
    AND `TABLE_NAME`='tybsc' AND COLUMN_COMMENT='Haris';

    SELECT SUM(`s1`) FROM `tybsc`

SELECT `dateofattendance`,`s1`, `s2`, `s3`, `s4`,SUM(`s1`),SUM(`s2`),SUM(`s3`),SUM(`s4`) FROM `iharis`.`tybsc` WHERE dateofattendance='2018-03-16' OR dateofattendance='2018-03-15' OR dateofattendance='2018-03-14' OR dateofattendance='2018-03-13' OR dateofattendance='2018-03-12' OR dateofattendance='2018-03-11' OR dateofattendance='2018-03-10';



SELECT *
FROM table
WHERE MONTH(columnName) = MONTH(CURRENT_DATE())
AND YEAR(columnName) = YEAR(CURRENT_DATE())


Name - varchar
DueDate -datetime
Status -boll
SELECT * FROM tybsc WHERE MONTH(dateofattendance) = 3 AND YEAR(dateofattendance) = 2018;

select count(*),SUM(`s1`),SUM(`s2`),SUM(`s3`),SUM(`s4`) FROM `tybsc`  WHERE MONTH(dateofattendance) = 3 AND YEAR(dateofattendance) = 2018

INSERT INTO `tybsc`(`dateofattendance`, `s1`, `s2`, `s3`, `s4`, `s5`) VALUES ('2018-2-10',1,1,1,1,1);

ALTER TABLE iharis.tybsc ADD `s9` TINYINT(1) NOT NULL COMMENT 'Shayan' after `s8`;


ALTER TABLE `WeatherCenter`
   ADD COLUMN BarometricPressure SMALLINT NOT NULL,
   ADD COLUMN CloudType VARCHAR(70) NOT NULL,
   ADD COLUMN  WhenLikelyToRain VARCHAR(30) NOT NULL;


INSERT INTO `userlist`(`id`,`firstName`, `lastName`, `teacherPic`, `gender`, `email`, `phone`, `dob`, `institutionName`, `institutionType`, `address`, `username`, `password`) VALUES (1,'John', 'Doe','../uploads/demoToon.jpg','male','john@doe.com','9012345678','1990-01-01','OCM','Grauduate',' 445 Mount Eden Road, Mount Eden, Auckland', 'demouser', 'd07a7b1741ca8801a36651b6a23f81a2');


CREATE DATABASE demouser;