# 🌾 EcoMarket - Programacion Web

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![LunarPHP](https://img.shields.io/badge/LunarPHP-1.x-6C5CE7?style=for-the-badge&logo=php)
![Livewire](https://img.shields.io/badge/Livewire-Volt-4e70df?style=for-the-badge&logo=livewire)
![Stripe](https://img.shields.io/badge/Stripe-Payments-008cdd?style=for-the-badge&logo=stripe)

## 📋 Descripción

Esta plataforma es una solución de e-commerce "Farm-to-Table" diseñada para eliminar intermediarios en la cadena de suministro agrícola de **Gran Canaria**. Permite a los productores locales vender directamente al consumidor, gestionando no solo la transacción comercial, sino también la trazabilidad técnica de cada cosecha.

A diferencia de un e-commerce convencional, este sistema maneja **unidades de medida variables** (kg, cajas, unidades) e integra **datos de sensores** (temperatura y humedad) capturados en el momento de la recolección.

---

## 🚀 Stack Tecnológico

* **Core E-commerce:** [LunarPHP 1.x](https://lunarphp.io/) - Motor modular para la gestión de catálogo, carritos, órdenes e impuestos.
* **Backend:** [Laravel 12](https://laravel.com/) - El framework PHP más robusto y moderno.
* **Frontend:** [Livewire Volt](https://livewire.laravel.com/docs/volt) - Componentes reactivos con sintaxis funcional y anónima para una carga ultrarrápida.
* **UI/UX:** [Flux UI](https://fluxui.dev/) & [TailwindCSS](https://tailwindcss.com/) - Interfaz moderna, limpia y totalmente adaptativa.
* **Pagos:** [Stripe](https://stripe.com/) - Integración segura mediante Stripe Elements y Payment Intents API.

---

## ✨ Funcionalidades Principales

### 👨‍🌾 Gestión del Productor
* **Registro de Cosechas:** Formulario avanzado vinculado dinámicamente al inventario de LunarPHP.
* **Trazabilidad mediante Sensores:** Almacenamiento de condiciones ambientales (Humedad/Temperatura) de cada producto.
* **Control de Stock Dual:** Sincronización automática de inventario entre la producción y la variante comercial.

### 🛒 Experiencia del Consumidor
* **Marketplace Dinámico:** Compra por peso o unidades con validación de stock en tiempo real (prevención de overselling).
* **Carrito Transparente:** Cálculo detallado de `Cantidad x Precio/Unidad = Subtotal`.
* **Checkout Seguro:** Pasarela de pago integrada que gestiona automáticamente direcciones de envío y facturación de forma invisible para mejorar la conversión.

### 💳 Backend de Pagos y Lógica Post-Venta
* **Stripe Integration:** Cumplimiento de normativa PCI mediante el uso de tokens seguros.
* **Actualización Automatizada:** Al confirmar el pago, el sistema decrementa automáticamente el stock en todas las tablas relacionadas y actualiza el estado de la orden.

---

## 🏗️ Arquitectura Destacada

El proyecto destaca por su lógica desacoplada:
1.  **Modelo Híbrido:** Uso de modelos Eloquent personalizados (`Harvest`) que se inyectan en el flujo de trabajo de `ProductVariants` de Lunar.
2.  **Validación Estricta:** Implementación de validadores de Lunar para asegurar que ninguna orden se cree sin dirección de envío, facturación y método de transporte asignado.
3.  **Transacciones Atómicas:** El proceso de pago y actualización de stock está protegido por transacciones de base de datos para garantizar la integridad de los datos.

---

## 🛠️ Instalación

1.  **Clonar:** `git clone [url-del-repo]`
2.  **Dependencias:** `composer install && npm install && npm run build`
3.  **Variables de Entorno:** Configurar `STRIPE_PK` y `STRIPE_SECRET` en el `.env`.
4.  **Base de Datos y Semillas:**
    ```bash
    php artisan migrate
    php artisan db:seed --class=LunarCatalogSeeder
    ```
5.  **Servidor:** `php artisan serve`

---

## 📝 Autor

Proyecto desarrollado como parte de la formación técnica en la **Universidad de Las Palmas de Gran Canaria (ULPGC)**. Enfoque en arquitectura de software escalable y digitalización del sector primario.