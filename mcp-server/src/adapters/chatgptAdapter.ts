import express, { Request, Response } from 'express';
import { allTools } from '../index.js';

export function startChatGPTAdapter(port = 3000) {
  const app = express();
  app.use(express.json());

  app.get('/health', (_req, res) => res.json({ status: 'ok' }));

  app.get('/openapi.json', (_req, res) => {
    const paths: Record<string, unknown> = {};
    for (const t of allTools) {
      paths[`/${t.name}`] = {
        post: {
          operationId: t.name,
          summary: t.description,
          requestBody: { required: true, content: { 'application/json': { schema: t.inputSchema } } },
          responses: { '200': { description: 'Tool result' } },
        },
      };
    }
    res.json({ openapi: '3.1.0', info: { title: 'engineersTech AI Tools', version: '1.0.0' }, paths });
  });

  for (const t of allTools) {
    app.post(`/${t.name}`, async (req: Request, res: Response) => {
      try {
        // @ts-ignore
        res.json(await t.handler(req.body));
      } catch (e: unknown) {
        res.status(500).json({ error: e instanceof Error ? e.message : 'Error' });
      }
    });
  }

  app.listen(port, () => console.log(`[ChatGPT adapter] :${port}`));
}
