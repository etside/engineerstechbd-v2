const API_BASE = (typeof window !== 'undefined' && window.ET_API_BASE) || 'https://api.engineerstechbd.com/api';

export function escapeHtml(str) {
  if (str == null) return '';
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}

function getToken() { return localStorage.getItem('et_token'); }
function setToken(t) { localStorage.setItem('et_token', t); }
function clearToken() { localStorage.removeItem('et_token'); }

async function api(method, path, body, auth = false) {
  const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
  if (auth) headers['Authorization'] = 'Bearer ' + getToken();
  const res = await fetch(API_BASE + path, {
    method,
    headers,
    body: body ? JSON.stringify(body) : undefined
  });
  if (!res.ok) {
    const err = await res.json().catch(() => ({}));
    throw Object.assign(new Error(err.message || 'Request failed'), { status: res.status, data: err });
  }
  return res.status === 204 ? null : res.json();
}

const ET = {
  baseURL: API_BASE.replace(/\/api\/?$/, ''),
  get:    (path, auth) => api('GET', path, null, auth),
  post:   (path, body, auth) => api('POST', path, body, auth),
  put:    (path, body, auth) => api('PUT', path, body, auth),
  patch:  (path, body, auth) => api('PATCH', path, body, auth),
  del:    (path, auth) => api('DELETE', path, null, auth),
  getToken, setToken, clearToken,
  isLoggedIn: () => !!getToken(),

  // Public
  getTestimonials: () => ET.get('/testimonials'),
  getTeam:         () => ET.get('/team'),
  getBlog:         () => ET.get('/blog'),
  getLogos:        () => ET.get('/logos'),
  getServices:     () => ET.get('/services'),
  getProducts:     () => ET.get('/products'),
  getProjects:     () => ET.get('/projects'),
  getPortfolio:    () => ET.get('/portfolio'),
  postContact:     (data) => ET.post('/contact', data),

  // Auth
  login:  (email, password) => ET.post('/auth/login', { email, password }),
  logout: () => ET.post('/auth/logout', {}, true),

  // Admin
  stats: () => ET.get('/admin/stats', true),
  adminGet:  (r) => ET.get(`/admin/${r}`, true),
  adminPost: (r, d) => ET.post(`/admin/${r}`, d, true),
  adminPut:  (r, id, d) => ET.put(`/admin/${r}/${id}`, d, true),
  adminDel:  (r, id) => ET.del(`/admin/${r}/${id}`, true),
  adminPatch:(r, id, d) => ET.patch(`/admin/${r}/${id}`, d, true),

  // File upload (multipart)
  upload: async (file) => {
    const fd = new FormData(); fd.append('file', file);
    const res = await fetch(API_BASE + '/admin/upload', {
      method: 'POST',
      headers: { 'Authorization': 'Bearer ' + getToken(), 'Accept': 'application/json' },
      body: fd
    });
    if (!res.ok) throw new Error('Upload failed');
    return res.json();
  }
};

export default ET;
