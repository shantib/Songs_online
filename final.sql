-- A2: Relational schema in 3NF
/*
Userinfo (fullname, email, password, street_address, dob)
Messages (dt, sender, receiver, sub, body, flag)
Songs (artist, title, album, year)
Fangroup (g_name, g_description, artist, g_id)
Fav_songs (name, year, user_id)
Friends (userid1, userid2)
G_members (email_id, g_id)
Grp_messsages (gid, email, date, time, sub, body)
*/

create database s1;

create table userinfo(
	fullname varchar(30),
    email varchar(40) not null unique,
    passwrd varchar(20) not null, 
    street_address varchar(90),
    dob date not null -- dd/mm/yyyy
    );
    
    Create table Songs(
	Artist varchar(50),
    Title varchar(70) not null,
    album varchar(90),
    release_year numeric(4) not null,
    constraint pk primary key (Title, release_year)
    );
    
    Create table fangroup(
	g_name varchar(80) not null ,
    g_description text(1000),
    g_artist varchar(50),
    g_id varchar(100) PRIMARY KEY,
    creator varchar(40) not null,
    constraint foreign key fg_fk(creator) references userinfo(email) 
    );
    
    Create table Fav_songs(
	song_name varchar(70) not null,
    release_year numeric(4) not null,
    userid varchar(40) not null,
    constraint pk primary key (song_name, release_year, userid),
    constraint fkf foreign key (song_name, release_year) references Songs(Title, release_year),
    constraint fk3 foreign key (userid) references userinfo(email)
    );
    
    Create table friends(
	userid1 varchar(40) not null,
    userid2 varchar(40) not null,
    constraint pk primary key (userid1, userid2),
    constraint fka foreign key (userid1) references userinfo(email),
    constraint fkb foreign key (userid2) references userinfo(email)
    );
    
    create table g_members(
	email_id varchar(40) not null,
    g_id_m varchar(100) not null,
    constraint pkgm primary key(email_id, g_id_m),
    constraint fkgm1 foreign key(email_id) references userinfo(email),
    constraint fkgm2 foreign key(g_id_m) references fangroup(g_id)
    );
    
    create table messages_personal(
    msg_p int not null auto_increment,
	dt datetime DEFAULT CURRENT_TIMESTAMP, -- date and time of message
	sender varchar(50) not null, -- sender's email-id
    receiver varchar(50) not null, -- receiver's email id
    sub varchar(100), 
    Body text,
    flag varchar(1), -- shows deletion status
    constraint msg_pk primary key(msg_p), 
    Constraint status_flag 
    check( flag in ('B', 'S', 'R')),
    constraint fk1 foreign key (sender) references userinfo(email),
    constraint fk2 foreign key (receiver) references userinfo(email)
    );
    
    create table grp_messsages(
    msg_id int not null auto_increment,
	dtg datetime default current_timestamp,
    sender_ varchar(50) not null,
    g_id varchar(100) not null,
    sub varchar(100) not null,
    body text,
    constraint msg_g_pk primary key(msg_id),
    constraint fkmsg_g_1 foreign key (sender_) references userinfo(email),
    constraint fkmsg_g_2 foreign key (g_id) references fangroup(g_id)
    );
 
 
-- A3: Insertion of tuples:
-- Userinfo table
Insert into userinfo values('Anumeha lakra', 'anumeha1999@gmail.com', '7s9456', 'kalyan', '1999/01/25');
Insert into userinfo values('ABC', 'ABC@gmail.com', '78d456', 'trimurti nagar', '1999/12/04');
Insert into userinfo values('DEF', 'DEF1999@gmail.com', '7d9456', 'Laxmi nagar', '1999/06/15');
Insert into userinfo values('XYZ', 'XYZ1999@gmail.com', '7894ee', 'trimurti nagar', '1985/7/8');
Insert into userinfo values('mansi', 'mansi1999@gmail.com', '7894jik', 'Laxmi nagar', '1998/5/12');
Insert into userinfo values('B. Shanti', 'shanti1999@gmail.com', '7s456', 'supma', '1999/05/01');

-- songs table
Insert into Songs values('sia furler', 'Cheap Thrills', '', 2016);
Insert into Songs values('Luis Fonsi', 'Despacito', 'ABC', 2019);
Insert into Songs values('Alan Walker', 'Faded', 'Faded', 2015);
Insert into Songs values('Justin Beiber', 'Sorry', 'Sorry', 2015);
Insert into Songs values('justin beiber', 'i dont care', 'I dont care', 2019);

-- fangroup table
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('GDBMS','mini project', 'sia furler', 'DB', 'mansi1999@gmail.com');
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('Justin_fans','Beilebers', 'Justin Beiber', 'justin', 'anumeha1999@gmail.com');
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('MArshmellow_fans','Walker lovers', 'Alan Walker', 'Walker', 'shanti1999@gmail.com');
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('GCN','mini project', 'sia furler', 'CN', 'anumeha1999@gmail.com');
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('Taylor','Taylor_fans', 'Taylor swift', 'ZBC', 'XYZ1999@gmail.com');
Insert into fangroup(g_name, g_description, g_artist, g_id, creator) values('Taylor','Taylor fans', 'Taylor swift', 'Taylor1', 'DEF1999@gmail.com');


