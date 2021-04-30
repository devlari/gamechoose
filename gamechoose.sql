create table usuario(
	cod_usuario int(6) primary key auto_increment,
	foto_usuario varchar(73) not null,
	nick_usuario varchar(30) not null,
	senha_usuario varchar(40) not null,
	nome_usuario varchar(50) not null, 
	email_usuario varchar(50) not null
);

create table biblioteca(
	cod_biblioteca int(6) primary key auto_increment,
    	cod_usuario_biblioteca int(6) references usuario
);

create table jogo(
	cod_jogo int(6) primary key auto_increment,
	nome_jogo varchar(50) not null,
	descricao_jogo varchar(1000),
	preco_jogo float(6,2) not null,
	foto_jogo varchar(73) not null,
	fotodestaque_jogo varchar(73) not null,
	qntdvendida_jogo numeric(20) not null
);

create table pedido(
	cod_pedido int(6) primary key auto_increment,
    	cod_usuario_pedidofk int(6) references usuario,
	total_pedido float(10,2) not null
);

create table carrinho(
	cod_jogo_carrinhofk int(6) references jogo,
	cod_pedido_carrinhofk int(6) references pedido
);

create table categoria(
	cod_categoria int(6) primary key auto_increment,
    	nome_categoria varchar(30) not null
);

create table requisitos(
	cod_requisitos int(6) primary key auto_increment,
    	cod_jogo_requisitosfk int(6) references jogo,
    	sistema_minimo varchar(50) not null,
    	sistema_recomendado varchar(50) not null,
    	processador_minimo varchar(50) not null,
    	processador_recomendado varchar(50) not null,
    	placa_minimo varchar(50) not null,
    	placa_recomendado varchar(50) not null,
    	ram_minimo varchar(50) not null,
    	ram_recomendado varchar(50) not null,
    	armaz_minimo varchar(50) not null,
    	armaz_recomendado varchar(50) not null,
);
