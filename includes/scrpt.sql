CREATE DATABASE INSTITUTO;


CREATE TABLE tutor  ( 
    tutor_id        SERIAL NOT NULL,
    tutor_nombre    VARCHAR(100) NOT NULL,
    tutor_apellido  VARCHAR(100) NOT NULL,
    tutor_telefono  VARCHAR(15),
    tutor_email     VARCHAR(100),
    tutor_direccion VARCHAR(255),
    tutor_relacion  VARCHAR(50),
    tutor_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(tutor_id)
);

CREATE TABLE alumnos  ( 
    alumno_id               SERIAL NOT NULL,
    alumno_nombre           VARCHAR(100) NOT NULL,
    alumno_apellido         VARCHAR(100) NOT NULL,
    alumno_fecha_nacimiento DATE,
    alumno_direccion        VARCHAR(255),
    alumno_telefono         VARCHAR(15),
    alumno_email            VARCHAR(100),
    alumno_situacion        SMALLINT DEFAULT 1,
    alumno_tutor            INTEGER NOT NULL,
    PRIMARY KEY(alumno_id),
    FOREIGN KEY (alumno_tutor) REFERENCES tutor(tutor_id)
);


CREATE TABLE profesor  ( 
    profesor_id        SERIAL NOT NULL,
    profesor_nombre    VARCHAR(100) NOT NULL,
    profesor_apellido  VARCHAR(100) NOT NULL,
    profesor_email     VARCHAR(100),
    profesor_telefono  VARCHAR(15),
    profesor_direccion VARCHAR(255),
    profesor_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(profesor_id)
);

CREATE TABLE grado  ( 
    grado_id        SERIAL NOT NULL,
    grado_nombre    VARCHAR(50) NOT NULL,
    grado_situacion SMALLINT DEFAULT 1,
    grado_monto     DECIMAL(10,2),
    PRIMARY KEY(grado_id)
);

CREATE TABLE curso  ( 
    curso_id          SERIAL NOT NULL,
    curso_nombre      VARCHAR(100) NOT NULL,
    curso_descripcion VARCHAR(255),
    curso_creditos    SMALLINT NOT NULL,
    curso_situacion   SMALLINT DEFAULT 1,
    PRIMARY KEY(curso_id)
);

CREATE TABLE pago  ( 
    pago_id        SERIAL NOT NULL,
    pago_alumno    INTEGER NOT NULL,
    pago_mes       VARCHAR(20) NOT NULL,
    pago_fecha     DATE,
    pago_estado    VARCHAR(25) NOT NULL,
    pago_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(pago_id),
    FOREIGN KEY (pago_alumno) REFERENCES alumnos(alumno_id)
);


CREATE TABLE matricula  ( 
    matricula_id        SERIAL NOT NULL,
    matricula_alumno    INTEGER NOT NULL,
    matricula_curso     INTEGER NOT NULL,
    matricula_fecha     DATE,
    matricula_estado    VARCHAR(30),
    matricula_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(matricula_id),
    FOREIGN KEY (matricula_curso) REFERENCES curso(curso_id),
    FOREIGN KEY (matricula_alumno) REFERENCES alumnos(alumno_id)
);


 CREATE TABLE asistencia  ( 
     asistencia_id        SERIAL NOT NULL,
     asistencia_alumno    INTEGER NOT NULL,
     asistencia_curso     INTEGER NOT NULL,
     asistencia_fecha     DATE,
     asistencia_estado    VARCHAR(15) NOT NULL,
     asistencia_situacion SMALLINT DEFAULT 1,
     PRIMARY KEY(asistencia_id),
     FOREIGN KEY (asistencia_curso) REFERENCES curso(curso_id),
     FOREIGN KEY (asistencia_alumno) REFERENCES alumnos(alumno_id)
 );

CREATE TABLE seccion  ( 
    seccion_id        SERIAL NOT NULL,
    seccion_nombre    VARCHAR(1) NOT NULL,
    seccion_grado     INTEGER,
    seccion_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(seccion_id),
    FOREIGN KEY (seccion_grado) REFERENCES grado(grado_id)
);


CREATE TABLE asignacion_alumnos  ( 
    asignacion_id        SERIAL NOT NULL,
    asignacion_alumno    INTEGER NOT NULL,
    asignacion_seccion   INTEGER NOT NULL,
    asignacion_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(asignacion_id),
    FOREIGN KEY (asignacion_seccion) REFERENCES seccion(seccion_id),
    FOREIGN KEY (asignacion_alumno) REFERENCES alumnos(alumno_id)
);


CREATE TABLE profesor_seccion  ( 
    profesor_seccion_id SERIAL NOT NULL,
    profesor_sec        INTEGER NOT NULL,
    profesor_prof       INTEGER NOT NULL,
    profesor_situacion  SMALLINT DEFAULT 1,
    PRIMARY KEY(profesor_seccion_id),
    FOREIGN KEY (profesor_prof) REFERENCES profesor(profesor_id),
    FOREIGN KEY (profesor_sec) REFERENCES seccion(seccion_id)
);


CREATE TABLE reporte_asistencia  ( 
    reporte_asistencia_id SERIAL NOT NULL,
    reporte_asis_grado    INTEGER NOT NULL,
    reporte_asis_seccion  INTEGER NOT NULL,
    reporte_asis_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY(reporte_asistencia_id),
    FOREIGN KEY (reporte_asis_seccion) REFERENCES seccion(seccion_id),
    FOREIGN KEY (reporte_asis_grado) REFERENCES grado(grado_id)
);


CREATE TABLE reporte_conducta  ( 
    reporte_conducta_id SERIAL NOT NULL,
    reporte_alumno      INTEGER NOT NULL,
    reporte_conducta    VARCHAR(25),
    reporte_fecha       DATE,
    reporte_situacion   SMALLINT DEFAULT 1,
    PRIMARY KEY(reporte_conducta_id),
    FOREIGN KEY (reporte_alumno) REFERENCES alumnos(alumno_id)
);


create table aplicacion (
app_id serial,
app_nombre varchar(50),
app_situacion smallint default 1,
primary key (app_id)
);

create table usuario(
usu_id serial,
usu_nombre varchar(50),
usu_catalogo integer,
usu_password lvarchar,
usu_situacion smallint default 1,
primary key (usu_id)
);

create table rol (
rol_id serial,
rol_nombre varchar(50),
rol_nombre_ct varchar(30),
rol_app integer,
rol_situacion smallint default 1,
primary key (rol_id),
foreign key (rol_app) references aplicacion (app_id)
);


create table permiso (
permiso_id serial,
permiso_usuario integer,
permiso_rol integer,
permiso_situacion smallint default 1,
primary key (permiso_id),
foreign key (permiso_rol) references rol (rol_id),
foreign key (permiso_usuario) references usuario
(usu_id)
);

