# Blog module

## Usage

- You have to create a `blog.index` and `blog.show` page in your front end theme.
- You can link to the blog index page using : `route(locale() . '.blog')`
- In the blog index you'll have access to a `$posts` variable on which you can loop
- To create a link to a specific post: `route(locale() . '.blog.slug', [$post->slug])`
- On the blog index and blog show pages you'll have access to a `$latestPosts` variable containing the latest posts, this amount can be configured in the admin.
- On a post detail page, you can have access to the next and previous post by calling:
    - `$post->present()->previous`
    - `$post->present()->next`

