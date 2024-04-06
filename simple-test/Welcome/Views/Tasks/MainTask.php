<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Assets/Common.css">
    <title>Tasks</title>
</head>
<body>
    <form action="/task/create" method="post">
        <table>
            <tr>
                <th>Create a new task</th>
                <th></th>
            </tr>
            <tr>
                <td><label for="task-name">Task name</label></td>
                <td><input id="task-name" name="task-name" required="" type="text" /></td>
            </tr>
            <tr>
                <td><label for="user-name">Assign to user</label></td>
                <td>
                    <select name="user-name" id="user-name">
                    <?php
                        foreach ($userNames as $userName) { ?>
                            <option value="<?php echo $userName['username'] ?>"><?php echo $userName['username'] ?></option>
                        <?php } ?>
                        <option value="" selected></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="start-time">start time</label></td>
                <td><input id="start-time" name="start-time" type="datetime-local"
                value="" /></td>
            </tr>
            <tr>
                <td><label for="expire-time">expire time</label></td>
                <td><input id="expire-time" name="expire-time" required="" type="datetime-local"
                value="2024-08-11T12:33" /></td>
            </tr>
            <tr>
                <td><input name="create" type="submit" value="Create" /></td>
            </tr>
        </table>
    </form>

    <br><br>

    <h4>Current list of all Tasks</h4>
    <table>
        <tr>
            <th>Id</th>
            <th>Task name</th>
            <th>Assigned user</th>
            <th>Start time</th>
            <th>Expire time</th>
            <th>edit</th>
            <th>Detete</th>
        </tr>
        <?php
            foreach ($tasks as $task) { ?>
                <tr>
                    <td>
                        <p><?php echo $task['id'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $task['task_name'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $task['user_name'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $task['start_time'] ?></p>
                    </td>
                    <td>
                        <p class="change"><?php echo $task['expire_time'] ?></p>
                    </td>
                    <td>
                        <button class='btn btn-<?php echo $task['id'] ?>'>edit</button>
                    </td>
                    <td>
                        <form action="/task/delete" method="post">
                            <input type="hidden" id="id" name="id" value="<?php echo $task['id'] ?>">
                            <input name="delete" type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>

                <div class="modal modal-<?php echo $task['id'] ?>">
                    <div class="modal-content">
                    <span class="close close-<?php echo $task['id'] ?>">&times;</span>
                    <form action="/task/edit" method="post">
                        <input type="hidden" id="id" name="id" value="<?php echo $task['id'] ?>">
                        <h4>Edit this task</h4>
                        <label for="task-name">Task name</label>
                        <input id="task-name" name="task-name" required=""
                            value="<?php echo $task['task_name'] ?>" type="text" />
                        <br><br>
                        <label for="user-name">Assign to user</label>
                        <select name="user-name" id="user-name">
                            <?php
                                foreach ($userNames as $userName) { ?>
                                <option value="<?php echo $userName['username'] ?>" 
                                    <?php 
                                        if ($userName['username'] == $task['user_name']) { ?> 
                                            selected
                                    <?php } ?>
                                >
                                    <?php echo $userName['username'] ?>
                                </option>
                            <?php } ?>
                            <option value=""></option>
                        </select>
                        <br><br>
                        <label for="start-time">start time</label>
                        <input id="start-time" name="start-time" type="datetime-local"
                            value="<?php echo $task['start_time'] ?>" />
                        <br><br>
                        <label for="expire-time">expire time</label>
                        <input id="expire-time" name="expire-time" type="datetime-local"
                            value="<?php echo $task['expire_time'] ?>" />
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
