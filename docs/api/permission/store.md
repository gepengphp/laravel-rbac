# `权限` 创建

`创建` 权限接口。

**path:** `/api/permissions`

**method:** `POST`

**request body:**

```json
{
    "name": "权限名称",
    "slug": "foo",
    "http_method": [
        "GET",
        "POST"
    ],
    "http_path": "/api/permission/*"
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
    "sub_code": 200,
    "status": true,
    "msg": "success",
    "timestamp": 1635142767,
    "data": {
        "permission": {
            "name": "权限名称",
            "slug": "alone",
            "http_path": "/api/permission/*",
            "updated_at": "2021-10-25 14:19:27",
            "created_at": "2021-10-25 14:19:27",
            "id": 4
        }
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| permission | Object | 权限对象，参照“权限模型” |
