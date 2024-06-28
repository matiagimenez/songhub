## SongHub: sitio web de reviews de Música (Inspiracion: [Letterbox](https://letterboxd.com/))

### [Autores](https://github.com/matiasgimenezdev/trabajo-integrador-paw/blob/main/docs/AUTHORS.md)

### [Instrucciones de ejecucion](https://github.com/matiasgimenezdev/trabajo-integrador-paw/blob/main/docs/INSTRUCTIONS.md)

### 1. Visión general

La propuesta es desarrollar un sitio web que combine características de un blog y una red social, permitiendo a los usuarios realizar reviews de música, ya sea sobre canciones o álbumes. El objetivo principal es brindar a los usuarios una plataforma interactiva donde puedan compartir sus opiniones sobre música y descubrir nuevas recomendaciones a partir de las opiniones de otros usaurios.

#### Funcionalidades

El presupuesto funcional es estimado y entendemos que podria variar ante problemas que seguramente encontremos durante la implementación y cualquier requisito adicional que pueda surgir durante el proceso.

1. Registro de usuarios (tiempo estimado: 5 días)

    - Creación de cuentas de usuario (nombre de usuario, dirección de correo electrónico y contraseña).
    - Verificación de correo electrónico para validar las cuentas de usuario.
    - Login de usuarios en sus cuentas.
    - Modificación de password.
    - Recuperación de password.

2. Perfiles de usuario (tiempo estimado: 6 días)

    - Páginas de perfil para cada usuario: debe poder agregar información personal, una descripción y hasta 3 álbumes y/o canciones favoritas.
    - Listado de todas los posts realizados por el usuario.
    - Se podrán filtrar los posts del usuario. Por defecto se ordenan cronológicamente (más recientes) y se podrá filtrar por artista/nombre/valoración.

3. Búsqueda y navegación (tiempo estimado: 6 dias)

    - Funcionalidad de búsqueda para encontrar canciones, álbumes, y artistas.
    - Filtro de resultado de búsqueda en base a canción, artista, álbum, género y año de lanzamiento.
    - Resultados separados por sección (canciones y álbumes).
    - En la página de “Explorar” se muestran recomendaciones personalizadas al usuario en base a su actividad en Spotify.

4. Creación de reviews (tiempo estimado: 7 o más días)

    - Un usuario debe poder escribir y publicar reviews sobre canciones o álbumes. Debe poder incluir calificaciones, algunos comentarios y tags que considere relevantes.
    - Las reviews pueden ser privadas (solo visibles por el usuario) o publicas (visibles por todo el mundo).
    - Si la valoración es mayor a 4 puntos, agregar a los me gusta del usuario en Spotify.

5. Interacción social (tiempo estimado: 7 o más días)
    - Comentarios en las reviews para fomentar la participación y el debate.
    - Sistema de me gustas en los posts realizados por otro usuario.
    - Un usuario debe poder comenzar/dejar de seguir a otro usuario dentro de Songhub.
    - Compartir las reviews en redes sociales (por ejemplo: Twitter) para fomentar la difusión y generar interacciones.

##### Tiempo total de trabajo estimado: 1 mes

#### Otras consideraciones

-   Diseño y experiencia de usuario:
    -   Diseñar una interfaz de usuario atractiva y usable que proporcione una experiencia agradable para los usuarios tanto en navegadores móviles como de escritorio.
    -   Implementar un diseño responsivo que se adapte a diferentes tamaños de pantalla y dispositivos.
-   Seguridad:

    -   El sitio web cumplirá con las mejores prácticas de seguridad, como protección contra ataques de inyección SQL y cross-site scripting (XSS).
    -   Realizar una validación adecuada de los datos ingresados por los usuarios para prevenir ataques y asegurar la integridad de la información.
    -   Implementar validaciones en el lado del servidor y del cliente para garantizar que los datos cumplan con los requisitos especificados.

-   Integración de APIs de música:

    -   Existe la posibilidad de integrar APIs de servicios de música ([Spotify API](https://developer.spotify.com/documentation/web-api)) para obtener información actualizada sobre canciones y álbumes (por ejemplo, imagenes)

-   Documentación y despliegue:
    -   Crear una documentación clara que especifique los requisitos y los pasos necesarios para el despliegue del sitio web.
    -   Proporcionar instrucciones detalladas sobre cómo configurar el entorno de desarrollo, instalar las dependencias y ejecutar la aplicación en el entorno de producción.

### 2. Sitemap

![sitemap](https://github.com/matiasgimenezdev/songhub/assets/117539520/1fc060ff-731d-4397-bda8-a24eb6673d52)

### 3. Wireframes

Se encuentran en el siguiente [proyecto](https://www.figma.com/team_invite/redeem/8gsvLe0YYBM4Q47UAvpgqo) Figma. Es el mismo proyecto que utilizamos para las practicas de la cursada, por lo tanto, hay posibilidad de que algun docente tenga acceso al mismo.

### 4. [Modelo de datos](https://drive.google.com/file/d/13X7mGucqO1l9EiWeonvWR7GnOXmyRzrF/view?usp=sharing)

### 5. [Diagrama de clases](https://drive.google.com/file/d/1HtCK7KejQNIDRchia1vwpbA9fTwMlj8Q/view?usp=sharing)
