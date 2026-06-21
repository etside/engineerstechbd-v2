import { Tool } from '@modelcontextprotocol/sdk/types.js';
import { api } from '../backends/laravelAPI.js';

export const serviceTools: Tool[] = [
  {
    name: 'get_services',
    description: 'List engineersTech services. Optionally filter by category.',
    inputSchema: {
      type: 'object',
      properties: {
        category: { type: 'string', description: 'e.g. ecommerce, saas, erp, mobile, uiux' },
        limit: { type: 'number', default: 6 },
      },
    },
    // @ts-ignore — handler attached by index
    handler: async (args: Record<string, unknown>) => {
      const data = await api.get('/services', { category: args.category, limit: args.limit || 6 });
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
  {
    name: 'get_service_details',
    description: 'Get full details of a specific service by ID or slug.',
    inputSchema: {
      type: 'object',
      required: ['service_id'],
      properties: {
        service_id: { type: 'string' },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const data = await api.get(`/services/${args.service_id}`);
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
  {
    name: 'recommend_services',
    description: 'Get AI-powered service recommendations based on business type and budget.',
    inputSchema: {
      type: 'object',
      required: ['business_type'],
      properties: {
        business_type: { type: 'string', description: 'e.g. retail, healthcare, fintech, restaurant' },
        budget_range:  { type: 'string', description: 'e.g. under-10k, 10k-50k, 50k-100k, 100k+' },
        goals:         { type: 'string', description: 'e.g. increase sales, automate operations' },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const data = await api.post('/recommendations/services', args);
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
];
