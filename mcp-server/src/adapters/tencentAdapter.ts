import express, { Request, Response } from 'express';
import { allTools } from '../index.js';

export function startTencentAdapter(port = 3001) {
  const app = express();
  app.use(express.json());

  app.post('/invoke', async (req: Request, res: Response) => {
    const { tool, parameters = {} } = req.body as { tool?: string; parameters?: Record<string, unknown> };
    if (!tool) { res.status(400).json({ code: 400, message: 'Missing tool' }); return; }
    const t = allTools.find(x => x.name === tool);
    if (!t) { res.status(404).json({ code: 404, message: `Tool '${tool}' not found` }); return; }
    try {
      // @ts-ignore
      res.json({ code: 0, data: await t.handler(parameters) });
    } catch (e: unknown) {
      res.status(500).json({ code: 500, message: e instanceof Error ? e.message : 'Error' });
    }
  });

  app.get('/tools', (_req, res) =>
    res.json(allTools.map(t => ({ name: t.name, description: t.description, schema: t.inputSchema })))
  );

  app.listen(port, () => console.log(`[Tencent adapter] :${port}`));
}
