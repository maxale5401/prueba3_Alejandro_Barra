Create database prueba3;
Use prueba3;

create table hospitalizacion(
                                id int not null primary key,
                                paciente varchar(30),
                                diagnostico varchar(250) not null,
                                dias int not null
);

insert into hospitalizacion values('123', 'Juan Perez', 'Enfermo', '4');
select * from hospitalizacion;
