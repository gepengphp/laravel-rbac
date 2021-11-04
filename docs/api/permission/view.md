# `权限` 查询

**path:** `/api/permissions/{id}`

**method:** `GET`

**query parameters:**


| 名称 | 类型 | 是否必填 | 默认值 | 说明 |
| ------ | ------ | ------ | ------ | ------ |
| id | Number | 是 | null | 权限 ID |

**response:**

```json
{
    "code": 200,
    "msg": "success",
    "data": {
        "permission": {
            "id": 2,
            "name": "权限名称",
            "slug": "foo",
            "http_method": [
                "GET"
            ],
            "http_path": "/",
            "created_at": null,
            "updated_at": null
        }
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| permission | Object | 权限，参照“权限模型” |
