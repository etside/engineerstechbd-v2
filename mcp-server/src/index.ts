import 'dotenv/config';
import { Server } from '@modelcontextprotocol/sdk/server/index.js';
import { StdioServerTransport } from '@modelcontextprotocol/sdk/server/stdio.js';
import { CallToolRequestSchema, ListToolsRequestSchema, Tool } from '@modelcontextprotocol/sdk/types.js';
import { serviceTools } from './tools/serviceTools.js';
import { projectTools } from './tools/projectTools.js';
import { leadTools }    from './tools/leadTools.js';
import { startChatGPTAdapter } from './adapters/chatgptAdapter.js';
import { startTencentAdapter }  from './adapters/tencentAdapter.js';

export const allTools: Tool[] = [...serviceTools, ...projectTools, ...leadTools];

const adapter = process.argv.find(a => a.startsWith('--adapter='))?.split('=')[1]
             ?? process.env.MCP_ADAPTER
             ?? 'stdio';

if (adapter === 'chatgpt') {
  startChatGPTAdapter(Number(process.env.CHATGPT_PORT) || 3000);
} else if (adapter === 'tencent') {
  startTencentAdapter(Number(process.env.TENCENT_PORT) || 3001);
} else {
  // stdio — native MCP (Claude Desktop, Kiro, etc.)
  const server = new Server(
    { name: 'engineerstechbd', version: '1.0.0' },
    { capabilities: { tools: {} } }
  );

  server.setRequestHandler(ListToolsRequestSchema, async () => ({ tools: allTools }));

  server.setRequestHandler(CallToolRequestSchema, async (req) => {
    const tool = allTools.find(t => t.name === req.params.name);
    if (!tool) throw new Error(`Unknown tool: ${req.params.name}`);
    // @ts-ignore — handler is attached per tool
    return tool.handler(req.params.arguments ?? {});
  });

  const transport = new StdioServerTransport();
  await server.connect(transport);
  console.error('[MCP] engineersTech server running on stdio');
}
