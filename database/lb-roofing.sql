-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-11-29 05:43:02.012

-- tables
-- Table: cotizacion
CREATE TABLE cotizacion (
    id int  NOT NULL AUTO_INCREMENT,
    fecha_emision datetime  NOT NULL,
    fecha_vencimiento datetime  NOT NULL,
    subtotal decimal(10,2)  NOT NULL,
    descuento decimal(10,2)  NULL DEFAULT null,
    total decimal(10,2)  NOT NULL,
    observaciones varchar(500)  NULL DEFAULT null,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    proyecto int  NOT NULL,
    producto int  NOT NULL,
    creado_por int  NOT NULL,
    CONSTRAINT cotizaciones_pk PRIMARY KEY (id)
);

-- Table: cotizacion_item
CREATE TABLE cotizacion_item (
    id int  NOT NULL AUTO_INCREMENT,
    cantidad decimal(10,2)  NOT NULL,
    precio decimal(10,2)  NOT NULL,
    descuento decimal(10,2)  NULL DEFAULT null,
    fecha_creacion datetime  NOT NULL,
    fecha_modificaion datetime  NOT NULL,
    cotizacion int  NOT NULL,
    producto int  NOT NULL,
    CONSTRAINT cotizacion_items_pk PRIMARY KEY (id)
);

-- Table: direccion
CREATE TABLE direccion (
    id int  NOT NULL,
    codigo_postal varchar(60)  NULL,
    pais varchar(150)  NOT NULL,
    ciudad varchar(150)  NULL,
    colonia varchar(150)  NULL,
    direccion text  NOT NULL,
    latitud int  NULL,
    longitud int  NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    usuario int  NOT NULL,
    CONSTRAINT direccion_pk PRIMARY KEY (id)
);

-- Table: estado
CREATE TABLE estado (
    id int  NOT NULL AUTO_INCREMENT,
    nombre varchar(255)  NOT NULL,
    slug varchar(255)  NOT NULL,
    descripcion varchar(300)  NULL DEFAULT null,
    creado_por int  NOT NULL,
    CONSTRAINT estados_pk PRIMARY KEY (id)
);

-- Table: estado_producto
CREATE TABLE estado_producto (
    id int  NOT NULL,
    nombre varchar(60)  NOT NULL,
    descripcion text  NULL,
    slug varchar(60)  NOT NULL,
    creado_por int  NOT NULL,
    CONSTRAINT estado_producto_pk PRIMARY KEY (id)
);

-- Table: factura
CREATE TABLE factura (
    id int  NOT NULL AUTO_INCREMENT,
    fecha_emision datetime  NOT NULL,
    fecha_vencimiento datetime  NOT NULL,
    subtotal decimal(10,2)  NOT NULL,
    descuento decimal(10,2)  NULL DEFAULT null,
    total decimal(10,2)  NOT NULL,
    es_proyecto int  NULL DEFAULT 1,
    observaciones varchar(500)  NULL DEFAULT null,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    usuario_id int  NOT NULL,
    proyecto_id int  NOT NULL,
    CONSTRAINT facturas_pk PRIMARY KEY (id)
);

-- Table: factura_items
CREATE TABLE factura_items (
    id int  NOT NULL AUTO_INCREMENT,
    cantidad decimal(10,2)  NOT NULL,
    precio decimal(10,2)  NOT NULL,
    descuento decimal(10,2)  NULL DEFAULT null,
    factura_id int  NOT NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    producto_id int  NOT NULL,
    CONSTRAINT factura_items_pk PRIMARY KEY (id)
);

-- Table: galeria_proyecto
CREATE TABLE galeria_proyecto (
    id int  NOT NULL AUTO_INCREMENT,
    titulo varchar(255)  NULL DEFAULT null,
    descripcion varchar(500)  NULL DEFAULT null,
    directorio varchar(255)  NOT NULL,
    proyecto_id int  NOT NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    creado_por int  NOT NULL,
    CONSTRAINT galeria_proyectos_pk PRIMARY KEY (id)
);

-- Table: info_bussiness
CREATE TABLE info_bussiness (
    id int  NOT NULL AUTO_INCREMENT,
    nombre varchar(255)  NOT NULL,
    nombre_mostrar varchar(255)  NULL DEFAULT null,
    direccion varchar(255)  NOT NULL,
    telefono varchar(15)  NOT NULL,
    correo varchar(255)  NOT NULL,
    rlegal_nombres varchar(255)  NULL DEFAULT null,
    rlegal_apellidos varchar(255)  NULL DEFAULT null,
    rlegal_correo varchar(255)  NULL DEFAULT null,
    rlegal_telefono varchar(255)  NULL DEFAULT null,
    sitio_web varchar(255)  NULL DEFAULT null,
    info varchar(500)  NULL DEFAULT null,
    logo varchar(255)  NULL DEFAULT null,
    created_at timestamp  NULL DEFAULT current_timestamp,
    updated_at timestamp  NULL ON UPDATE CURRENT_TIMESTAMP,
    moneda varchar(255)  NOT NULL,
    CONSTRAINT configuracion_pk PRIMARY KEY (id)
);

