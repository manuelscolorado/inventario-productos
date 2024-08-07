# API - Inventario de Productos

Esta documentación proporciona detalles sobre la API de Inventario de Productos. Esta API actúa como un sistema CRUD (Crear, Leer, Actualizar, Borrar) que permite a los usuarios ver, crear, editar y listar productos. Proporciona instrucciones sobre cómo iniciar servicios, descripciones de los endpoints disponibles, y cómo realizar operaciones en los datos de los productos.

# Iniciar Servicios

Antes de iniciar los servicios, es necesario tener instalado Docker. Puedes descargarlo e instalarlo desde la [página oficial de Docker](https://www.docker.com/products/docker-desktop). 

Además, necesitarás descargar el proyecto del repositorio de GitHub en el siguiente enlace: [https://github.com/manuelscolorado/inventario-productos](https://github.com/manuelscolorado/inventario-productos).

Y puedes hacerlo desde la terminal de la siguiente manera:

```jsx
git clone https://github.com/manuelscolorado/inventario-productos.git
```

Una vez descargado el proyecto, accede desde la terminal a la ruta del proyecto para ajecutar los siguientes comandos.

### Crear contenedores Docker

```jsx
docker-compose up --build -d 
```

### Ejecutar migraciones

```jsx
docker exec -it laravel-app php artisan migrate
```

### Ejecutar seeders

```jsx
docker exec -it laravel-app php artisan db:seed
```

### Iniciar servicio de Laravel

```jsx
docker exec -it laravel-app php artisan serve 
```

Una vez que el servicio de Laravel está en funcionamiento, puedes acceder a la interfaz a través del enlace mostrado en la consola.

### Ejemplo de acceso al servicio local

```jsx
<http://localhost:8080/api/productos>
```

# API de Productos

## Endpoints

A continuación se describen las rutas definidas en la API

```jsx
  GET|HEAD        api/productos
  POST            api/productos
  GET|HEAD        api/productos/{producto}
  PUT|PATCH       api/productos/{producto}
  DELETE          api/productos/{producto}
```

### Descripción

Los endpoints de la API de Inventario de Productos permiten realizar varias operaciones en los datos de los productos.

- `GET|HEAD api/productos` se utiliza para obtener una lista de todos los productos.
- `POST api/productos` se utiliza para crear un nuevo producto.
- `GET|HEAD api/productos/{producto}` se utiliza para obtener los detalles de un producto específico.
- `PUT|PATCH api/productos/{producto}` se utiliza para actualizar los detalles de un producto específico.
- `DELETE api/productos/{producto}` se utiliza para eliminar un producto específico.

Donde el parámetro `{producto}` corresponde al ***stockid*** del producto.

### Cuerpo de la petición

El cuerpo de la petición tanto para crear un nuevo producto como para editarlo es el siguiente:

```jsx
{
    "stockid": "A123B458",
    "nombre": "Producto Ejemplo",
    "descripcion": "Descripción del producto.",
    "cantidad": 100,
    "precio": 29.99,
    "costo": 19.99
}
```

La estructura del JSON es la siguiente:

- `"stockid"`: Es una cadena de caracteres compuesta únicamente por letras y números. Este es un identificador único para cada producto.
- `"nombre"`: Es una cadena de caracteres que representa el nombre del producto.
- `"descripcion"`: Es una cadena de caracteres que proporciona una descripción del producto.
- `"cantidad"`: Es un número entero que indica la cantidad del producto en inventario.
- `"precio"`: Es un número decimal que representa el precio de venta del producto.
- `"costo"`: Es un número decimal que representa el costo de producción del producto.

### Estatus de la petición

Las respuestas posibles a las peticiones de esta API son las siguientes:

- `200`: Esta es la respuesta estándar para las peticiones correctas. Si la operación fue exitosa, se devolverá este código.
- `400`: Este código se devuelve cuando la petición no se ha podido procesar debido a que los parámetros están incorrectos.
- `404`: Este código se devuelve cuando el recurso solicitado no se encuentra. En el caso de esta API, se devolvería este código si el producto con el ID especificado no existe en la base de datos.

### Respuestas de la petición

Al crear un producto, si la operación es exitosa y el estado es `200`, la API devolverá un JSON como este:

```jsx
{
    "stockid": "A123B456",
    "nombre": "Producto Ejemplo",
    "descripcion": "Descripción del producto.",
    "cantidad": 100,
    "precio": 29.99,
    "costo": 19.99,
    "id": 12
}
```

Donde el `"id"` es el identificador único que la base de datos asigna al producto nuevo.

Si el estado es `400`, la API devolverá un JSON como este, donde en este caso indica que el error se encuentra en el parámetro ***stockid***, debido a que ya existe en la base de datos y no se puede utilizar para un producto nuevo:

```jsx
{
    "error": true,
    "message": {
        "stockid": [
            "The stockid has already been taken."
        ]
    }
}
```

Para el estado `404`, la API devolverá un JSON como este:

```jsx
{
    "error": true,
    "message": "Producto no encontrado"
}
```

# API de Movimientos

## Endpoints

```jsx
  POST            api/movimientos
  GET|HEAD        api/movimientos/{producto}
```

## Descripción

Los endpoints de la API de Movimientos permiten realizar varias operaciones en relación a los movimientos de los productos.

- `POST api/movimientos` se utiliza para registrar un nuevo movimiento de un producto.
- `GET|HEAD api/movimientos/{producto}` se utiliza para obtener la lista de todos los movimientos de un producto específico.

Donde el parámetro `{producto}` corresponde al ***stockid*** del producto.

### Cuerpo de la petición

El cuerpo de la petición para registrar un nuevo movimiento de un producto es el siguiente:

```jsx
{
    "stockid": "NToFLMRKlh",
    "tipo": "entrada",
    "cantidad": 10,
    "fecha": "2005-11-04",
    "costo": 8.2,
    "precio": 8.2
}

```

La estructura del JSON es la siguiente:

- `"stockid"`: Es una cadena de caracteres compuesta únicamente por letras y números. Este es un identificador único para cada producto.
- `"tipo"`: Es una cadena de caracteres que indica el tipo de movimiento, puede ser "entrada" o "salida".
- `"cantidad"`: Es un número entero que indica la cantidad del producto que entra o sale del inventario.
- `"fecha"`: Es una fecha que indica cuando el movimiento fue efectuado.
- `"costo"`: Es un número decimal que representa el costo de producción del producto.
- `"precio"`: Es un número decimal que representa el precio de venta del producto.

### Respuestas de la petición

Al registrar un movimiento, si la operación es exitosa y el estado es `200`, la API devolverá un JSON como este:

```jsx
{
    "tipo": "entrada",
    "cantidad": 10,
    "fecha": "2005-11-04",
    "precio": 8.2,
    "costo": 8.2,
    "producto_id": 10,
    "id": 101
}

```

Donde el `"id"` es el identificador único que la base de datos asigna al movimiento nuevo.

Si el estado es `400`, la API devolverá un JSON como este:

```jsx
{
    "error": true,
    "message": {
        "stockid": [
            "The selected stockid is invalid."
        ]
    }
}
```

# Colecciones de Postman

[Inventario Productos.postman_collection.json](https://file.notion.so/f/f/6106ee94-373a-4d40-8ff1-d315a1a6398f/2dd78972-f2da-4b4e-8e5a-7de93afd27cb/Inventario_Productos.postman_collection.json?table=block&id=52758db4-6bcc-4dc0-889e-77137ea34b9a&spaceId=6106ee94-373a-4d40-8ff1-d315a1a6398f&expirationTimestamp=1723147200000&signature=6Awl6Y6nFG4HY19xcNSFKe1jYJkchfBpRghwVNHUELI&downloadName=Inventario+Productos.postman_collection.json)