# `角色` 更新

更新 `角色` 接口。

**path:** `/api/roles/{id}`

**method:** `PUT`

**request body:**

```json
{
    "name": "角色",
    "slug": "foo",
    "permission_ids": [
        7,5
    ]
}
```

| 名称 | 类型 | 是否必填 | 默认值 | 说明 |
| ------ | ------ | ------ | ------ | ------ |
| name | String | 是 | null | 权限名称 |
| slug | String | 是 | null | 权限标识 |
| permission_ids | Array | 是 | 空 | 权限 ID 数组 |

**response:**

```json
{
    "code": 200,
    "msg": "success",
    "data": {
        "permission": {
            "id": 2,
            "name": "权限",
            "slug": "permissio3",
            "http_method": [
                "GET",
                "POST",
                "DELETE"
            ],
            "http_path": "/api/permission/*",
            "created_at": null,
            "updated_at": "2021-11-01 11:18:46"
        }
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| permission | Object | 权限，参照“权限模型” |
