# 全部列表

全部 `角色` 列表接口

**path:** `/api/roles/all`

**method:** `GET`

**response:**

```json
{
    "code": 200,
    "msg": "success",
    "data": {
        "list": [
            {
                "id": 1,
                "name": "Administrator",
                "slug": "administrator",
                "created_at": "2021-10-25 18:25:30",
                "updated_at": "2021-10-25 18:25:30"
            }
        ]
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| list | Array | 角色数组，参照“权限模型” |
