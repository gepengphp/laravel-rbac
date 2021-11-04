# `权限` 分页列表

`权限` 分页列表接口。

**path:** `/api/permissions/page`

**method:** `POST`

**request body:**

```json
{
    "page": 1,
    "per_page": 10
}
```

| 名称 | 类型 | 是否必填 | 默认值 | 说明 |
| ------ | ------ | ------ | ------ | ------ |
| page | Number | 否 | 1 | 页码 |
| per_page | Number | 否 | 10 | 每页长度 |

**response:**

```json
{
    "code": 200,
    "sub_code": 200,
    "status": true,
    "msg": "success",
    "timestamp": 1635142767,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "全部权限",
                "slug": "*",
                "http_method": [],
                "http_path": "*",
                "created_at": null,
                "updated_at": null
            }
        ],
        "first_page_url": "http://.../api/permissions/page?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://.../api/permissions/page?page=1",
        "next_page_url": null,
        "path": "http://.../api/permissions/page",
        "per_page": 10,
        "prev_page_url": null,
        "to": 4,
        "total": 4
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| current_page | Number | 当前页码 |
| per_page | Number | 每页长度 |
| last_page | Number | 最后页码 |
| total | Number | 总页数 |
| data | Object | 权限列表，参照“权限模型” |
| path | String \| null | 分页基础 URL |
| first_page_url | String \| null | 首页链接 |
| last_page_url | String \| null | 末页链接 |
| next_page_url | String \| null | 下一页页码 |
| prev_page_url | String \| null | 上一页页码 |
| from | Number | 跳转开始 |
| to | Number | 跳转结束 |

