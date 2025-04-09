# Documentación de la API RESTful con Laravel

## 1. Introducción
Esta documentación describe cómo configurar y utilizar la API RESTful desarrollada con Laravel. La API permite gestionar productos y precios en diferentes divisas, y está protegida con JWT para asegurar el acceso.

## 2. Configuración Inicial
### Ejecutar Docker Compose
Asegúrate de tener Docker y Docker Compose instalados. Ejecuta el siguiente comando para iniciar los contenedores y ejecutar las migraciones y seeds automáticamente:
```bash
docker-compose up -d
```

## 3. Autenticación
La API utiliza JWT para la autenticación. Para obtener un token JWT, realiza una solicitud POST a la ruta `/login` con las credenciales de usuario.

**Endpoint**: `POST /api/login`

**Cuerpo de la Solicitud**:
```json
{
    "email": "tu-correo@example.com",
    "password": "tu-contraseña"
}
```

**Respuesta Exitosa**:
```json
{
    "access_token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

## 4. Variables de Entorno en Insomnia
### Guardar el Token JWT
Después de obtener el token JWT, guárdalo en una variable de entorno en Insomnia:
1. Ve a `Environment` en Insomnia.
2. Crea una variable llamada `Token` con el valor del token obtenido.

### Usar la Variable de Entorno
En las solicitudes protegidas, incluye el encabezado `Authorization` con el valor `Bearer {{Token}}`.

## 5. Endpoints de la API
### Productos
- **GET /api/products**: Obtener lista de productos.
- **POST /api/products**: Crear un nuevo producto.
- **GET /api/products/{id}**: Obtener un producto por ID.
- **PUT /api/products/{id}**: Actualizar un producto.
- **DELETE /api/products/{id}**: Eliminar un producto.

### Precios de Productos
- **GET /api/products/{id}/prices**: Obtener lista de precios de un producto.
- **POST /api/products/{id}/prices**: Crear un nuevo precio para un producto.

## 6. Ejemplos de Uso
### Obtener Lista de Productos
**Solicitud**:
- **Método**: `GET`
- **URL**: `http://localhost:8080/api/products`
- **Encabezados**:
  - `Authorization`: `Bearer {{Token}}`
  - `Accept`: `application/json`

**Respuesta**:
```json
[
    {
        "id": 1,
        "name": "Producto 1",
        "description": "Descripción del producto 1",
        "price": 100.00,
        "currency_id": 1,
        "tax_cost": 10.00,
        "manufacturing_cost": 80.00
    }
]
```

### Crear un Nuevo Producto
**Solicitud**:
- **Método**: `POST`
- **URL**: `http://localhost:8080/api/products`
- **Encabezados**:
  - `Authorization`: `Bearer {{Token}}`
  - `Content-Type`: `application/json`
  - `Accept`: `application/json`
- **Cuerpo**:
  ```json
  {
      "name": "Nuevo Producto",
      "description": "Descripción del nuevo producto",
      "price": 150.00,
      "currency_id": 1,
      "tax_cost": 15.00,
      "manufacturing_cost": 120.00
  }
  ```

**Respuesta**:
```json
{
    "message": "Producto creado con exito."
}
```

### Crear un Precio para un Producto
**Solicitud**:
- **Método**: `POST`
- **URL**: `http://localhost:8080/api/products/1/prices`
- **Encabezados**:
  - `Authorization`: `Bearer {{Token}}`
  - `Content-Type`: `application/json`
  - `Accept`: `application/json`
- **Cuerpo**:
  ```json
  {
      "currency_id": 2,
      "price": 180.00
  }
  ```

**Respuesta**:
```json
{
    "message": "Precio creado con exito"
}
```

## 7. Gestión de Errores
La API devuelve respuestas JSON con mensajes de error descriptivos.

## 8. Pruebas con Insomnia
1. **Importar el Archivo de Insomnia**:
   - Exporta el archivo de Insomnia con los endpoints configurados.
   - Importa este archivo en tu cliente de Insomnia para acceder rápidamente a todos los endpoints.

2. **Configurar Variables de Entorno**:
   - Asegúrate de que las variables de entorno estén correctamente configuradas para facilitar la gestión de tokens y URLs.

## 9. Conclusión
Esta documentación proporciona una guía completa para configurar y utilizar la API RESTful desarrollada con Laravel. Si tienes alguna pregunta o encuentras algún problema, no dudes en contactarme.

## ElyJColmenarez@Gmail.com
