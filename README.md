# TheTinyURLs

TheTinyURLs is a web-based URL shortening service that allows users to quickly convert long URLs into short, shareable links. The platform offers features such as user authentication, link management, analytics, and various policy pages for compliance and transparency.

## Features

- **URL Shortening:** Instantly shorten long URLs for easy sharing.
- **User Accounts:** Sign up, log in, and manage your own shortened links.
- **Dashboard:** View and manage all your generated URLs.
- **Analytics:** Track clicks and performance of your shortened URLs.
- **Security:** Secure user authentication and HTTPS support.
- **Policy Pages:** Includes Privacy Policy, Terms of Service, Cookie Policy, DMCA Policy, Refund Policy, and more.
- **Contact Form:** Users can reach out for support or inquiries.
- **Responsive Design:** Mobile-friendly and modern UI using Bootstrap.

## Project Structure

```
/
├── about.php
├── accaptable.php
├── accounttermination.php
├── chargeback.php
├── contact.php
├── cookie.php
├── dashboard.php
├── db.php
├── dmcapolicy.php
├── email_logic.php
├── faq.php
├── footer.php
├── forgot_password_backend.php
├── forgot_password.php
├── header.php
├── index.php
├── linkretention.php
├── login.php
├── logout.php
├── privacy.php
├── redirect.php
├── refund.php
├── reset_password_backend.php
├── reset_password.php
├── security.php
├── shorten.php
├── signup.php
├── term.php
├── termofservice.php
├── app/
│   └── thetinyurls.sql
├── assests/
├── css/
│   └── style.css
├── js/
└── .htaccess
```

## Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL/MariaDB
- Web server (Apache recommended)
- Composer (optional, if you want to manage dependencies)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/thetinyurls.git
   cd thetinyurls
   ```

2. **Database Setup:**
   - Import the SQL file located at `app/thetinyurls.sql` into your MySQL database.
   - Update the database connection settings in [`db.php`](db.php) with your credentials.

3. **Configure Web Server:**
   - Ensure `.htaccess` is enabled for URL rewriting (mod_rewrite for Apache).
   - Set your document root to the project directory.

4. **Assets & Dependencies:**
   - All CSS and JS dependencies are included via CDN or in the `css/` and `js/` folders.

### Usage

- Visit `index.php` to access the homepage and start shortening URLs.
- Register for an account via `signup.php` to manage your links and access the dashboard.
- Use the dashboard to view analytics and manage your URLs.
- Access policy and support pages from the footer or navigation bar.

### Customization

- Update branding assets in the `assests/` folder.
- Modify styles in [`css/style.css`](css/style.css).
- Adjust policy text in the respective PHP files.

## License

This project is licensed by Green Bills Inc. See the individual file headers for more information.

## Contact

For support or inquiries, email: [support@thetinyurls.com](mailto:support@thetinyurls.com)

---

**Note:** This project is for demonstration and educational purposes. Please review and update security, privacy, and compliance features before deploying to production.