# `角色` 接口文档

### `角色` 模型

```json
{
    "id": 1,
    "name": "Administrator",
    "slug": "administrator",
    "created_at": "2021-10-25 18:25:30",
    "updated_at": "2021-10-25 18:25:30"
}
```

| 名称 | 类型 | 说明 |
| ------ | ------ | ------ |
| id | Number | ID |
| name | String | 名称 |
| slug | String | 标识 |
| created_at | Datetime \| Null | 创建时间 |
| updated_at | Datetime \| Null | 更新时间 |

### 接口列表

- [全部列表](./role/all.md)
- [分页列表](./role/page.md)
- [创建](./role/store.md)
- [更新](./role/save.md)
- [查询](./role/view.md)
- [删除](./role/destory.md)
