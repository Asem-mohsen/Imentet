<p align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Grand_Egyptian_Museum_Logo.png/320px-Grand_Egyptian_Museum_Logo.png" width="120" alt="Imentet Logo">
</p>

<h1 align="center">Imentet: Cultural Gateway to Egypt</h1>

<p align="center">
  A dual-portal Laravel platform for the <strong>Pyramids Area</strong> and the <strong>Grand Egyptian Museum</strong>, built with <a href="https://laravel.com" target="_blank">Laravel</a>, <a href="https://filamentphp.com" target="_blank">Filament</a> Admin, and Blade templates.
</p>

---

## 🌍 Overview

**Imentet** is a cultural and digital bridge that connects global visitors with Egypt’s greatest heritage sites. It comprises two interconnected websites:

- **Pyramids Area Portal**
- **Grand Egyptian Museum Portal**

Each portal is fully featured with:

- 🎟️ **Online Ticket Reservation**
- 🛍️ **E-Commerce for Souvenirs & Artifacts**
- 🎫 **Memberships & Visitor Features**
- 🚍 **On-site Transportation Options**
- 🗓️ **Event Listings & Bookings**
- 🏛️ **Digital Collections Showcase**
- 💳 **Donation System**
- 📰 **Blog & News Feed**
- 🔐 **Authentication System**

---

## 🛠️ Built With

- **Laravel** – PHP framework for robust backend logic.
- **Filament Admin** – Admin dashboard and management interface.
- **Blade Templates** – MVC-based dynamic front-end.
- **Spatie Packages** – Permissions, Translations, Media Library, etc.
- **MySQL** – Relational database backend.
- **Stripe** – Payment and donation processing.

---

## 🎥 Demo

You can watch a short 3-minute demo of the dashboard and website [here](#) *(Add your YouTube or LinkedIn post link)*.

---

## 👤 Author

Developed by **Asem Mohsen**

- [LinkedIn](https://www.linkedin.com/in/assem-m-89a61414b/)
- [GitHub](https://github.com/Asem-mohsen)

Special thanks to **Mr. Naguib Sawiris**, a visionary behind the development of the Pyramids Area, whose work continues to inspire this digital transformation.

---

## 📦 Installation (Developer Setup)

```bash
git clone https://github.com/Asem-mohsen/Imentet.git
cd Imentet
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
