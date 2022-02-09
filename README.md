# Laravel Logger

### Setup
This app works in local Docker network: `evolta`,
and could not be accessed from outside.
For call this app from another service in network,
call `evolta_activity` host.
#### Environment
1. `cp .env.example .env`
2. `docker-compose up -d --build`
#### Get Bearer token for client project
3. `docker exec -ti evolta_activity_php bash`
4. `php artisan project:register <project-name>`
---
### JSON-RPC 2.0 API
#### Log Activity
->
```json
{
  "jsonrpc": "2.0",
  "method": "logActivity",
  "params": {"url": "http://abda.ri/am/qqq", "date": "2022-02-06 11:00:18"},
  "id": "2"
}
```
<-
```json
{
  "id": "2",
  "result": null,
  "jsonrpc": "2.0"
}
```
---
#### Find Activity
->
```json
{
  "jsonrpc": "2.0",
  "method": "findActivity",
  "params": {"limit": 10, "offset": 0},
  "id": "3"
}
```
<-
```json
{
  "id": "3",
  "result": {
    "total": 2,
    "items": [
      {
        "url": "http://abda.ri/dfgdfgdfg/qqq",
        "visits": 1,
        "lastVisit": "2022-02-06T09:58:10.000000Z"
      },
      {
        "url": "http://abda.ri/dfgdfgdfg/fg",
        "visits": 2,
        "lastVisit": "2022-02-06T09:58:10.000000Z"
      }
    ]
  },
  "jsonrpc": "2.0"
}
```
