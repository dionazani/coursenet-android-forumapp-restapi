drop table register;
create table register(
	id int(11) auto_increment,
	nama varchar(100) not null,
    email varchar(50) not null unique,
    password varchar(255) not null,
    primary key (id)
);

drop table thread;
create table thread (
	id int auto_increment,
    judul varchar(50) not null,
    isi varchar(320) not null,
    rating_star smallint,
    register_created_id int,
    create_datetime datetime default CURRENT_TIMESTAMP,
    primary key (id),
    foreign key (register_created_id) references register (id)
);

drop table thread_reply;
create table thread_reply (
	id int,
	thread_id int,
    balasan varchar(320),
    register_created_id int,
    create_datetime datetime default CURRENT_TIMESTAMP,
    primary key (id, thread_id),
    foreign key (thread_id) references thread(id)
);