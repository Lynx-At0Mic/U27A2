create table login
(
	account_id int auto_increment primary key,
	username varchar(128) not null,
	pwd_hash varchar(255) not null,
	hash_salt varchar(255) not null,
	access_token varchar(255) not null,
	creation_date datetime default CURRENT_TIMESTAMP() null,
	last_login_date datetime null,
	constraint username
	unique (username)
);

