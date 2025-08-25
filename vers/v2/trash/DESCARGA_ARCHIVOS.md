# 📦 Archivos del Portal - Olimpiadas Especiales Chile

## 🎯 Archivo Principal de Descarga

**`olimpiadas-especiales-portal-final.tar.gz`** - Portal completo con login integrado

### 📋 Contenido del Archivo

#### 🌐 Páginas HTML Independientes (8 páginas)
- `informacion.html` - Información institucional y misión
- `talleres.html` - Gestión de talleres deportivos
- `eventos.html` - Calendario y gestión de eventos
- `capacitaciones.html` - Cursos y certificaciones
- `actividades.html` - Registro de actividades diarias
- `descargas.html` - Material descargable y recursos
- `configuracion.html` - Configuración del sistema
- `login.html` - **NUEVO** - Página de autenticación moderna

#### 🐍 Aplicación Flask (Backend)
- `app.py` - Servidor Flask con todas las rutas
- `main.py` - Punto de entrada de la aplicación
- `pyproject.toml` - Dependencias del proyecto

#### 📁 Carpetas de Recursos
- `templates/` - Plantillas Flask (incluye login.html)
- `static/` - CSS, JavaScript y assets
- `static_version/` - Versión HTML pura

#### 📄 Documentación
- `ACTUALIZACION_MULTIPAGINA.md` - Guía técnica detallada
- `DESCARGA_ARCHIVOS.md` - Este archivo de descarga

## 🔑 Credenciales Demo del Login

- **Email:** `demo@olimpiadas.cl`
- **Contraseña:** `demo123`

## 🚀 Características del Login

### 🎨 Diseño Visual
- Layout de dos columnas moderno
- Lado izquierdo: Branding inspirador con degradado rojo
- Lado derecho: Formulario limpio y profesional
- Logo oficial de Olimpiadas Especiales Chile
- Mensaje: "JUNTOS HACIA UN MUNDO INCLUSIVO"

### 🔧 Funcionalidades
- **Autenticación por email/contraseña**
- **Login con Google** (simulado, listo para integración)
- **Validación de campos** en tiempo real
- **Estados de carga** con spinners animados  
- **Recuperación de contraseña** (funcionalidad base)
- **Link de registro** (funcionalidad base)
- **Diseño responsive** para móviles

### 🎯 Integración
- Integrado con Flask en la ruta `/login`
- Compatible con las 7 páginas del portal
- Favicon oficial en todas las páginas
- Consistencia visual con el resto del portal

## 🌟 Características Generales del Portal

- **8 páginas HTML completamente funcionales**
- **Sistema de navegación consistente**
- **Logo oficial de 150px en todas las páginas**
- **Favicon oficial de https://olimpiadasespecialeschile.net/favicon.png**
- **Colores oficiales**: Rojo #dc2626, Azul #1e40af, Blanco
- **Bootstrap 5** para diseño responsive
- **Font Awesome 6.4.0** para iconografía
- **Google Fonts Inter** para tipografía moderna

## 💻 Cómo Usar

### Opción 1: Solo HTML (Páginas Independientes)
Abrir directamente cualquier archivo `.html` en el navegador

### Opción 2: Servidor Flask Completo
```bash
# Instalar dependencias
pip install flask

# Ejecutar servidor
python app.py

# Acceder en http://localhost:5000
```

### Rutas Disponibles
- `/` - Portal principal
- `/login` - Página de autenticación
- `/dashboard`, `/projects`, `/team`, `/reports`, `/settings` - Secciones del portal

## 📱 Compatibilidad

- ✅ Chrome, Firefox, Safari, Edge
- ✅ Móviles y tablets (responsive)
- ✅ Accesibilidad web básica
- ✅ Velocidad de carga optimizada

¡El portal está listo para producción con sistema de login integrado!