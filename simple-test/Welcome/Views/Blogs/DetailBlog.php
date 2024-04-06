<!DOCTYPE html>
<html>
<head>
    <title><?php echo $blogTexts[$language]['detail']["title"] ?></title>
</head>
<body>
    <h4><?php echo $blogTexts[$language]['detail']["title"] ?></h4>
    <h4></h4>
    <h4>
        <?php echo $blogTexts[$language]['detail']["switch_language"]["title"] ?>
        <a 
            href="/blog/id/<?php echo $blogTexts[$language]['detail']["switch_language"]["en_vn"]['lower_language']
            ?>/?id=<?php echo $blog['id'] ?>&language=<?php 
            echo $blogTexts[$language]['detail']["switch_language"]["en_vn"]['lower_language'] ?>">
            <?php echo $blogTexts[$language]['detail']["switch_language"]["en_vn"]['upper_language'] ?>
        </a>
    </h4>
    <table>
        <tr>
            <th><?php echo $blogTexts[$language]['detail']["id"] ?></th>
            <th><?php echo $blogTexts[$language]['detail']["content"] ?></th>
        </tr>
            <tr>
                <td>
                    <?php echo $blog['id'] ?>
                </td>
                <td>
                    <?php echo $blog["content_$language"] ?>
                </td>
            </tr>
    </table>
    <br>
    <a href="/blog"><?php echo $blogTexts[$language]['detail']["back"] ?></a>
</body>
</html>
