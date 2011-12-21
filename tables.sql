CREATE TABLE staff
(
	id int(4) unsigned NOT NULL auto_increment primary key,
	name text NOT NULL,
	regno varchar(10) not null unique,
	email text not null,
	username text not null,
	password text not null,
	phonenr varchar(15) not null,
	created datetime not null,
	active tinyint not null default 1
);

CREATE TABLE shifts
(
	id int(4) unsigned NOT NULL auto_increment primary key,
	staff_id int(4) unsigned not null references staff (id) on delete cascade on update cascade,
	start date not null,
	end date not null
);