-- Fav_songs table
Insert into fav_songs values('Cheap Thrills', 2016, 'mansi1999@gmail.com');
Insert into fav_songs values('Despacito', 2019, 'mansi1999@gmail.com');
Insert into fav_songs values('Faded', 2015, 'mansi1999@gmail.com');
Insert into fav_songs values('i dont care', 2019, 'mansi1999@gmail.com');
Insert into fav_songs values('Sorry', 2015, 'mansi1999@gmail.com');
Insert into fav_songs values('Cheap Thrills', 2016, 'ABC@gmail.com');
Insert into fav_songs values('Despacito', 2019, 'ABC@gmail.com');
Insert into fav_songs values('Faded', 2015, 'ABC@gmail.com');
Insert into fav_songs values('i dont care', 2019, 'ABC@gmail.com');
Insert into fav_songs values('Sorry', 2015, 'DEF1999@gmail.com');
Insert into fav_songs values('i dont care', 2019, 'shanti1999@gmail.com');
Insert into fav_songs values('Faded', 2015, 'anumeha1999@gmail.com');
Insert into fav_songs values('Sorry', 2015, 'ABC@gmail.com');



-- Friends table

Insert into friends values('mansi1999@gmail.com', 'shanti1999@gmail.com');
Insert into friends values('anumeha1999@gmail.com', 'shanti1999@gmail.com');
Insert into friends values('mansi1999@gmail.com', 'anumeha1999@gmail.com');
Insert into friends values('XYZ1999@gmail.com', 'shanti1999@gmail.com');
Insert into friends values('XYZ1999@gmail.com', 'DEF1999@gmail.com');
Insert into friends values('anumeha1999@gmail.com', 'mansi1999@gmail.com');

-- messages_personal table
Insert into messages_personal(sender, receiver, sub, body, flag) values('mansi1999@gmail.com', 'shanti1999@gmail.com', 'Dbms', 'Kl submit krna hai!', 'B');
Insert into messages_personal(sender, receiver, sub, body, flag) values('anumeha1999@gmail.com', 'mansi1999@gmail.com', 'Classes', 'Tomorrow', 'B');
Insert into messages_personal(sender, receiver, sub, body, flag) values('shanti1999@gmail.com', 'XYZ1999@gmail.com', 'Research', 'Mini project', 'B');
Insert into messages_personal(sender, receiver, sub, body, flag) values('shanti1999@gmail.com', 'XYZ1999@gmail.com', 'Tomorrow submission', 'Unprepared', 'B');
Insert into messages_personal(sender, receiver, sub, body, flag) values('anumeha1999@gmail.com', 'shanti1999@gmail.com', 'app', 'swadhyay', 'B');
    
-- g_members table
Insert into g_members values('mansi1999@gmail.com', 'DB');
Insert into g_members values('anumeha1999@gmail.com', 'DB');
Insert into g_members values('shanti1999@gmail.com', 'DB');
Insert into g_members values('shanti1999@gmail.com', 'CN');
Insert into g_members values('mansi1999@gmail.com', 'Walker');
Insert into g_members values('shanti1999@gmail.com', 'Justin');
Insert into g_members values('ABC@gmail.com', 'ZBC');

-- grp_messsages table
Insert into grp_messsages (sender_, g_id, sub, body) values('mansi1999@gmail.com', 'DB', 'DBMS mini project','Project Done!');
Insert into grp_messsages (sender_, g_id, sub, body) values('anumeha1999@gmail.com', 'DB', 'DBMS mini project','YASSS!');
Insert into grp_messsages (sender_, g_id, sub, body) values('shanti1999@gmail.com', 'DB', 'DBMS mini project','Party!');
Insert into grp_messsages (sender_, g_id, sub, body) values('XYZ1999@gmail.com', 'ZBC', 'New Song','Done!');

Insert into grp_messsages (sender_, g_id, sub, body) values('anumeha1999@gmail.com', 'CN', ' mini project','Due next week!');

-- A4: Views
-- View 1: Find pairs of users that have at least five favorite songs in common.


create view M1 as
    select f1.userid as user1, f2.userid as user2
    from fav_songs as f1, fav_songs as f2
    where f1.song_name = f2.song_name and f1.userid < f2.userid and f1.release_year = f2.release_year
    group by f1.userid, f2.userid
    having count(*) >4;

create view view2 as
    select sender
    from messages_personal
    group by sender
    having count(*)>2;
    
create view v3 as
	select Title
    from songs
    where release_year>=2015;
    
create view v4 as
	select fullname 
    from userinfo
    where street_address = 'Laxmi Nagar' ;
    
create view v5 as
	select fullname, email 
    from userinfo
    where dob > '1999/01/01';
    
create view v6 as
	select fullname, g_name
    from userinfo as u, fangroup as f
    where u.email = f.creator and f.g_artist='Taylor swift';
 
