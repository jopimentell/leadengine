# Sistema de Logging e Monitoramento - Larnex

## Visão Geral

O Larnex utiliza o *Monolog* (nativo do Laravel) com *5 canais personalizados*, cobrindo requisitos de segurança, performance e rastreabilidade (PBE).

## Canais de Log

| Canal | Arquivo | Finalidade | Retenção | Nível |
|-------|---------|------------|----------|-------|
| `app` | logs/app.log | Log geral da aplicação | 14 dias | debug |
| `leads` | logs/leads.log | Rastreamento de capturas e notificações | 30 dias | info |
| `auth` | logs/auth.log | Login, logout, sessões | 90 dias | info |
| `performance` | logs/performance.log | Queries e requisições lentas | 30 dias | warning |
| `security` | logs/security.log | Tentativas falhas, alertas | 90 dias | warning |

## Componentes

### 1. Middleware `LogRequests`
- Mede tempo de resposta de cada requisição web
- Registra requisições AJAX e de API (JSON)
- Alerta requisições > 2 segundos

### 2. Detecção de Queries Lentas
`AppServiceProvider::boot()`:
- Usa `DB::listen()` para monitorar todas as queries
- Alerta queries > 500ms no canal `performance`

### 3. Eventos Logados
- ✅ Login e logout (canal `auth`)
- ✅ Tentativas falhas de login (canal `security`)
- ✅ Captura de leads (canal `leads`)
- ✅ Envio/falha de notificações WhatsApp (canal `leads`)
- ✅ Requisições lentas (canal `performance`)
- ✅ Queries lentas (canal `performance`)

### 4. Visualização no Admin
Rota `/admin/logs` exibe os últimos 30 registros de cada canal.

## Padrões de Codificação

- *PSR-3* (LoggerInterface) - segue a interface oficial
- *PSR-12* (estilo de código) - Laravel Pint configurado
- *Injeção de dependência* para testes
- *Nomes descritivos* nos canais e eventos

## Compatibilidade

- ✅ Linux, macOS, Windows (usa `storage_path()`)
- ✅ PHP 8.2+ (Laravel 12)
- ✅ Docker, VPS, servidor compartilhado

## Segurança

- Logs não contêm senhas ou tokens
- Dados sensíveis mascarados (ex: telefone truncado em logs de produção)
- Rotação automática (diária)
- Permissões restritas em `storage/logs/`