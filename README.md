# Trabajo práctico integrador - Programacion en Ambiente Web 2023

## Sitio web de reviews de Música (Inspiracion: [Letterbox](https://letterboxd.com/))

### Visión general:
La propuesta es desarrollar un sitio web que combine características de un blog y una red social, permitiendo a los usuarios realizar reviews de música, ya sea sobre canciones o álbumes. El objetivo principal es brindar a los usuarios una plataforma interactiva donde puedan compartir sus opiniones sobre música y descubrir nuevas recomendaciones a partir de las opiniones de otros usaurios.

### Funcionalidades:
El presupuesto funcional es estimado y entendemos que podria variar ante problemas que seguramente encontremos durante la implementación y cualquier requisito adicional que pueda surgir durante el proceso.

1. Registro de usuarios (tiempo estimado: 5 días)
   - Creación de cuentas de usuario con nombre de usuario, dirección de correo electrónico y contraseña.
   - Verificación de correo electrónico para validar las cuentas de usuario.
   - Login de usuarios en sus cuentas.

2. Perfiles de usuario (tiempo estimado: 6 días)
   - Páginas de perfil para cada usuario, donde puedan agregar información personal y una foto de perfil.
   - Listado de todas los posts realizados por el usuario.

3. Búsqueda y navegación (tiempo estimado: 6 dias)
   - Funcionalidad de búsqueda para encontrar canciones o álbumes específicos.
   - Categorización de música por género, artista, álbum y año de lanzamiento.

4. Creación de reviews (tiempo estimado: 7 o más días)
   - Un usuario debe poder escribir y publicar reviews sobre canciones o álbumes.
   - En un post de este estilo debe poder incluir calificaciones, algun comentarios y etiquetas relevantes.

5. Interacción social (tiempo estimado: 7 o más días)
   - Comentarios en las reviews para fomentar la participación y el debate.
   - Sistema de me gustas/favoritos en los posts realizados por otro usuario.
   - Compartir las reviews en redes sociales como Twitter ([Twitter API](https://developer.twitter.com/en/docs/twitter-api) para autenticar a los usuarios y publicar tweets en su nombre).
 
 #### Tiempo total de trabajo estimado: 1 mes
 
 ### Otras consideraciones
 - Diseño y experiencia de usuario:
   - Diseñar una interfaz de usuario atractiva y usable que proporcione una experiencia agradable para los usuarios tanto en navegadores móviles como de escritorio.
   - Implementar un diseño responsivo que se adapte a diferentes tamaños de pantalla y dispositivos.
   - 
- Seguridad:
   - El sitio web cumplirá con las mejores prácticas de seguridad, como protección contra ataques de inyección SQL y cross-site scripting (XSS).
   - Realizar una validación adecuada de los datos ingresados por los usuarios para prevenir ataques y asegurar la integridad de la información.
   - Implementar validaciones en el lado del servidor y del cliente para garantizar que los datos cumplan con los requisitos especificados.

- Integración de APIs de música:
   - Existe la posibilidad de integrar APIs de servicios de música ([Spotify API](https://developer.spotify.com/documentation/web-api)) para obtener información actualizada sobre canciones y álbumes (por ejemplo, imagenes)

- Documentación y despliegue:
   - Crear una documentación clara que especifique los requisitos y los pasos necesarios para el despliegue del sitio web.
   - Proporcionar instrucciones detalladas sobre cómo configurar el entorno de desarrollo, instalar las dependencias y ejecutar la aplicación en el entorno de producción.
