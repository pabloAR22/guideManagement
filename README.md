# guideManagement
- Primero se debe clonar el repositorio, luego de clonarlo hacer un git checkout master.
- Se debe cambiar el .env para editar los parametros de conexión a DB
- Se deben correr las migraciones
- Se debe correr el comando php artisan db:seed. Este creará:
    - 2 roles: Mensajero = id 1, Administrador = id 2
    - 1 usuario , Celular = 350471, password = password.
    - 3 tipos diferentes de vehículos: Moto id 1, Carro id 2, Bicicleta id 3
## Guia de API´S
- login: Iniciar sesión, recibe el número de celular y la contraseña.
- Logout: Cerrar sesión, debes estar autenticado.
-Registar un usuario: Registra los usuarios en DB, recibe los parametros
    - name
    - lastname
    - cellphone
    - age
    - idRol
    - password
    - password_confirmation
- Si idRol = 1 se deben agregar los campos
    - plate
    - type
- Ver todos los usuarios: Lista todos los usuarios en formato JSON.
- Ver un usuario: Lista solo 1 usuario, se debe agregar el id del usuario del que se desea ver la información en la URL del API.
- Editar un usuario: se debe envioar el id del usuaroio a modificar en la URL de la API, recibe los mismos campos que el api de registrar usuarios en sus dos variantes.
- Eliminar usuarios: Recibe el id del usuario a eliminar en la URL de la API
- Asignar guía: Recibe como parametros:
    - nameGuide = alfanumerico
    - iddelivery = debe ser un id de un usuario registrado valido cuyo rol sea 1(mensajero).
- Eliminar guias asignadas: No recibe parametros, al hacer un request elimina todas las guias creadas.
- Exportar guias: Se debe ejecutar como send and download para que pueda descargar el archivo. Debido a limitaciones de Postman no se puede indicar previamente la extensión del archivo a descargar por lo que en el momneto que salga el explorador de archivos con el nombre de la guía se debe agregar la extensión .xlsx.
- VehiculoMasUsado: Devolvera el nombre del vehículo más usado por los nmensajeros, igulamente devolverá el número de veces usado.
guiasTotales: Devolverá el nombre del mensajero con más guías asignadas, igualmente el numero de estas.

