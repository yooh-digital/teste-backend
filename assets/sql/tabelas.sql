
-- Banco de dados: mini-blog --

-- Tabela usuarios --

create table usuarios(
    id int unsigned not null auto_increment primary key,
    login varchar(100) not null,
    senha varchar(32) not null
);

-- Tabela internauta --

create table internauta(
    id int unsigned not null auto_increment primary key,
    nome varchar(100) not null,
    email varchar(100) not null
);


-- Tabela foto_postagem --

create table foto_postagem(
    id int unsigned not null auto_increment primary key,
    nome varchar(100) not null
);

-- Tabela postagem --

create table postagem(
    id int unsigned not null auto_increment primary key,
    id_usuario int not null,
    id_foto_postagem int not null,
    titulo varchar(100) not null,
    conteudo text not null
);

-- Tabela comentarios --

create table comentarios(
    id int unsigned not null auto_increment primary key,
    id_internauta int not null,
    id_postagem int not null,
    comentarios text not null
);



-- Valores padrão --

insert into usuarios set login = 'admin', senha = md5('admin');








