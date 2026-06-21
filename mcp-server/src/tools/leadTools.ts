import { Tool } from '@modelcontextprotocol/sdk/types.js';
import { api } from '../backends/laravelAPI.js';
import { z } from 'zod';

const leadSchema = z.object({
  email:                z.string().email(),
  name:                 z.string().min(2),
  company:              z.string().optional(),
  service_interest:     z.string().optional(),
  budget_range:         z.string().optional(),
  platform_source:      z.string().optional(),
  conversation_summary: z.string().optional(),
  phone:                z.string().optional(),
});

export const leadTools: Tool[] = [
  {
    name: 'capture_lead',
    description: 'Capture a sales lead. Call this when a user expresses interest in services or requests a quote.',
    inputSchema: {
      type: 'object',
      required: ['email', 'name'],
      properties: {
        email:                { type: 'string', format: 'email' },
        name:                 { type: 'string' },
        company:              { type: 'string' },
        service_interest:     { type: 'string', description: 'Which service they want' },
        budget_range:         { type: 'string', description: 'e.g. under-10k, 10k-50k' },
        phone:                { type: 'string' },
        conversation_summary: { type: 'string' },
        platform_source:      { type: 'string', description: 'chatgpt | claude | tencent | web' },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const parsed = leadSchema.parse(args);
      const data = await api.post('/leads', parsed as Record<string, unknown>);
      const waNum = process.env.WA_NUMBER || '8801873722228';
      const waUrl = `https://wa.me/${waNum}?text=${encodeURIComponent(`Hi! I'm ${parsed.name} from ${parsed.company || 'N/A'}. Interested in: ${parsed.service_interest || 'your services'}.`)}`;
      return {
        content: [{
          type: 'text',
          text: JSON.stringify({ ...data, whatsapp_url: waUrl }),
        }],
      };
    },
  },
  {
    name: 'get_lead_status',
    description: 'Check the status of a previously captured lead.',
    inputSchema: {
      type: 'object',
      required: ['lead_id'],
      properties: {
        lead_id: { type: 'string' },
      },
    },
    // @ts-ignore
    handler: async (args: Record<string, unknown>) => {
      const data = await api.get(`/leads/${args.lead_id}`);
      return { content: [{ type: 'text', text: JSON.stringify(data) }] };
    },
  },
];
