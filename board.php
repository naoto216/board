<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>掲示板</title>
    </head>
    <body>
    <?php
    $date =date("Y/m/d H:m:s");
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $password = $_POST["password"];
    $filename = "board.txt";
    // 編集ボタンが押されたとき
    if($_POST["hennsyuu"] >= 1){
        $lines =(file($filename,FILE_IGNORE_NEW_LINES));
        foreach($lines as $line){
        $word = explode("<>",$line);
        if($word[0] == $_POST["hennsyuu"]){
            $num = $word[0];
            $namae = $word[1] ;
            $komennto = $word[2] ;
            break;
            
        }
        }
    }  
    // ここに投稿を追加するときの処理をかく
    else if($_POST["name"] && $_POST["comment"]!=null){
    if($_POST["hidden"] !=null){
     $lines =(file($filename,FILE_IGNORE_NEW_LINES));
        $i =1;
        foreach($lines as $line){
        $word = explode("<>",$line);
// 編集したい番号じゃないとき
        if($word[0] != $_POST["hidden"]){
            if($i == 1){
            $fp = fopen($filename,"w");
            fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
            $i = 2;
            fclose($fp);
            } else {
                $fp = fopen($filename,"a");
                fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                fclose($fp);
            }
// 編集したい番号が来たとき
            } else {
                if($i == 1){
                    if($password == $word[4]){
                    $fp = fopen($filename,"w");
                    fwrite($fp,$word[0]."<>".$name."<>".$comment."<>".$date."<>".$password.PHP_EOL);
                    $i = 2;
                    fclose($fp);
                    } else {
                        $fp = fopen($filename,"w");
                        fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                        $i = 2;
                        fclose($fp); 
                    }
                    
                } else {
                    if($password == $word[4]){
                    $fp = fopen($filename,"a");
                    fwrite($fp,$word[0]."<>".$name."<>".$comment."<>".$date."<>".$password.PHP_EOL);
                    fclose($fp);
                    } else {
                        $fp = fopen($filename,"a");
                        fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                        fclose($fp);
                    }
                }  
            }
        }
        } else {
    $number = 1;
    $lines =(file($filename,FILE_IGNORE_NEW_LINES));
    foreach($lines as $line){
        $word = explode("<>",$line);
        $number = $word[0] +1;
    }
    
    $fp = fopen($filename,"a"); 
    fwrite($fp,$number."<>".$name."<>".$comment."<>".$date."<>".$password.PHP_EOL);
    fclose($fp);
        }         // ここに投稿を削除するときの処理をかく
    } else if($_POST["number"]>=1){
        $lines =(file($filename,FILE_IGNORE_NEW_LINES));
        $i =1;
        foreach($lines as $line){
        $word = explode("<>",$line);
        if($word[0] != $_POST["number"]){
            if($i == 1){
            $fp = fopen($filename,"w");
            fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
            $i = 2;
            fclose($fp);
            } else {
                $fp = fopen($filename,"a");
                fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                fclose($fp);
            }
            } else {
                if($password != $word[4]){
                     if($i == 1){
                        $fp = fopen($filename,"w");
                        fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                        $i = 2;
                        fclose($fp);
                         
                     } else {
                        $fp = fopen($filename,"a");
                        fwrite($fp,$word[0]."<>".$word[1]."<>".$word[2]."<>".$word[3]."<>".$word[4].PHP_EOL);
                        fclose($fp);
                         
                     }
               } }
        }
    }
    ?>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前" value = "<?=$namae;?>">
            <input type="text" name="comment" placeholder="コメント" value = "<?=$komennto;?>">
            <input type="hidden" name="hidden" value="<?=$num;?>">
            <input type="password" name="password" placeholder="パスワード">
            <input type="submit" name="submit">
        </form>
        <form action="" method="post">
            <input type="number" name="hennsyuu" placeholder="編集する番号">
            <input type="submit" name="submit" value="編集">
        </form>
        <form action="" method="post">
            削除する番号<input type="number" name="number" >
            <input type="password" name="password" placeholder="パスワード">
            <input type="submit" name="submit" value="削除">
        </form>
    <?php
    $filename = "board.txt";
    $lines =(file($filename,FILE_IGNORE_NEW_LINES));
    foreach($lines as $line){
        $word = explode("<>",$line);
        echo $word[0]." ".$word[1]." ".$word[2]." ".$word[3]." <br>";
    } 
    ?>
    </body>
</html>