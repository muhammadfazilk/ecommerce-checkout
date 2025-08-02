# 💳 Laravel MasterCard Payment Gateway Integration (via Stripe)

This project is a simple Laravel 12 application that integrates a **MasterCard payment flow using Stripe**. It includes a basic checkout page, email notifications, a protected success page, and optional transaction storage.

---

## 🚀 Features

- ✅ Simple product checkout page
- ✅ Accept payments via MasterCard (using Stripe)
- ✅ Display success page with transaction info
- ✅ Store payment details in database
- ✅ Send email to customer

---

## 🛠 Tech Stack

- Laravel 12
- Stripe PHP SDK
- Laravel Blade
- Laravel Mail
- Middleware & Routing
- Optional Laravel Breeze

---

## 📂 Installation

1. **Clone the repository:**

```bash
git clone https://github.com/muhammadfazilk/ecommerce-checkout.git
cd ecommerce-checkout

2. **Install dependencies:**

composer install

3. **Set up .env file:**

cp .env.example .env
php artisan key:generate

4. **Configure database & Stripe keys in .env**

DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Ecommerce"

5. **Run migrations**

php artisan migrate

6. **Seed fake products:**

php artisan db:seed

🧪 Stripe Test Card (MasterCard)
Use this test card to simulate a successful MasterCard transaction:

Card Number: 5555 5555 5555 4444
Exp Date: Any future date (e.g., 12/34)
CVC: Any 3 digits (e.g., 123)

📄 Routes

| Route           | Description              |
| --------------- | ------------------------ |
| `/`             | Redirects to `/login`    |
| `/checkout`     | Checkout form            |
| `/pay`          | Handle Stripe payment    |
| `/success/{id}` | Success page (protected) |

🔐 Middleware

The CheckPayment middleware restricts access to /success/{id} if the payment is invalid or failed.

📧 Email

After successful payment, a email is sent using SMTP config from .env.

👨‍💻 Author

Name: Muhammad Fazil
Contact: muhammadfazildev@gmail.com







