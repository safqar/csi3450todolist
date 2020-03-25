<?php
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8","root","");

    if(isset($_POST['submit']) ){
        $name = $_POST['name'];
        $sth = $pdo->prepare("INSERT INTO todos (name) VALUES (:name), (:priorities), (:categories");
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->bindValue(':priorities', $priorities, PDO::PARAM_STR);
        $sth->bindValue(':categories', $categories, PDO::PARAM_STR);
        $sth->execute();
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sth = $pdo->prepare("delete from todos where id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    
    <title>ToDoList Web App for CSI 3450</title>
    
    
    
    
    
   <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    
    
   <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <!--<link rel="stylesheet" href="milligram.min.css">
    -->

    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">


   

</head>
<body class="container">
    <p></p>
    <h1>To Do List Web App</h1>
    <form method="post" action="">
        <input type="text" name="name" value="">
        <input type="submit" name="submit" value="Add a Task">
        <form method ="post" action="">

</form>
    <form method="post" action="">
  <label for="categories">Choose a category</label>
  <select id="categories" name="Categories">
    <option value="category1">Work</option>
    <option value="category2">School</option>
    <option value="category3">Social</option>
  </select>
  <input type="submit">
</form>
    <form method="post" action="">
  <label for="Priorities">Choose a Priority</label>
  <select id="priorities" name="Priorities">
    <option value="Priority1">High</option>
    <option value="Priority2">Medium</option>
    <option value="Priority3">Low</option>
  </select>
  <input type="submit">
</form>
    </form>
    </form>
    </form>
    <h2>Current Tasks</h2>
    <table class="table table-striped">
        <therad><th>Task</th><th></th></therad>
        <therad><th>Category</th><th></th></therad>
        <therad><th>Priority</th><th></th></therad>
        
        <tbody>
<?php
    $sth = $pdo->prepare("SELECT * FROM todos ORDER BY id DESC");
    $sth->execute();
    
    foreach($sth as $row) {
?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Remove a Task</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
<?php
    }
?>
        </tbody>
    </table>
</body>
</html>