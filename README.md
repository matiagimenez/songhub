## SongHub: sitio web de reviews de Música (Inspiracion: [Letterbox](https://letterboxd.com/))

### [Autores](https://github.com/matiasgimenezdev/trabajo-integrador-paw/blob/main/docs/AUTHORS.md)

### [Instrucciones de ejecucion](https://github.com/matiasgimenezdev/trabajo-integrador-paw/blob/main/docs/INSTRUCTIONS.md)

### Despliegue (es la misma aplicación disponible en dos lugares)

-   #### [Link 1](https://7053-191-80-113-188.ngrok-free.app)
-   #### [Link 2](https://e18a-190-15-233-40.ngrok-free.app)

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
    - Listado de todas los posts realizados por el usuario. Se ordenan cronológicamente (más recientes).

3. Búsqueda y navegación (tiempo estimado: 6 dias)

    - Funcionalidad de búsqueda para encontrar canciones, álbumes, y artistas.
    - Resultados separados por sección (canciones y álbumes).
    - En la página de “Explorar” se muestran recomendaciones personalizadas al usuario en base a su actividad en Spotify.

4. Creación de reviews (tiempo estimado: 7 o más días)

    - Un usuario debe poder escribir y publicar reviews sobre canciones o álbumes. Debe poder incluir calificaciones, alguna descripción y tags que considere relevantes.

5. Interacción social (tiempo estimado: 7 o más días)
    - Comentarios en las reviews para fomentar la participación y el debate.
    - Sistema de me gustas en los posts realizados por otro usuario.
    - Un usuario debe poder comenzar/dejar de seguir a otro usuario dentro de Songhub.

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
    -   Al momento de registrarse en nuestro sitio, el usuario debe asociar una cuenta personal de Spotify.
        <img src="https://github.com/user-attachments/assets/eae831f9-90d1-48b9-9044-fabb2fc90baa" width=500 height=500/>
    -   Existe la posibilidad de integrar APIs de servicios de música ([Spotify API](https://developer.spotify.com/documentation/web-api)) para obtener información actualizada sobre canciones y álbumes. Además, utilizamos la API para recomendar
        contenido al usuario en función de su actividad en la cuenta de Spotify asociada a su cuenta.

### 2. Sitemap

![sitemap](https://github.com/user-attachments/assets/98d7c59b-71ae-49d5-8f9f-c180585d100b)

### 3. Wireframes

Se encuentran en el siguiente [proyecto](https://www.figma.com/team_invite/redeem/8gsvLe0YYBM4Q47UAvpgqo) Figma. Es el mismo proyecto que utilizamos para las practicas de la cursada, por lo tanto, hay posibilidad de que algun docente tenga acceso al mismo.

### 4. [Modelo de datos](https://drive.google.com/file/d/13X7mGucqO1l9EiWeonvWR7GnOXmyRzrF/view?usp=sharing)
