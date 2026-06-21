import { Tool } from '@modelcontextprotocol/sdk/types.js';
import { api } from '../backends/laravelAPI.js';

export const projectTools: Tool[] = [
  {
    name: 'get_projects',
    description: 'Browse engineersTech portfolio projects. Filter by industry.',
    inputSchema: {
      type: 'object',
      properties: {
        category: { type: 'string', description: 'e.g. saas, erp, mobile, web' },
        limit:    { type: 'number', default: 6 },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const data = await api.get('/projects', { category: args.category, limit: args.limit || 6 });
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
  {
    name: 'get_project_details',
    description: 'Get full case study details for a project by ID or slug.',
    inputSchema: {
      type: 'object',
      required: ['project_id'],
      properties: {
        project_id: { type: 'string' },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const data = await api.get(`/projects/${args.project_id}`);
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
];
