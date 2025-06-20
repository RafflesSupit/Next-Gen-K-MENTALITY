# 🍽️ Maison Étoile

**Serving the best Indonesian food with authentic taste**

Sistem pemesanan makanan untuk restoran **Maison Étoile**, dibangun menggunakan **Laravel**, **MySQL**, **Tailwind CSS**, dan **Vanilla JavaScript**. Aplikasi ini mendukung pemesanan makanan, pengelolaan menu dan kategori, serta otorisasi berbasis peran (RBAC) untuk Super Admin, Admin, dan Customer.

---

## ✨ Fitur Unggulan

- Role-Based Access Control (Super Admin, Admin, Customer)
- Manajemen Menu & Kategori
- Pemesanan makanan dan riwayat pesanan
- Autentikasi pengguna & manajemen profil
- Tampilan modern dengan Tailwind CSS

---

## 🔐 Role & Permission

| Role        | Menu          | Category      | Order                    | User            | Profile               |
|-------------|---------------|---------------|--------------------------|------------------|------------------------|
| **Super Admin** | CRUD lengkap  | CRUD lengkap  | CRUD lengkap (termasuk Dine-in) | Read semua user | Update sendiri, CRUD Admin |
| **Admin**       | CRUD lengkap  | CRUD lengkap  | CRUD lengkap             | Read            | Update sendiri         |
| **Customer**    | Read only     | -             | Create, Read (milik sendiri) | -               | Update sendiri         |

---

## 🧱 Struktur Entitas

### 🧑 User
- `id`
- `name`
- `email`
- `password`
- `role` (super_admin, admin, customer)

### 🗂️ Category
- `id`
- `name`
- `description`

### 🍜 Menu
- `id`
- `name`
- `description`
- `price`
- `image`
- `category_id`

### 🧾 Order
- `id`
- `user_id`
- `total_amount`
- `status`
- `order_date`

### 🧺 Order_Item
- `id`
- `order_id`
- `menu_id`
- `quantity`
- `price`

---

## ⚙️ Teknologi yang Digunakan

- **Laravel** (backend & routing)
- **MySQL** (database relasional)
- **Tailwind CSS** (tampilan UI)
- **Vanilla JavaScript** (interaksi dinamis)

---

## 🖼️ Screenshot Landing Page

> Simpan file screenshot di `public/screenshots/landing-page.png`, lalu tampilkan di bawah ini:

![Landing Page](screenshots/landing-page.png)

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone https://github.com/username/maison-etoile.git
cd maison-etoile