-- Table: producto
CREATE TABLE producto (
    id int  NOT NULL AUTO_INCREMENT,
    nombre varchar(255)  NOT NULL,
    descripcion varchar(500)  NULL DEFAULT null,
    unidad_medida varchar(50)  NOT NULL,
    precio_compra decimal(10,2)  NULL DEFAULT null,
    precio_venta decimal(10,2)  NOT NULL,
    agregado_por int  NOT NULL,
    estado_producto_id int  NOT NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    CONSTRAINT productos_pk PRIMARY KEY (id)
);

-- Table: proyecto
CREATE TABLE proyecto (
    id int  NOT NULL AUTO_INCREMENT,
    titulo varchar(255)  NULL,
    enlace_galeria varchar(500)  NULL,
    fecha_inicio timestamp  NULL,
    fecha_fin timestamp  NULL,
    observaciones varchar(500)  NULL,
    costo decimal(10,2)  NULL,
    usuario_id int  NOT NULL,
    proyecto_estado_id int  NOT NULL,
    CONSTRAINT proyectos_pk PRIMARY KEY (id)
);

-- Table: proyecto_cotizacion
CREATE TABLE proyecto_cotizacion (
    id int  NOT NULL AUTO_INCREMENT,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    producto int  NOT NULL,
    proyecto int  NOT NULL,
    usuario int  NOT NULL,
    CONSTRAINT proyecto_cotizaciones_pk PRIMARY KEY (id)
);

-- Table: proyecto_estado
CREATE TABLE proyecto_estado (
    id int  NOT NULL,
    nombre varchar(60)  NOT NULL,
    slug varchar(60)  NOT NULL,
    descripcion text  NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    CONSTRAINT proyecto_estado_pk PRIMARY KEY (id)
);

-- Table: rol
CREATE TABLE rol (
    id int  NOT NULL,
    nombre varchar(60)  NOT NULL,
    slug varchar(60)  NOT NULL,
    descripcion text  NULL,
    fecha_creacion datetime  NOT NULL,
    CONSTRAINT rol_pk PRIMARY KEY (id)
);

-- Table: tipo_cliente
CREATE TABLE tipo_cliente (
    id int  NOT NULL,
    tipo varchar(100)  NOT NULL,
    slug varchar(60)  NOT NULL,
    CONSTRAINT tipo_cliente_pk PRIMARY KEY (id)
);

-- Table: usuario
CREATE TABLE usuario (
    id int  NOT NULL AUTO_INCREMENT,
    nombres varchar(255)  NOT NULL,
    apellidos varchar(255)  NOT NULL,
    correo varchar(100)  NOT NULL,
    password varchar(60)  NOT NULL,
    nacimiento datetime  NULL,
    documento varchar(60)  NULL,
    genero varchar(20)  NULL,
    fecha_creacion datetime  NOT NULL,
    fecha_modificacion datetime  NOT NULL,
    rol int  NOT NULL,
    estado int  NOT NULL,
    CONSTRAINT usuario_pk PRIMARY KEY (id)
);

