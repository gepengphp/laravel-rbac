# 全部列表

全部 `权限` 列表接口

**path:** `/api/permissions/all`

**method:** `GET`

**response:**

```json
{
    "code": 200,
    "sub_code": 200,
    "status": true,
    "msg": "success",
    "timestamp": 1635142767,
    "data": {
        "list": [
            {
                "id": 4,
                "name": "权限名称",
                "slug": "foo",
                "http_path": "/api/permission/*",
                "updated_at": "2021-10-25 14:19:27",
                "created_at": "2021-10-25 14:19:27"
            }
        ]
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| list | Array | 权限数组，参照“权限模型” |