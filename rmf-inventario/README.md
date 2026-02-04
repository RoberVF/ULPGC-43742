# RMF Inventory - Sistema de Gestión de Stock Profesional

**RMF Inventory** es un ecosistema ERP Lite diseñado para la gestión avanzada de inventarios, desarrollado bajo el **stack TALL** (Tailwind v4, Alpine.js, Laravel 12, Livewire) y potenciado por **Filament**. 

[cite_start]Este proyecto se enmarca en el desarrollo práctico de la asignatura **Programación Web** (4º curso - GITT) de la **ULPGC**[cite: 14]. [cite_start]Su objetivo principal es dar soporte a un desarrollo más sostenible, alineándose con el **Objetivo de Desarrollo Sostenible 12** (Producción y Consumo Responsables).

---

## 🚀 Características del Sistema

* **Arquitectura Multipanel:** Separación estricta de responsabilidades entre el panel de Administración (`/admin`) y el panel Operativo (`/app`).
* **Trazabilidad Total (Ledger-based):** El stock no es un valor estático; se calcula dinámicamente mediante el historial de movimientos, garantizando auditorías precisas.
* **Diseño Moderno:** Implementación de **Tailwind CSS v4** mediante el plugin de Vite para una compilación de alto rendimiento y estilos "CSS-first".
* **Seguridad Basada en Enums:** Uso de **Backed Enums** para la gestión de roles (`RoleType`) y tipos de movimientos (`StockMovementType`), evitando la rigidez de los ENUMs de base de datos tradicionales.
* **Acceso Restringido:** Implementación de la interfaz `FilamentUser` en el modelo `User` para controlar el acceso cruzado entre paneles.

---

## 🛠️ Stack Tecnológico

* **Framework:** Laravel 12.x
* **Backend UI:** Filament v3/v4 (Arquitectura Desacoplada)
* **Estilos:** Tailwind CSS v4 (Alpha/Beta) + PostCSS
* **Interactividad:** Livewire v3
* **Base de Datos:** SQLite (Entorno de desarrollo local)
* **Compilación:** Vite 6 + Plugin Tailwind v4

---

## 📂 Arquitectura de Código (Filament Pro Pattern)

Para garantizar la mantenibilidad, el proyecto utiliza un patrón de **desacoplamiento de componentes** en los recursos de Filament:

* **Schemas:** Clases dedicadas únicamente a la estructura de formularios (ej. `CategoryForm.php`).
* **Tables:** Clases dedicadas a la configuración de listados y acciones (ej. `CategoriesTable.php`).
* **Resources:** Actúan como directores de orquesta, gestionando rutas y permisos.



---

## 📊 Diseño de Datos (Bloque 6)

[cite_start]El diseño cumple con los requisitos de identificación de entidades y relaciones de integridad de la asignatura [cite: 151-153]:

| Entidad | Propósito | Atributos Clave |
| :--- | :--- | :--- |
| **User** | Gestión de acceso y auditoría. | `name`, `email`, `role` (Enum). |
| **Category** | Organización jerárquica del catálogo. | `name`, `slug` (unique). |
| **Product** | Definición técnica del inventario. | `sku` (unique), `prices`, `security_stock`. |
| **Warehouse** | Gestión multialmacén. | `name`, `location`. |
| **StockMovement** | Historial inmutable de existencias. | `quantity`, `type` (Enum), `user_id`. |



---

## ⚙️ Instalación y Configuración

1.  **Dependencias de Backend:**
    ```bash
    composer install
    ```
2.  **Dependencias de Frontend:**
    ```bash
    npm install
    ```
3.  **Configuración de Entorno:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Base de Datos y Datos de Prueba:**
    ```bash
    php artisan migrate --seed
    ```
5.  **Entorno de Desarrollo:**
    * Terminal 1: `php artisan serve`
    * Terminal 2: `npm run dev`

---

## 📅 Sprints del Proyecto (Práctica 1)

* [cite_start]**B1 a B4:** Desarrollo básico, rutas Laravel y plantillas Blade[cite: 11].
* [cite_start]**B5:** Introducción al proyecto global y creación del portal `miPortal/home` [cite: 146-148].
* [cite_start]**B6:** Diseño de base de datos validado con el profesor [cite: 151-154].

---

**Desarrollador:** Roberto Morales Fumero
**Curso:** 2025-2026
**Institución:** Escuela de Ingeniería de Telecomunicación y Electrónica (EITE)