-- Table: usuario_cliente
CREATE TABLE usuario_cliente (
    id int  NOT NULL,
    usuario_id int  NOT NULL,
    tipo_cliente_id int  NOT NULL,
    CONSTRAINT usuario_cliente_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: cotizacion_item_cotizacion (table: cotizacion_item)
ALTER TABLE cotizacion_item ADD CONSTRAINT cotizacion_item_cotizacion FOREIGN KEY cotizacion_item_cotizacion (cotizacion)
    REFERENCES cotizacion (id);

-- Reference: cotizacion_item_producto (table: cotizacion_item)
ALTER TABLE cotizacion_item ADD CONSTRAINT cotizacion_item_producto FOREIGN KEY cotizacion_item_producto (producto)
    REFERENCES producto (id);

-- Reference: cotizacion_producto (table: cotizacion)
ALTER TABLE cotizacion ADD CONSTRAINT cotizacion_producto FOREIGN KEY cotizacion_producto (producto)
    REFERENCES producto (id);

-- Reference: cotizacion_proyecto (table: cotizacion)
ALTER TABLE cotizacion ADD CONSTRAINT cotizacion_proyecto FOREIGN KEY cotizacion_proyecto (proyecto)
    REFERENCES proyecto (id);

-- Reference: cotizacion_usuario (table: cotizacion)
ALTER TABLE cotizacion ADD CONSTRAINT cotizacion_usuario FOREIGN KEY cotizacion_usuario (creado_por)
    REFERENCES usuario (id);

-- Reference: direccion_usuario (table: direccion)
ALTER TABLE direccion ADD CONSTRAINT direccion_usuario FOREIGN KEY direccion_usuario (usuario)
    REFERENCES usuario (id);

-- Reference: estado_producto_usuario (table: estado_producto)
ALTER TABLE estado_producto ADD CONSTRAINT estado_producto_usuario FOREIGN KEY estado_producto_usuario (creado_por)
    REFERENCES usuario (id);

-- Reference: factura_items_factura (table: factura_items)
ALTER TABLE factura_items ADD CONSTRAINT factura_items_factura FOREIGN KEY factura_items_factura (factura_id)
    REFERENCES factura (id);

-- Reference: factura_items_producto (table: factura_items)
ALTER TABLE factura_items ADD CONSTRAINT factura_items_producto FOREIGN KEY factura_items_producto (producto_id)
    REFERENCES producto (id);

-- Reference: factura_proyecto (table: factura)
ALTER TABLE factura ADD CONSTRAINT factura_proyecto FOREIGN KEY factura_proyecto (proyecto_id)
    REFERENCES proyecto (id);

-- Reference: factura_usuario (table: factura)
ALTER TABLE factura ADD CONSTRAINT factura_usuario FOREIGN KEY factura_usuario (usuario_id)
    REFERENCES usuario (id);

-- Reference: galeria_proyecto_proyecto (table: galeria_proyecto)
ALTER TABLE galeria_proyecto ADD CONSTRAINT galeria_proyecto_proyecto FOREIGN KEY galeria_proyecto_proyecto (proyecto_id)
    REFERENCES proyecto (id);

-- Reference: galeria_proyecto_usuario (table: galeria_proyecto)
ALTER TABLE galeria_proyecto ADD CONSTRAINT galeria_proyecto_usuario FOREIGN KEY galeria_proyecto_usuario (creado_por)
    REFERENCES usuario (id);

-- Reference: producto_estado_producto (table: producto)
ALTER TABLE producto ADD CONSTRAINT producto_estado_producto FOREIGN KEY producto_estado_producto (estado_producto_id)
    REFERENCES estado_producto (id);

-- Reference: producto_usuario (table: producto)
ALTER TABLE producto ADD CONSTRAINT producto_usuario FOREIGN KEY producto_usuario (agregado_por)
    REFERENCES usuario (id);

-- Reference: proyecto_cotizacion_producto (table: proyecto_cotizacion)
ALTER TABLE proyecto_cotizacion ADD CONSTRAINT proyecto_cotizacion_producto FOREIGN KEY proyecto_cotizacion_producto (producto)
    REFERENCES producto (id);

-- Reference: proyecto_cotizacion_proyecto (table: proyecto_cotizacion)
ALTER TABLE proyecto_cotizacion ADD CONSTRAINT proyecto_cotizacion_proyecto FOREIGN KEY proyecto_cotizacion_proyecto (proyecto)
    REFERENCES proyecto (id);

-- Reference: proyecto_cotizacion_usuario (table: proyecto_cotizacion)
ALTER TABLE proyecto_cotizacion ADD CONSTRAINT proyecto_cotizacion_usuario FOREIGN KEY proyecto_cotizacion_usuario (usuario)
    REFERENCES usuario (id);

-- Reference: proyecto_proyecto_estado (table: proyecto)
ALTER TABLE proyecto ADD CONSTRAINT proyecto_proyecto_estado FOREIGN KEY proyecto_proyecto_estado (proyecto_estado_id)
    REFERENCES proyecto_estado (id);

-- Reference: proyecto_usuario (table: proyecto)
ALTER TABLE proyecto ADD CONSTRAINT proyecto_usuario FOREIGN KEY proyecto_usuario (usuario_id)
    REFERENCES usuario (id);

-- Reference: usuario_cliente_tipo_cliente (table: usuario_cliente)
ALTER TABLE usuario_cliente ADD CONSTRAINT usuario_cliente_tipo_cliente FOREIGN KEY usuario_cliente_tipo_cliente (tipo_cliente_id)
    REFERENCES tipo_cliente (id);

-- Reference: usuario_cliente_usuario (table: usuario_cliente)
ALTER TABLE usuario_cliente ADD CONSTRAINT usuario_cliente_usuario FOREIGN KEY usuario_cliente_usuario (usuario_id)
    REFERENCES usuario (id);

-- Reference: usuario_rol (table: usuario)
ALTER TABLE usuario ADD CONSTRAINT usuario_rol FOREIGN KEY usuario_rol (rol)
    REFERENCES rol (id);

-- Reference: usuario_usuario_estado (table: usuario)
ALTER TABLE usuario ADD CONSTRAINT usuario_usuario_estado FOREIGN KEY usuario_usuario_estado (estado)
    REFERENCES estado (id);

-- End of file.
