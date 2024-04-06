<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Assets/Common.css">
    <title>News</title>
</head>
<body>
    <form action="/blog/create" method="post">
        <table>
            <tr>
                <th>Create a new blog</th>
                <th></th>
            </tr>
            <tr>
                <td><label for="content-vn">Content for VietNamese</label></td>
                <td><input id="content-vn" name="content-vn" required="" type="text" /></td>
            </tr>
            <tr>
                <td><label for="content-en">Content for English:</label></td>
                <td><input id="content-en" name="content-en" required="" type="text" /></td>
            </tr>
            <tr>
                <td><input name="create" type="submit" value="Create" /></td>
            </tr>
        </table>
    </form>

    <br><br>

    <h4>Current list of all blogs</h4>
    <table>
        <tr>
            <th>Id</th>
            <th>Vietnamses</th>
            <th>English</th>
            <th>Edit</th>
            <th>delete</th>
            <th>Detail</th>
            <th></th>
        </tr>
        <?php
            foreach ($blogs as $blog) { ?>
                <tr>
                    <td>
                        <p><?php echo $blog['id'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $blog['content_vn'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $blog['content_en'] ?></p>
                    </td>
                    <td>
                        <button class='btn btn-<?php echo $blog['id'] ?>'>edit</button>
                    </td>
                    <td>
                        <form action="/blog/delete" method="post">
                            <input type="hidden" id="id" name="id" value="<?php echo $blog['id'] ?>">
                            <input name="delete" type="submit" value="Delete" />
                        </form>
                    </td>
                    <td>
                        <a href="/blog/id/vn/?id=<?php echo $blog['id'] ?>&language=vn">VN</a>
                    </td>
                    <td>
                        <a href="/blog/id/en/?id=<?php echo $blog['id'] ?>&language=en">EN</a>
                    </td>
                </tr>

                <div class="modal modal-<?php echo $blog['id'] ?>">
                    <div class="modal-content">
                    <span class="close close-<?php echo $blog['id'] ?>">&times;</span>
                    <form action="/blog/edit" method="post">
                        <input type="hidden" id="id" name="id" value="<?php echo $blog['id'] ?>">
                        <h4>edit a new blogs</h4>
                        <label for="content-vn">Content for VietNamses</label>
                        <input id="content-vn" name="content-vn" required=""
                            value="<?php echo $blog['content_vn'] ?>" type="text" />
                        <br><br>
                        <label for="content-en">Content for English:</label>
                        <input id="content-en" name="content-en" required=""
                            value="<?php echo $blog['content_en'] ?>" type="text" />
                        <br><br>
                        <input name="confirm" type="submit" value="Confirm" />
                    </form>
                    </div>
                </div>
        <?php } ?>
    </table>
</body>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        var modal = $('.modal');
        var btn = $('.btn');
        var span = $('.close');

        btn.click(function (e) {
            let id = (e.currentTarget.className).replace("btn btn-", "");
            $('.modal-' + id).show();
        });

        span.click(function () {
            modal.hide();
        });

        $(window).on('click', function (e) {
            if ($(e.target).is('.modal')) {
                modal.hide();
            }
        });
    });
</script>

</html>
