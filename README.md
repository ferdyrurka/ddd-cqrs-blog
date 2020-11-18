# CQRS Blog

A simple project aimed at understanding the design pattern
CQRS (Command Query Responsibility Segregation).

## Local

### Linux

You must added in /etc/hosts

```
127.0.0.1       lukaszstaniszewski.local
127.0.0.1       admin.lukaszstaniszewski.local
```

## Links

Client api http://lukaszstaniszewski.local/api/v1

Admin api http://admin.lukaszstaniszewski.local/api/v1

## API

### Add post

**URL:** http://admin.lukaszstaniszewski.local/api/v1/admin/create/post

**HTTP method:** POST

**Body:**

```json
{
	"title": "Hello World title",
	"content": "Hello World content",
	"publishType": "cron",
	"plannedPublishAt": "2030-05-12 12:12",
	"customSlug": "foo-bar"
}
```

### Find all published post

**URL:** http://lukaszstaniszewski.local/api/v1/client/post/published/find-all

**HTTP method:** GET

### Add category

**URL:** http://admin.lukaszstaniszewski.local/api/v1/admin/create/category

**HTTP method:** POST

**Body:**

```json
{
	"name": "Category name"
}
```

## Tasks

- [x] Add Post (Rest Api)
- [x] Show all posts (Rest Api)
- [ ] Show single post (Rest Api)
- [x] Add category
- [ ] Added analytics app
- [ ] Search post engine
- [ ] Commit to listener

## Author

* Łukasz Staniszewski

## License

* GPL V3 or Later
