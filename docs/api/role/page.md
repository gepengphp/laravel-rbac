# `角色` 分页列表

`角色` 分页列表接口。

**path:** `/api/roles/page`

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
    "msg": "success",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Administrator",
                "slug": "administrator",
                "created_at": "2021-10-25 18:25:30",
                "updated_at": "2021-10-25 18:25:30"
            }
        ],
        "first_page_url": "http://.../api/roles/page?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://.../api/roles/page?page=1",
        "next_page_url": null,
        "path": "http://.../api/roles/page",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| current_page | Number | 当前页码 |
| per_page | Number | 每页长度 |
| last_page | Number | 最后页码 |
| total | Number | 总页数 |
| data | Object | 角色列表，参照“角色模型” |
| path | String \| null | 分页基础 URL |
| first_page_url | String \| null | 首页链接 |
| last_page_url | String \| null | 末页链接 |
| next_page_url | String \| null | 下一页页码 |
| prev_page_url | String \| null | 上一页页码 |
| from | Number | 跳转开始 |
| to | Number | 跳转结束 |
