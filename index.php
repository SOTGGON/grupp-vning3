<?php
    $page_title = "Startsida";
    include("includes/header.php");
?>

<div class="container">
    <h2>Gruppövning 3 - Databas-anslutningar</h2>
      
    <div>
        <section id="miancontent">
            <h3>Lägg till ny sak att göra</h3>
            <div class="content">
                <div class="addto">
                    <form method="POST">
                        <table>
                            <tr>
                                <td><label for="todo">Att göra:</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" id="todo" name="todo"></td>
                                <td><input type="submit" value="Skicka" class="btn green" name="send"></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>

                <?php
                    $todolist = new todolist();
                    
                    if(isset($_POST['todo'])){
                        $todoinput = $_POST['todo'];

                        if($todolist->setTodo($todoinput)){
                            echo "";
                        }else{
                            echo "<p class='error'>Texten måste vara minst 5 tecken långt</p>";
                        }
                    }
                ?>

                <div class="todolist">
                    <h3>Saker att göra</h3>

                    <?php
                        $listArr = $todolist->getTodo();

                        if(isset($_GET["delete"])){
                            unset($listArr[$_GET["delete"]]);
                            $jsonData = json_encode($listArr, JSON_PRETTY_PRINT);
                            file_put_contents("todolist.json", $jsonData);
                            header("location: index.php");
                        }

                        if(isset($_POST["deleteall"])){
                            unset($listArr);
                            file_put_contents("todolist.json", "[]");
                            header("location: index.php");
                        }
                    ?>

                    <ul>
                        <?php
                            if($listArr != null){
                                foreach($listArr as $index => $list){
                                    echo "<li><div>$list</div><div><a href='index.php?delete=$index'>Klar!</a></div></li>";
                                }
                            }else{
                                echo "";
                            }
                        ?>
                    </ul>
                    
                    <form method="POST">
                        <?php
                            if(!empty($listArr)){
                                echo "<input type='submit' value='Rensa' class='btn red' name='deleteall'>";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </div>

</div>

<?php
    include("includes/footer.php");
?>
    

