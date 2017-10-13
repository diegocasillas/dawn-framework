<!DOCTYPE html>
<html>
<head>
    <title>Create post</title>
</head>
<body>
    <h1>Create a post</h1>

    <form action="/miniframework/posts" method="post">
        <div>
            Title : <input type="text" name="title">
        </div>
        <div>
            Body : <input type="text" name="body">
        </div>
        <div>
            <input type="submit" value="Publish">
        </div>
    </form>
</body>
</html>
