# engineersTech — v2 Clean Build

Static frontend + Admin CMS for **engineerstechbd.com**.  
Backend API: Laravel (see `/backend`). Frontend: plain HTML/CSS/JS — no build step required.

---

## Folder Structure

```
engineerstechbd-v2/
├── index.html               # Homepage
├── about.html
├── services.html
├── enterprise.html
├── products.html
├── portfolio.html           # JS-rendered portfolio grid + case study modal
├── blog.html
├── team.html
├── testimonials.html
├── case-studies.html
├── contact.html             # Contact form + RFP + SLA section
├── career.html
├── faq.html
├── privacy-policy.html
├── terms.html
├── data-protection-policy.html
├── admin.html               # ← Full CMS admin panel
├── assets/
│   ├── style.css            # Complete design system (1367 lines)
│   ├── et-overrides.css     # Final-word overrides (57 lines)
│   ├── nav.js               # Shared nav+footer injector + AOS + scroll
│   ├── api.js               # ET API client (fetch wrapper, auth, all endpoints)
│   ├── cms.js               # Shared CMS engine (toast, modal, CRUD helpers)
│   └── logo.svg + images…
├── backend/                 # Laravel API
│   ├── routes/api.php
│   ├── app/Http/Controllers/
│   └── …
├── favicon.svg
├── sitemap.xml
└── README.md
```

---

## Admin CMS — `admin.html`

### Access
Navigate to `/admin.html`. Login with your admin credentials (JWT via `POST /api/auth/login`).

### Sections

| Section | API Resource | Operations |
|---|---|---|
| Dashboard | `/admin/stats` | Stats overview, recent messages, quick links |
| Portfolio | `/admin/portfolio` | Add / Edit / Delete projects |
| Blog | `/admin/blog` | Add / Edit / Delete posts (draft/published) |
| Team | `/admin/team` | Add / Edit / Delete members |
| Testimonials | `/admin/testimonials` | Add / Edit / Delete reviews |
| Services | `/admin/services` | Add / Edit / Delete service entries |
| Messages | `/admin/messages` | View / Read / Reply (opens mailto) |
| Settings | `/admin/settings` | Site name, contact info, password change |

### Auth Flow
1. `POST /api/auth/login` → receives `{ token }` → stored in `localStorage`
2. All admin API calls send `Authorization: Bearer <token>`
3. "Remember me" saves email to localStorage
4. On page load, if token exists → auto-calls `GET /api/auth/me` to restore session

---

## Shared JS Modules

### `assets/nav.js`
Injected via `<script src="assets/nav.js" defer>` on every page.  
- Injects full `<nav>` + `<footer>` + WhatsApp FAB + Back-to-top button  
- Marks current page as active in nav  
- Handles mobile menu toggle, scroll effects, AOS reveal observer  
- Sets footer year automatically

### `assets/api.js`
ES module. Import: `import ET from './assets/api.js'`  
Key methods:
```js
ET.login(email, password)        // POST /auth/login
ET.getPortfolio()                // GET /portfolio (public)
ET.postContact(data)             // POST /contact (public)
ET.adminGet('portfolio')         // GET /admin/portfolio (auth)
ET.adminPost('portfolio', data)  // POST /admin/portfolio (auth)
ET.adminPut('portfolio', id, d)  // PUT /admin/portfolio/:id (auth)
ET.adminDel('portfolio', id)     // DELETE /admin/portfolio/:id (auth)
ET.adminPatch('messages', id, d) // PATCH /admin/messages/:id (auth)
ET.upload(file)                  // POST /admin/upload (multipart, auth)
```

### `assets/cms.js`
ES module. Helper utilities for admin pages.  
Exports: `toast`, `openModal`, `closeModal`, `confirmDelete`, `renderTable`, `formValues`, `fillForm`, `badge`, `loadSection`

---

## API Base URL

Configured in `assets/api.js`:
```js
const API_BASE = window.ET_API_BASE || 'https://api.engineerstechbd.com/api';
```

Override per-environment by setting `window.ET_API_BASE` before loading the module, or edit the constant directly.

---

## Design System

- **Colors:** `--bg: #050d1a` · `--blue: #0058cc` → `--blue-end: #2483ff`
- **Fonts:** DM Sans (headings) · Inter (body)
- **CSS variables:** defined in `:root` in `style.css`
- **Animations:** `.aos` class + IntersectionObserver in `nav.js`
- **Glass card:** `.glass` utility class (backdrop-filter blur)

---

## Deployment

1. Upload all files to web root (public_html or equivalent)
2. Ensure `backend/` is served at `/api/` or set `window.ET_API_BASE`
3. `admin.html` should be protected at server level (HTTP auth or IP whitelist) in addition to the JWT login
4. Set `meta name="robots" content="noindex"` is already on `admin.html`
