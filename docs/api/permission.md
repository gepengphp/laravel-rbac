# `权限` 接口文档

### `权限` 模型

```json
{
    "id": 1,
    "name": "全部权限",
    "slug": "*",
    "http_method": [],
    "http_path": "*",
    "created_at": null,
    "updated_at": null
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| id | Number | ID |
| name | String | 名称 |
| slug | String | 标识 |
| http_method | String | HTTP 方法，为空默认为所有方法 |
| http_path | String | HTTP 路径 |
| created_at | Datetime \| Null | 创建时间 |
| updated_at | Datetime \| Null | 更新时间 |

### 接口列表

- [全部列表](./permission/all.md)
- [分页列表](./permission/page.md)
- [创建](./permission/store.md)
- [更新](./permission/save.md)
- [查询](./permission/view.md)
- [删除](./permission/destory.md)
