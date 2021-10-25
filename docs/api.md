## 接口文档

采用 `restful` 规范。

### 权限

#### 权限创建

**path:** `/api/permissions`   
**method:** `POST`   
**request body:** 
```json
{
    "name": "单独权限",
    "slug": "alone",
    "http_method": [
        "GET",
        "POST"
    ],
    "http_path": "/api/permission/*"
}
```
**response:** 
```json
{
    "code": 200,
    "sub_code": 200,
    "status": true,
    "msg": "success",
    "timestamp": 1635142767,
    "data": {
        "permission": {
            "name": "单独权限",
            "slug": "alone",
            "http_path": "/api/permission/*",
            "updated_at": "2021-10-25 14:19:27",
            "created_at": "2021-10-25 14:19:27",
            "id": 4
        }
    }
}
```
