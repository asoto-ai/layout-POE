# Plataforma OE

La **Plataforma OE** es un sistema modular desarrollado para la gestión
de Olimpiadas Especiales Chile.\
Integra **PHP, MySQL y Google APIs (Sheets, Drive, Calendar)** para
brindar herramientas de sistematización,\
gestión de datos y soporte institucional.

------------------------------------------------------------------------

## 🚀 Características principales

-   Generación automática de módulos CRUD con sincronización
    bidireccional MySQL ↔ Google Sheets.
-   Formularios dinámicos con edición inline y sincronización inmediata.
-   Integración con Google Drive y gestión documental mediante cuentas
    de servicio.
-   Respaldo automatizado con `rclone` y cron jobs.
-   Arquitectura modular basada en **framework OE**, adaptable a nuevos
    proyectos y clientes.
-   Soporte para perfiles y roles de usuario (público, aliado,
    administrador).

------------------------------------------------------------------------

## 📂 Estructura del proyecto

-   `/modulos` → módulos generados automáticamente (CRUD + Grid).
-   `/config` → configuración de base de datos y autenticación.
-   `/plantilla_base` → templates de generación automática
    (`formulario_template.php`, `grilla_template.php`, etc.).
-   `/cred` → credenciales de Google (ej. `credencialesGoogle.json`).
-   `/cron` → scripts de respaldo y automatización.

------------------------------------------------------------------------

## ⚙️ Requisitos

-   PHP 8.1+
-   MySQL 8.0+
-   Servidor con soporte para cron jobs
-   Cuenta de servicio en Google Cloud con acceso a:
    -   Google Sheets API
    -   Google Drive API
    -   Google Calendar API

------------------------------------------------------------------------

## 🔧 Instalación

1.  Clonar el repositorio:

    ``` bash
    git clone https://github.com/asoto-ai/layout-POE.git
    cd layout-POE
    ```

2.  Configurar base de datos en `config/db.php`.

3.  Colocar credenciales de Google en `/cred/credencialesGoogle.json`.

4.  Generar módulos CRUD automáticamente:

    ``` bash
    php generador_modulos/3_generar_crud.php
    ```

5.  Acceder a la plataforma desde el navegador en:

        http://localhost/layout-POE

------------------------------------------------------------------------

## 📜 Licencia

Este proyecto está protegido por la **Business Source License 1.1
(BSL)**.

-   **Uso gratuito**: permitido para instituciones educativas y ONG.\
-   **Uso comercial**: requiere autorización expresa del Licenciante.\
-   Consulta el archivo [LICENSE](./LICENSE) para más detalles.

------------------------------------------------------------------------

## 👤 Autoría

Este proyecto ha sido desarrollado por **Alfonso Soto**.\
Todos los derechos de propiedad intelectual y de autoría se mantienen
con el Licenciante.\
La licencia aplicada (BSL 1.1) regula el uso externo, pero **no
transfiere la autoría ni la titularidad del código**.

------------------------------------------------------------------------

## 📬 Contacto

-   📧 Email: <asoto@olimpiadasespecialeschile.org>\
-   🌐 Sitio web: <https://poe.olimpiadasespecialeschile.net>
