# `权限` 更新

`更新` 权限接口。

**path:** `/api/permissions/{id}`

**method:** `PUT`

**request body:**

```json
{
    "name": "权限名称",
    "slug": "foo",
    "http_method": [
        "GET",
        "POST",
        "DELETE"
    ],
    "http_path": "/api/foo/*"
}
```

| 名称 | 类型 | 是否必填 | 默认值 | 说明 |
| ------ | ------ | ------ | ------ | ------ |
| name | String | 是 | null | 权限名称 |
| slug | String | 是 | null | 权限标识 |
| http_method | String | 否 | 空 | HTTP 方法，为空默认为所有方法 |
| http_path | String | 否 | 空 | HTTP 路径 |

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
