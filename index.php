<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HomeWork</title>
</head>

<body>
<form action="index.php" method="POST" enctype="multipart/form-data">
  Загрузить картинку (До 2 Мб): <input type="file" name="download" size="9"/>
 <input type="submit" value="Download" name="downimg"/ > <br>
     <br>
     Загрузить фал (До 2 Мб): <input type="file" name="download1" size="9"/>
     <input type="submit" value="Download1" name="downfiles"/> <br>
 </form>
<div style="margin:top:25px;">
  <?php
   $data=$_POST;

  if(isset($data['downimg'])){
           $upl = 'files/doc/';
      addimg($upl);

  }
  ?>
  </div>
 <div style="margin:top:25px;">
     <?php
  if(isset($data['downfiles'])) {
      $upl1 = 'texts/';
      addfile($upl1);
        }
  $upl = 'files/doc/';
  $upl1 = 'texts/';
     ?>
 </div>
 <?php
  showimg($upl);
  showtexst($upl1);

// $uplfile='texts/';
 //addfile($uplfile);
function showimg ($dir){ // Отображение картинок по три картинки в одном ряду.
       //  var_dump($dir);
    $cols = 3;
    $files = scandir($dir);
    echo "<table>";
    $k = 0;
    for ($i = 0; $i < count($files); $i++) {
        if (($files[$i] != ".") && ($files[$i] != "..")) {
            if ($k % $cols == 0) echo "<tr>";
            echo "<td>";
            $path = $dir.$files[$i];
            //  var_dump($path);
            //var_dump($files[$i]);
            echo "<a href='$path'>";
            echo "<img src='$path' alt='' width='100' /> ";
            echo "</a>";
            echo "</td>";
            if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
            $k++;
        }
    }
    echo "</table>";
}
  function showtexst ($dir){ // Отображение файлов по три файла в одном ряду.
      //  var_dump($dir);
      $cols = 3;
      $files = scandir($dir);

      echo "<table>";
      $k = 0;
      for ($i = 0; $i < count($files); $i++) {
          if (($files[$i] != ".") && ($files[$i] != "..")) {
              if ($k % $cols == 0) echo "<tr>";
              echo "<td>";
              $path = $dir.$files[$i];
              $filename = basename($path);
              //var_dump($files[$i]);
              //  var_dump($filename);
              //  var_dump($path);
              echo "<a href='$path'>";
              echo "<img src='http://dom-comp.moy.su/image2/txt123123141241.png' alt='' width='50'  />";
              echo $filename;
              echo "</a>";
              echo "</td>";
              if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
              $k++;
          }
      }
      echo "</table>";

  }


?>

<?php

 function addimg ($uploaddir) // Загрузка картинок в папку и проверка на расширение и размер
 {
 $uploadfile = $uploaddir . basename($_FILES['download']['name']);

      $chek= new SplFileInfo($uploadfile);
     $chek->getExtension();
     echo '<pre>';
         if(($chek->getExtension()=='png') OR ($chek->getExtension()=='jpg')   )
     {
         if (move_uploaded_file($_FILES['download']['tmp_name'], $uploadfile)) {
             if(filesize($uploadfile)>2000000){
                 unlink($uploadfile);

                 echo "файл занимает больше 2 Мб"."<a href= 'http://dehomework.zzz.com.ua/'>".'<br>';

                 die("На главную") ;
             }
             echo "Файл корректен и был успешно загружен.\n   ". filesize($uploadfile);
         }

     }
     else {
         echo 'Только файлы с расширением .png или .jpg';
     }
}
function addfile ($uploaddir)  // Загрузка файлов в папку и проверка на расширение и размер
{
    $uploadfile = $uploaddir . basename($_FILES['download1']['name']);
    $file_name = basename($_FILES['download1']['name']);
    $chek= new SplFileInfo($uploadfile);
    $chek->getExtension();
        echo '<pre>';
            if($chek->getExtension()=='txt')
            {
                if (move_uploaded_file($_FILES['download1']['tmp_name'], $uploadfile)) {
                    if(filesize($uploadfile)>2000000){
                        unlink($uploadfile);
                        die("файл занимает больше 2 Мб") ;
                    }

                }
                            }
            else{
                echo 'Только файлы с расширением .txt ';
            }



}
?>
</body>
</html>