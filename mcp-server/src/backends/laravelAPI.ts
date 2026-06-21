import axios, { AxiosInstance } from 'axios';

const client: AxiosInstance = axios.create({
  baseURL: process.env.LARAVEL_API_BASE || 'https://api.engineerstechbd.com/api/v1',
  timeout: 10000,
  headers: {
    'Authorization': `Bearer ${process.env.LARAVEL_API_KEY || ''}`,
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

client.interceptors.response.use(
  r => r.data,
  err => { throw new Error(err.response?.data?.message || err.message || 'API error'); }
);

export const api = {
  get:  (path: string, params?: Record<string, unknown>) => client.get(path, { params }),
  post: (path: string, data: Record<string, unknown>) => client.post(path, data),
};
