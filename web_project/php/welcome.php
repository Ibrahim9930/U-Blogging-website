<?php
class MyDB extends SQLite3 {
   function __construct() {
     $this->open('..\db.sqlite3');
   }
}



if(!isset($_GET['username'])){
  header("Location: http://127.0.0.1/U-Blogging-website/web_project/php/404/404.html");
}

$username=$_GET['username'];
$db=new MyDB();



$query1 = 'select id from auth_user where username="'.$username.'"';
$ret1 = $db->query($query1);
$row1 = $ret1->fetchArray(SQLITE3_ASSOC);




$query = 'select visited from accounts_uer where user_id="'.$row1["id"].'"';
$ret = $db->query($query);
$row = $ret->fetchArray(SQLITE3_ASSOC);


if($row["visited"]==1){
  header("Location: http://127.0.0.1/U-Blogging-website/web_project/php/404/404.html");
}

$query = $db->exec( ' UPDATE accounts_uer SET visited=1 WHERE user_id="'.$row1["id"].'"' );



?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Fresca" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  </head>

  <style media="screen">

  </style>

  <body>
<h1  style=" font-family: 'Raleway', sans-serif;
             font-weight:lighter;
             color: white;
             margin-bottom: 20px;
             text-align:center;
             padding-top:6%;" >    Welcome</h1>


<div class="container">
<div class="row">
  <div class="col-2">

  </div>
  <div class="col-8">

    <form method="post" action="updateuser.php">

      <div class="form-row" style="">

        <div class="col">
          <input name="first" type="text" class="form-control" placeholder="First name">
        </div>

        <div class="col">
          <input name="last" type="text" class="form-control" placeholder="Last name">
        </div>

      </div>
      <h4  style=" font-family: 'Raleway', sans-serif;
                   font-weight:lighter;
                   color: white;
                   text-align:center;
                   padding-top:6%;" >    Add Whatever You Like  !!</h4>
                   <h6  style=" font-family: 'Raleway', sans-serif;
                                color: white;
                                text-align:center;
                                opacity: 0.5;" >   Dive In Our Universe</h6>

      <div class="row" style="
        max-height: 400px;
        margin-top: 50px;
        overflow-y: scroll;
      overflow-x: hidden;
        -webkit-overflow-scrolling: touch;

      "
        >




            <?php

            $db = new MyDB();
            $query =  "SELECT * FROM categories_category"; // to change whith post id
            $ret = $db->query($query);
            echo '  <input name="username" type="text" value="'.$username.'" hidden>';
            while($row = $ret->fetchArray(SQLITE3_ASSOC) )
             {
               echo '
               <div class="col-3" id="'. $row['id'].'">
                 <div class="card text-center" style=" margin-bottom: 10px; width: 100%;; background:rgb(240,248,255);">
                   <div class="card-body" style="Background:white;">
                     <h5 style="color:black; font-size:1em;" class="card-title">'.$row['name'].'</h5>
                     <button  id="'.$username.'"name="'. $row['id'].'" onclick="add(this)" type="button" class="btn btn-light">Subscribe</button>
                   </div>
                 </div>

               </div>
      ';
             }

             $db->close();
             unset($db);
             ?>
      </div>
      <button style="margin-top:50px; width:100%;" type="submit" class="btn btn-primary btn-lg btn-block">Start</button>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
  function add(b){
    var cat=b.name;
    var user=b.id;
    console.log(cat)
    console.log(user)
var dataString = 'user='+user+'&cat='+cat;

    $.ajax({ url: 'addsub.php',
           data: dataString ,
           type: 'post',
           success: function() {
             document.getElementById(b.name).style.display="none";
                    }
    });

  }
</script>









<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<style media="screen">
body {
height: 100%;
background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
overflow: hidden;
}

#stars {
width: 1px;
height: 1px;
background: transparent;
box-shadow: 259px 741px #FFF , 1171px 392px #FFF , 1328px 1128px #FFF , 989px 41px #FFF , 1428px 1339px #FFF , 438px 1414px #FFF , 1808px 311px #FFF , 1334px 351px #FFF , 424px 447px #FFF , 1719px 100px #FFF , 1812px 754px #FFF , 1945px 1768px #FFF , 1911px 261px #FFF , 1508px 8px #FFF , 1414px 605px #FFF , 865px 1634px #FFF , 1202px 222px #FFF , 1779px 1740px #FFF , 550px 1373px #FFF , 285px 1254px #FFF , 1134px 1444px #FFF , 309px 1656px #FFF , 236px 98px #FFF , 174px 912px #FFF , 1039px 406px #FFF , 1736px 647px #FFF , 1650px 1411px #FFF , 1863px 970px #FFF , 1624px 3px #FFF , 792px 11px #FFF , 606px 1836px #FFF , 812px 787px #FFF , 1722px 1094px #FFF , 634px 541px #FFF , 1819px 1403px #FFF , 1089px 1991px #FFF , 430px 185px #FFF , 486px 1570px #FFF , 1170px 1614px #FFF , 312px 1455px #FFF , 1657px 901px #FFF , 1492px 1501px #FFF , 896px 1802px #FFF , 632px 599px #FFF , 1792px 297px #FFF , 1243px 1700px #FFF , 1753px 284px #FFF , 306px 1346px #FFF , 714px 1814px #FFF , 1845px 1302px #FFF , 1117px 1190px #FFF , 738px 308px #FFF , 1438px 984px #FFF , 491px 996px #FFF , 548px 1738px #FFF , 54px 1159px #FFF , 1137px 172px #FFF , 1923px 212px #FFF , 323px 778px #FFF , 295px 850px #FFF , 1355px 1265px #FFF , 1447px 1184px #FFF , 470px 1167px #FFF , 539px 1347px #FFF , 1900px 1761px #FFF , 136px 882px #FFF , 1849px 1166px #FFF , 994px 530px #FFF , 567px 1459px #FFF , 1145px 1777px #FFF , 1431px 776px #FFF , 1285px 443px #FFF , 1175px 1291px #FFF , 954px 1464px #FFF , 1517px 1803px #FFF , 1970px 1052px #FFF , 908px 1360px #FFF , 1673px 1747px #FFF , 1966px 1579px #FFF , 1817px 1813px #FFF , 1225px 923px #FFF , 608px 930px #FFF , 1710px 1951px #FFF , 1359px 724px #FFF , 71px 269px #FFF , 303px 1772px #FFF , 282px 60px #FFF , 1298px 566px #FFF , 1407px 889px #FFF , 1245px 682px #FFF , 52px 1951px #FFF , 1970px 1440px #FFF , 390px 649px #FFF , 1057px 146px #FFF , 1968px 36px #FFF , 1479px 295px #FFF , 843px 557px #FFF , 567px 1623px #FFF , 519px 768px #FFF , 261px 760px #FFF , 1092px 1112px #FFF , 671px 2px #FFF , 556px 581px #FFF , 853px 1131px #FFF , 1362px 1693px #FFF , 1250px 1584px #FFF , 579px 180px #FFF , 1043px 1051px #FFF , 1628px 1552px #FFF , 974px 1895px #FFF , 246px 1530px #FFF , 469px 1971px #FFF , 1319px 1767px #FFF , 178px 852px #FFF , 17px 1697px #FFF , 896px 1653px #FFF , 1670px 1307px #FFF , 405px 1170px #FFF , 586px 603px #FFF , 1807px 9px #FFF , 1621px 1345px #FFF , 1501px 1412px #FFF , 292px 1552px #FFF , 1363px 1226px #FFF , 1722px 736px #FFF , 311px 1586px #FFF , 1313px 787px #FFF , 1479px 563px #FFF , 687px 1861px #FFF , 870px 1691px #FFF , 543px 273px #FFF , 1258px 1252px #FFF , 184px 1776px #FFF , 1586px 609px #FFF , 976px 1519px #FFF , 82px 901px #FFF , 243px 1975px #FFF , 1678px 1115px #FFF , 754px 1840px #FFF , 965px 49px #FFF , 898px 1017px #FFF , 2000px 1962px #FFF , 1613px 338px #FFF , 828px 1615px #FFF , 1917px 1701px #FFF , 1593px 1402px #FFF , 520px 1109px #FFF , 608px 1464px #FFF , 371px 33px #FFF , 1465px 625px #FFF , 1330px 395px #FFF , 886px 11px #FFF , 1387px 1318px #FFF , 664px 37px #FFF , 1805px 355px #FFF , 602px 586px #FFF , 748px 1608px #FFF , 875px 189px #FFF , 243px 1857px #FFF , 1571px 1707px #FFF , 1874px 1407px #FFF , 1450px 1642px #FFF , 49px 1742px #FFF , 735px 873px #FFF , 18px 933px #FFF , 325px 1648px #FFF , 1924px 819px #FFF , 435px 1628px #FFF , 821px 1032px #FFF , 1488px 1362px #FFF , 1028px 1234px #FFF , 1475px 935px #FFF , 1263px 1713px #FFF , 1416px 1922px #FFF , 1125px 1696px #FFF , 1313px 1749px #FFF , 476px 1613px #FFF , 1709px 1163px #FFF , 240px 421px #FFF , 1966px 1740px #FFF , 820px 795px #FFF , 943px 1523px #FFF , 1617px 858px #FFF , 976px 1393px #FFF , 1959px 1951px #FFF , 319px 1303px #FFF , 724px 879px #FFF , 827px 1448px #FFF , 1738px 684px #FFF , 1196px 1462px #FFF , 658px 1194px #FFF , 989px 826px #FFF , 606px 883px #FFF , 163px 807px #FFF , 517px 688px #FFF , 432px 490px #FFF , 1400px 1066px #FFF , 1143px 1307px #FFF , 741px 1402px #FFF , 1568px 1866px #FFF , 70px 623px #FFF , 1001px 499px #FFF , 778px 877px #FFF , 727px 1861px #FFF , 1644px 815px #FFF , 632px 242px #FFF , 260px 1479px #FFF , 370px 185px #FFF , 762px 1769px #FFF , 782px 1332px #FFF , 1185px 476px #FFF , 811px 1836px #FFF , 1009px 1004px #FFF , 1316px 670px #FFF , 1768px 1232px #FFF , 908px 1736px #FFF , 1202px 1472px #FFF , 291px 315px #FFF , 1601px 1695px #FFF , 1237px 891px #FFF , 1209px 1644px #FFF , 427px 1970px #FFF , 1169px 1330px #FFF , 757px 823px #FFF , 1700px 616px #FFF , 1914px 154px #FFF , 1315px 645px #FFF , 1709px 271px #FFF , 1651px 1151px #FFF , 118px 1337px #FFF , 1749px 494px #FFF , 276px 552px #FFF , 354px 1027px #FFF , 292px 178px #FFF , 809px 1810px #FFF , 941px 361px #FFF , 157px 1875px #FFF , 1181px 602px #FFF , 1005px 1749px #FFF , 1488px 736px #FFF , 1809px 5px #FFF , 1541px 320px #FFF , 337px 1787px #FFF , 1540px 1065px #FFF , 1856px 1768px #FFF , 874px 1402px #FFF , 641px 1693px #FFF , 1380px 1192px #FFF , 1388px 382px #FFF , 953px 840px #FFF , 1346px 1811px #FFF , 1275px 316px #FFF , 209px 552px #FFF , 548px 7px #FFF , 1px 734px #FFF , 449px 662px #FFF , 1978px 718px #FFF , 389px 869px #FFF , 1498px 406px #FFF , 743px 239px #FFF , 477px 1395px #FFF , 1170px 240px #FFF , 1580px 522px #FFF , 1124px 1028px #FFF , 1117px 1569px #FFF , 283px 915px #FFF , 868px 1865px #FFF , 1105px 1282px #FFF , 253px 255px #FFF , 1769px 1155px #FFF , 80px 644px #FFF , 21px 1121px #FFF , 991px 1206px #FFF , 1704px 1278px #FFF , 775px 1832px #FFF , 1186px 327px #FFF , 287px 1272px #FFF , 1307px 715px #FFF , 1189px 1297px #FFF , 1325px 861px #FFF , 1172px 17px #FFF , 1549px 1414px #FFF , 1752px 95px #FFF , 1830px 1619px #FFF , 1936px 1454px #FFF , 1880px 1911px #FFF , 730px 1349px #FFF , 1676px 415px #FFF , 291px 234px #FFF , 732px 1040px #FFF , 1852px 187px #FFF , 1086px 1519px #FFF , 489px 709px #FFF , 752px 38px #FFF , 1081px 998px #FFF , 1801px 1825px #FFF , 1454px 1509px #FFF , 276px 460px #FFF , 1658px 469px #FFF , 970px 1434px #FFF , 786px 1333px #FFF , 424px 1235px #FFF , 1951px 889px #FFF , 1640px 951px #FFF , 644px 596px #FFF , 1095px 1470px #FFF , 229px 505px #FFF , 1554px 1043px #FFF , 1403px 898px #FFF , 599px 1531px #FFF , 692px 1146px #FFF , 686px 960px #FFF , 1492px 1189px #FFF , 1747px 1676px #FFF , 506px 1170px #FFF , 222px 560px #FFF , 632px 1211px #FFF , 353px 800px #FFF , 1089px 761px #FFF , 1835px 1122px #FFF , 704px 84px #FFF , 1636px 781px #FFF , 445px 55px #FFF , 1336px 1058px #FFF , 1777px 203px #FFF , 390px 459px #FFF , 1818px 718px #FFF , 1476px 51px #FFF , 1075px 1338px #FFF , 166px 710px #FFF , 1225px 1982px #FFF , 1529px 225px #FFF , 1800px 53px #FFF , 570px 1974px #FFF , 108px 1255px #FFF , 712px 1374px #FFF , 1610px 1080px #FFF , 883px 796px #FFF , 1738px 574px #FFF , 688px 249px #FFF , 185px 168px #FFF , 1849px 1064px #FFF , 708px 1205px #FFF , 972px 198px #FFF , 1432px 1525px #FFF , 1076px 1008px #FFF , 958px 178px #FFF , 1726px 618px #FFF , 488px 1760px #FFF , 1377px 675px #FFF , 172px 132px #FFF , 1433px 1888px #FFF , 245px 771px #FFF , 1712px 911px #FFF , 484px 439px #FFF , 437px 1123px #FFF , 1757px 1589px #FFF , 680px 168px #FFF , 872px 1795px #FFF , 1888px 94px #FFF , 1475px 154px #FFF , 1413px 1605px #FFF , 940px 727px #FFF , 1611px 869px #FFF , 634px 1168px #FFF , 1082px 628px #FFF , 471px 1318px #FFF , 259px 746px #FFF , 512px 231px #FFF , 285px 5px #FFF , 1901px 1307px #FFF , 723px 278px #FFF , 1605px 112px #FFF , 635px 556px #FFF , 1191px 187px #FFF , 1432px 1249px #FFF , 1314px 1968px #FFF , 1708px 1911px #FFF , 1856px 330px #FFF , 523px 1501px #FFF , 521px 323px #FFF , 1042px 852px #FFF , 926px 1070px #FFF , 1914px 982px #FFF , 1957px 1242px #FFF , 1148px 962px #FFF , 1498px 1363px #FFF , 162px 473px #FFF , 1335px 457px #FFF , 558px 480px #FFF , 6px 915px #FFF , 1614px 580px #FFF , 1862px 908px #FFF , 564px 1955px #FFF , 1997px 74px #FFF , 1349px 9px #FFF , 1341px 178px #FFF , 1311px 843px #FFF , 303px 1518px #FFF , 1611px 682px #FFF , 232px 966px #FFF , 1775px 389px #FFF , 1683px 1224px #FFF , 330px 794px #FFF , 1276px 541px #FFF , 1475px 1569px #FFF , 1955px 1620px #FFF , 435px 1679px #FFF , 1060px 125px #FFF , 220px 1981px #FFF , 1551px 1087px #FFF , 244px 115px #FFF , 1611px 928px #FFF , 744px 1617px #FFF , 781px 843px #FFF , 265px 1838px #FFF , 986px 541px #FFF , 1581px 701px #FFF , 905px 960px #FFF , 1225px 1899px #FFF , 1103px 1866px #FFF , 1463px 1927px #FFF , 1866px 1497px #FFF , 1263px 1659px #FFF , 1422px 320px #FFF , 1245px 1725px #FFF , 773px 1232px #FFF , 668px 135px #FFF , 630px 23px #FFF , 1859px 125px #FFF , 309px 1131px #FFF , 1139px 1878px #FFF , 331px 342px #FFF , 1866px 1449px #FFF , 853px 82px #FFF , 1982px 1711px #FFF , 1704px 341px #FFF , 108px 1137px #FFF , 388px 662px #FFF , 92px 1804px #FFF , 362px 517px #FFF , 916px 60px #FFF , 1529px 1907px #FFF , 1346px 1321px #FFF , 1780px 709px #FFF , 1362px 1618px #FFF , 519px 1476px #FFF , 1441px 276px #FFF , 1666px 1495px #FFF , 1426px 1973px #FFF , 645px 369px #FFF , 1019px 1687px #FFF , 1112px 1833px #FFF , 800px 1633px #FFF , 1731px 1569px #FFF , 801px 1808px #FFF , 1332px 925px #FFF , 361px 562px #FFF , 1822px 1295px #FFF , 1803px 607px #FFF , 1587px 986px #FFF , 1977px 954px #FFF , 292px 1028px #FFF , 631px 1142px #FFF , 247px 212px #FFF , 405px 810px #FFF , 57px 869px #FFF , 376px 1915px #FFF , 1811px 924px #FFF , 211px 1788px #FFF , 196px 1975px #FFF , 1329px 1428px #FFF , 1840px 1817px #FFF , 70px 426px #FFF , 1199px 1833px #FFF , 1011px 1754px #FFF , 255px 1983px #FFF , 1842px 408px #FFF , 1011px 357px #FFF , 1442px 1730px #FFF , 1834px 1651px #FFF , 980px 884px #FFF , 762px 1985px #FFF , 1639px 1110px #FFF , 947px 281px #FFF , 538px 1216px #FFF , 76px 1596px #FFF , 1597px 585px #FFF , 1352px 1990px #FFF , 702px 127px #FFF , 351px 724px #FFF , 358px 817px #FFF , 1382px 673px #FFF , 151px 1610px #FFF , 1001px 1642px #FFF , 436px 1681px #FFF , 1442px 111px #FFF , 1619px 354px #FFF , 187px 1758px #FFF , 453px 1370px #FFF , 97px 561px #FFF , 107px 788px #FFF , 903px 903px #FFF , 1916px 1703px #FFF , 1753px 590px #FFF , 1564px 149px #FFF , 1719px 569px #FFF , 1184px 403px #FFF , 1999px 761px #FFF , 628px 781px #FFF , 1952px 208px #FFF , 1144px 522px #FFF , 205px 1816px #FFF , 1929px 1720px #FFF , 684px 1011px #FFF , 80px 140px #FFF , 53px 345px #FFF , 1948px 1761px #FFF , 69px 604px #FFF , 954px 1151px #FFF , 1546px 689px #FFF , 966px 1978px #FFF , 1358px 224px #FFF , 1338px 672px #FFF , 1094px 1723px #FFF , 261px 473px #FFF , 1578px 1830px #FFF , 1131px 108px #FFF , 67px 1463px #FFF , 1254px 812px #FFF , 655px 1563px #FFF , 1433px 1066px #FFF , 205px 343px #FFF , 1409px 1704px #FFF , 1606px 152px #FFF , 1167px 128px #FFF , 749px 1730px #FFF , 1762px 1578px #FFF , 407px 591px #FFF , 439px 1364px #FFF , 923px 605px #FFF , 1098px 1689px #FFF , 1380px 348px #FFF , 117px 1139px #FFF , 748px 820px #FFF , 1919px 473px #FFF , 292px 454px #FFF , 1777px 1243px #FFF , 1116px 1846px #FFF , 1784px 1246px #FFF , 1416px 871px #FFF , 1660px 1562px #FFF , 389px 964px #FFF , 1107px 384px #FFF , 1870px 800px #FFF , 334px 767px #FFF , 1521px 112px #FFF , 1401px 1402px #FFF , 1805px 1192px #FFF , 1308px 1854px #FFF , 1852px 212px #FFF , 739px 288px #FFF , 360px 990px #FFF , 402px 904px #FFF , 995px 1128px #FFF , 341px 825px #FFF , 1632px 1768px #FFF , 1971px 1162px #FFF , 926px 663px #FFF , 884px 408px #FFF , 695px 1238px #FFF , 501px 1996px #FFF , 1343px 259px #FFF , 1780px 54px #FFF , 874px 1936px #FFF , 757px 623px #FFF , 1060px 1988px #FFF , 753px 86px #FFF , 718px 369px #FFF , 869px 868px #FFF , 1674px 527px #FFF , 455px 199px #FFF , 479px 1903px #FFF , 669px 1839px #FFF , 438px 1669px #FFF , 358px 1157px #FFF , 1671px 424px #FFF , 1837px 1880px #FFF , 1447px 41px #FFF , 535px 769px #FFF , 1095px 69px #FFF , 559px 1132px #FFF , 361px 1834px #FFF , 1649px 1321px #FFF , 1696px 320px #FFF , 1163px 1925px #FFF , 1262px 703px #FFF , 1706px 133px #FFF , 1722px 409px #FFF , 585px 1844px #FFF , 280px 1022px #FFF , 1580px 1193px #FFF , 1008px 1608px #FFF , 101px 1467px #FFF , 1393px 82px #FFF , 153px 1163px #FFF , 748px 1230px #FFF , 535px 1072px #FFF , 1126px 416px #FFF , 183px 1215px #FFF , 1953px 1939px #FFF , 1749px 250px #FFF , 1252px 892px #FFF , 614px 1391px #FFF , 848px 1521px #FFF , 1044px 1442px #FFF , 1208px 1176px #FFF , 726px 273px #FFF , 613px 1490px #FFF , 104px 475px #FFF , 157px 1806px #FFF , 1804px 1606px #FFF , 1293px 847px #FFF , 78px 1734px #FFF , 904px 1054px #FFF , 793px 94px #FFF , 547px 1499px #FFF , 994px 1355px #FFF , 69px 160px #FFF , 1649px 397px #FFF , 97px 1917px #FFF , 554px 1858px #FFF , 1202px 667px #FFF , 1672px 1457px #FFF , 310px 1556px #FFF , 1550px 396px #FFF , 1309px 1402px #FFF , 945px 229px #FFF , 1147px 1129px #FFF , 775px 348px #FFF , 125px 1550px #FFF , 458px 301px #FFF , 1627px 178px #FFF , 45px 445px #FFF , 405px 1892px #FFF , 189px 273px #FFF , 1446px 1326px #FFF , 115px 1657px #FFF , 796px 1003px #FFF , 561px 459px #FFF , 933px 382px #FFF , 77px 456px #FFF , 1869px 822px #FFF , 1878px 1041px #FFF , 1725px 121px #FFF , 324px 999px #FFF , 591px 422px #FFF , 1522px 416px #FFF , 189px 435px #FFF , 634px 1230px #FFF , 17px 1783px #FFF , 1007px 1137px #FFF , 480px 1193px #FFF , 1541px 1227px #FFF , 740px 615px #FFF , 155px 1647px #FFF , 983px 846px #FFF , 1437px 140px #FFF , 1150px 614px #FFF , 1889px 648px #FFF , 1640px 415px #FFF , 1083px 1172px #FFF , 875px 1174px #FFF , 1647px 500px #FFF , 1701px 809px #FFF , 130px 1374px #FFF , 697px 1809px #FFF , 396px 1707px #FFF , 1854px 788px #FFF , 748px 861px #FFF , 392px 985px #FFF , 411px 918px #FFF , 1111px 28px #FFF , 1940px 1552px #FFF , 1150px 1409px #FFF , 1865px 864px #FFF , 1294px 364px #FFF , 1726px 64px #FFF , 745px 893px #FFF , 473px 140px #FFF , 404px 210px #FFF , 732px 645px #FFF , 321px 810px #FFF , 1896px 490px #FFF , 1308px 682px #FFF , 1421px 497px #FFF , 266px 1822px #FFF , 910px 1771px #FFF , 1228px 998px #FFF , 1933px 1282px #FFF;
animation: animStar 50s linear infinite;
}
#stars:after {
content: " ";
position: absolute;
top: 2000px;
width: 1px;
height: 1px;
background: transparent;
box-shadow: 259px 741px #FFF , 1171px 392px #FFF , 1328px 1128px #FFF , 989px 41px #FFF , 1428px 1339px #FFF , 438px 1414px #FFF , 1808px 311px #FFF , 1334px 351px #FFF , 424px 447px #FFF , 1719px 100px #FFF , 1812px 754px #FFF , 1945px 1768px #FFF , 1911px 261px #FFF , 1508px 8px #FFF , 1414px 605px #FFF , 865px 1634px #FFF , 1202px 222px #FFF , 1779px 1740px #FFF , 550px 1373px #FFF , 285px 1254px #FFF , 1134px 1444px #FFF , 309px 1656px #FFF , 236px 98px #FFF , 174px 912px #FFF , 1039px 406px #FFF , 1736px 647px #FFF , 1650px 1411px #FFF , 1863px 970px #FFF , 1624px 3px #FFF , 792px 11px #FFF , 606px 1836px #FFF , 812px 787px #FFF , 1722px 1094px #FFF , 634px 541px #FFF , 1819px 1403px #FFF , 1089px 1991px #FFF , 430px 185px #FFF , 486px 1570px #FFF , 1170px 1614px #FFF , 312px 1455px #FFF , 1657px 901px #FFF , 1492px 1501px #FFF , 896px 1802px #FFF , 632px 599px #FFF , 1792px 297px #FFF , 1243px 1700px #FFF , 1753px 284px #FFF , 306px 1346px #FFF , 714px 1814px #FFF , 1845px 1302px #FFF , 1117px 1190px #FFF , 738px 308px #FFF , 1438px 984px #FFF , 491px 996px #FFF , 548px 1738px #FFF , 54px 1159px #FFF , 1137px 172px #FFF , 1923px 212px #FFF , 323px 778px #FFF , 295px 850px #FFF , 1355px 1265px #FFF , 1447px 1184px #FFF , 470px 1167px #FFF , 539px 1347px #FFF , 1900px 1761px #FFF , 136px 882px #FFF , 1849px 1166px #FFF , 994px 530px #FFF , 567px 1459px #FFF , 1145px 1777px #FFF , 1431px 776px #FFF , 1285px 443px #FFF , 1175px 1291px #FFF , 954px 1464px #FFF , 1517px 1803px #FFF , 1970px 1052px #FFF , 908px 1360px #FFF , 1673px 1747px #FFF , 1966px 1579px #FFF , 1817px 1813px #FFF , 1225px 923px #FFF , 608px 930px #FFF , 1710px 1951px #FFF , 1359px 724px #FFF , 71px 269px #FFF , 303px 1772px #FFF , 282px 60px #FFF , 1298px 566px #FFF , 1407px 889px #FFF , 1245px 682px #FFF , 52px 1951px #FFF , 1970px 1440px #FFF , 390px 649px #FFF , 1057px 146px #FFF , 1968px 36px #FFF , 1479px 295px #FFF , 843px 557px #FFF , 567px 1623px #FFF , 519px 768px #FFF , 261px 760px #FFF , 1092px 1112px #FFF , 671px 2px #FFF , 556px 581px #FFF , 853px 1131px #FFF , 1362px 1693px #FFF , 1250px 1584px #FFF , 579px 180px #FFF , 1043px 1051px #FFF , 1628px 1552px #FFF , 974px 1895px #FFF , 246px 1530px #FFF , 469px 1971px #FFF , 1319px 1767px #FFF , 178px 852px #FFF , 17px 1697px #FFF , 896px 1653px #FFF , 1670px 1307px #FFF , 405px 1170px #FFF , 586px 603px #FFF , 1807px 9px #FFF , 1621px 1345px #FFF , 1501px 1412px #FFF , 292px 1552px #FFF , 1363px 1226px #FFF , 1722px 736px #FFF , 311px 1586px #FFF , 1313px 787px #FFF , 1479px 563px #FFF , 687px 1861px #FFF , 870px 1691px #FFF , 543px 273px #FFF , 1258px 1252px #FFF , 184px 1776px #FFF , 1586px 609px #FFF , 976px 1519px #FFF , 82px 901px #FFF , 243px 1975px #FFF , 1678px 1115px #FFF , 754px 1840px #FFF , 965px 49px #FFF , 898px 1017px #FFF , 2000px 1962px #FFF , 1613px 338px #FFF , 828px 1615px #FFF , 1917px 1701px #FFF , 1593px 1402px #FFF , 520px 1109px #FFF , 608px 1464px #FFF , 371px 33px #FFF , 1465px 625px #FFF , 1330px 395px #FFF , 886px 11px #FFF , 1387px 1318px #FFF , 664px 37px #FFF , 1805px 355px #FFF , 602px 586px #FFF , 748px 1608px #FFF , 875px 189px #FFF , 243px 1857px #FFF , 1571px 1707px #FFF , 1874px 1407px #FFF , 1450px 1642px #FFF , 49px 1742px #FFF , 735px 873px #FFF , 18px 933px #FFF , 325px 1648px #FFF , 1924px 819px #FFF , 435px 1628px #FFF , 821px 1032px #FFF , 1488px 1362px #FFF , 1028px 1234px #FFF , 1475px 935px #FFF , 1263px 1713px #FFF , 1416px 1922px #FFF , 1125px 1696px #FFF , 1313px 1749px #FFF , 476px 1613px #FFF , 1709px 1163px #FFF , 240px 421px #FFF , 1966px 1740px #FFF , 820px 795px #FFF , 943px 1523px #FFF , 1617px 858px #FFF , 976px 1393px #FFF , 1959px 1951px #FFF , 319px 1303px #FFF , 724px 879px #FFF , 827px 1448px #FFF , 1738px 684px #FFF , 1196px 1462px #FFF , 658px 1194px #FFF , 989px 826px #FFF , 606px 883px #FFF , 163px 807px #FFF , 517px 688px #FFF , 432px 490px #FFF , 1400px 1066px #FFF , 1143px 1307px #FFF , 741px 1402px #FFF , 1568px 1866px #FFF , 70px 623px #FFF , 1001px 499px #FFF , 778px 877px #FFF , 727px 1861px #FFF , 1644px 815px #FFF , 632px 242px #FFF , 260px 1479px #FFF , 370px 185px #FFF , 762px 1769px #FFF , 782px 1332px #FFF , 1185px 476px #FFF , 811px 1836px #FFF , 1009px 1004px #FFF , 1316px 670px #FFF , 1768px 1232px #FFF , 908px 1736px #FFF , 1202px 1472px #FFF , 291px 315px #FFF , 1601px 1695px #FFF , 1237px 891px #FFF , 1209px 1644px #FFF , 427px 1970px #FFF , 1169px 1330px #FFF , 757px 823px #FFF , 1700px 616px #FFF , 1914px 154px #FFF , 1315px 645px #FFF , 1709px 271px #FFF , 1651px 1151px #FFF , 118px 1337px #FFF , 1749px 494px #FFF , 276px 552px #FFF , 354px 1027px #FFF , 292px 178px #FFF , 809px 1810px #FFF , 941px 361px #FFF , 157px 1875px #FFF , 1181px 602px #FFF , 1005px 1749px #FFF , 1488px 736px #FFF , 1809px 5px #FFF , 1541px 320px #FFF , 337px 1787px #FFF , 1540px 1065px #FFF , 1856px 1768px #FFF , 874px 1402px #FFF , 641px 1693px #FFF , 1380px 1192px #FFF , 1388px 382px #FFF , 953px 840px #FFF , 1346px 1811px #FFF , 1275px 316px #FFF , 209px 552px #FFF , 548px 7px #FFF , 1px 734px #FFF , 449px 662px #FFF , 1978px 718px #FFF , 389px 869px #FFF , 1498px 406px #FFF , 743px 239px #FFF , 477px 1395px #FFF , 1170px 240px #FFF , 1580px 522px #FFF , 1124px 1028px #FFF , 1117px 1569px #FFF , 283px 915px #FFF , 868px 1865px #FFF , 1105px 1282px #FFF , 253px 255px #FFF , 1769px 1155px #FFF , 80px 644px #FFF , 21px 1121px #FFF , 991px 1206px #FFF , 1704px 1278px #FFF , 775px 1832px #FFF , 1186px 327px #FFF , 287px 1272px #FFF , 1307px 715px #FFF , 1189px 1297px #FFF , 1325px 861px #FFF , 1172px 17px #FFF , 1549px 1414px #FFF , 1752px 95px #FFF , 1830px 1619px #FFF , 1936px 1454px #FFF , 1880px 1911px #FFF , 730px 1349px #FFF , 1676px 415px #FFF , 291px 234px #FFF , 732px 1040px #FFF , 1852px 187px #FFF , 1086px 1519px #FFF , 489px 709px #FFF , 752px 38px #FFF , 1081px 998px #FFF , 1801px 1825px #FFF , 1454px 1509px #FFF , 276px 460px #FFF , 1658px 469px #FFF , 970px 1434px #FFF , 786px 1333px #FFF , 424px 1235px #FFF , 1951px 889px #FFF , 1640px 951px #FFF , 644px 596px #FFF , 1095px 1470px #FFF , 229px 505px #FFF , 1554px 1043px #FFF , 1403px 898px #FFF , 599px 1531px #FFF , 692px 1146px #FFF , 686px 960px #FFF , 1492px 1189px #FFF , 1747px 1676px #FFF , 506px 1170px #FFF , 222px 560px #FFF , 632px 1211px #FFF , 353px 800px #FFF , 1089px 761px #FFF , 1835px 1122px #FFF , 704px 84px #FFF , 1636px 781px #FFF , 445px 55px #FFF , 1336px 1058px #FFF , 1777px 203px #FFF , 390px 459px #FFF , 1818px 718px #FFF , 1476px 51px #FFF , 1075px 1338px #FFF , 166px 710px #FFF , 1225px 1982px #FFF , 1529px 225px #FFF , 1800px 53px #FFF , 570px 1974px #FFF , 108px 1255px #FFF , 712px 1374px #FFF , 1610px 1080px #FFF , 883px 796px #FFF , 1738px 574px #FFF , 688px 249px #FFF , 185px 168px #FFF , 1849px 1064px #FFF , 708px 1205px #FFF , 972px 198px #FFF , 1432px 1525px #FFF , 1076px 1008px #FFF , 958px 178px #FFF , 1726px 618px #FFF , 488px 1760px #FFF , 1377px 675px #FFF , 172px 132px #FFF , 1433px 1888px #FFF , 245px 771px #FFF , 1712px 911px #FFF , 484px 439px #FFF , 437px 1123px #FFF , 1757px 1589px #FFF , 680px 168px #FFF , 872px 1795px #FFF , 1888px 94px #FFF , 1475px 154px #FFF , 1413px 1605px #FFF , 940px 727px #FFF , 1611px 869px #FFF , 634px 1168px #FFF , 1082px 628px #FFF , 471px 1318px #FFF , 259px 746px #FFF , 512px 231px #FFF , 285px 5px #FFF , 1901px 1307px #FFF , 723px 278px #FFF , 1605px 112px #FFF , 635px 556px #FFF , 1191px 187px #FFF , 1432px 1249px #FFF , 1314px 1968px #FFF , 1708px 1911px #FFF , 1856px 330px #FFF , 523px 1501px #FFF , 521px 323px #FFF , 1042px 852px #FFF , 926px 1070px #FFF , 1914px 982px #FFF , 1957px 1242px #FFF , 1148px 962px #FFF , 1498px 1363px #FFF , 162px 473px #FFF , 1335px 457px #FFF , 558px 480px #FFF , 6px 915px #FFF , 1614px 580px #FFF , 1862px 908px #FFF , 564px 1955px #FFF , 1997px 74px #FFF , 1349px 9px #FFF , 1341px 178px #FFF , 1311px 843px #FFF , 303px 1518px #FFF , 1611px 682px #FFF , 232px 966px #FFF , 1775px 389px #FFF , 1683px 1224px #FFF , 330px 794px #FFF , 1276px 541px #FFF , 1475px 1569px #FFF , 1955px 1620px #FFF , 435px 1679px #FFF , 1060px 125px #FFF , 220px 1981px #FFF , 1551px 1087px #FFF , 244px 115px #FFF , 1611px 928px #FFF , 744px 1617px #FFF , 781px 843px #FFF , 265px 1838px #FFF , 986px 541px #FFF , 1581px 701px #FFF , 905px 960px #FFF , 1225px 1899px #FFF , 1103px 1866px #FFF , 1463px 1927px #FFF , 1866px 1497px #FFF , 1263px 1659px #FFF , 1422px 320px #FFF , 1245px 1725px #FFF , 773px 1232px #FFF , 668px 135px #FFF , 630px 23px #FFF , 1859px 125px #FFF , 309px 1131px #FFF , 1139px 1878px #FFF , 331px 342px #FFF , 1866px 1449px #FFF , 853px 82px #FFF , 1982px 1711px #FFF , 1704px 341px #FFF , 108px 1137px #FFF , 388px 662px #FFF , 92px 1804px #FFF , 362px 517px #FFF , 916px 60px #FFF , 1529px 1907px #FFF , 1346px 1321px #FFF , 1780px 709px #FFF , 1362px 1618px #FFF , 519px 1476px #FFF , 1441px 276px #FFF , 1666px 1495px #FFF , 1426px 1973px #FFF , 645px 369px #FFF , 1019px 1687px #FFF , 1112px 1833px #FFF , 800px 1633px #FFF , 1731px 1569px #FFF , 801px 1808px #FFF , 1332px 925px #FFF , 361px 562px #FFF , 1822px 1295px #FFF , 1803px 607px #FFF , 1587px 986px #FFF , 1977px 954px #FFF , 292px 1028px #FFF , 631px 1142px #FFF , 247px 212px #FFF , 405px 810px #FFF , 57px 869px #FFF , 376px 1915px #FFF , 1811px 924px #FFF , 211px 1788px #FFF , 196px 1975px #FFF , 1329px 1428px #FFF , 1840px 1817px #FFF , 70px 426px #FFF , 1199px 1833px #FFF , 1011px 1754px #FFF , 255px 1983px #FFF , 1842px 408px #FFF , 1011px 357px #FFF , 1442px 1730px #FFF , 1834px 1651px #FFF , 980px 884px #FFF , 762px 1985px #FFF , 1639px 1110px #FFF , 947px 281px #FFF , 538px 1216px #FFF , 76px 1596px #FFF , 1597px 585px #FFF , 1352px 1990px #FFF , 702px 127px #FFF , 351px 724px #FFF , 358px 817px #FFF , 1382px 673px #FFF , 151px 1610px #FFF , 1001px 1642px #FFF , 436px 1681px #FFF , 1442px 111px #FFF , 1619px 354px #FFF , 187px 1758px #FFF , 453px 1370px #FFF , 97px 561px #FFF , 107px 788px #FFF , 903px 903px #FFF , 1916px 1703px #FFF , 1753px 590px #FFF , 1564px 149px #FFF , 1719px 569px #FFF , 1184px 403px #FFF , 1999px 761px #FFF , 628px 781px #FFF , 1952px 208px #FFF , 1144px 522px #FFF , 205px 1816px #FFF , 1929px 1720px #FFF , 684px 1011px #FFF , 80px 140px #FFF , 53px 345px #FFF , 1948px 1761px #FFF , 69px 604px #FFF , 954px 1151px #FFF , 1546px 689px #FFF , 966px 1978px #FFF , 1358px 224px #FFF , 1338px 672px #FFF , 1094px 1723px #FFF , 261px 473px #FFF , 1578px 1830px #FFF , 1131px 108px #FFF , 67px 1463px #FFF , 1254px 812px #FFF , 655px 1563px #FFF , 1433px 1066px #FFF , 205px 343px #FFF , 1409px 1704px #FFF , 1606px 152px #FFF , 1167px 128px #FFF , 749px 1730px #FFF , 1762px 1578px #FFF , 407px 591px #FFF , 439px 1364px #FFF , 923px 605px #FFF , 1098px 1689px #FFF , 1380px 348px #FFF , 117px 1139px #FFF , 748px 820px #FFF , 1919px 473px #FFF , 292px 454px #FFF , 1777px 1243px #FFF , 1116px 1846px #FFF , 1784px 1246px #FFF , 1416px 871px #FFF , 1660px 1562px #FFF , 389px 964px #FFF , 1107px 384px #FFF , 1870px 800px #FFF , 334px 767px #FFF , 1521px 112px #FFF , 1401px 1402px #FFF , 1805px 1192px #FFF , 1308px 1854px #FFF , 1852px 212px #FFF , 739px 288px #FFF , 360px 990px #FFF , 402px 904px #FFF , 995px 1128px #FFF , 341px 825px #FFF , 1632px 1768px #FFF , 1971px 1162px #FFF , 926px 663px #FFF , 884px 408px #FFF , 695px 1238px #FFF , 501px 1996px #FFF , 1343px 259px #FFF , 1780px 54px #FFF , 874px 1936px #FFF , 757px 623px #FFF , 1060px 1988px #FFF , 753px 86px #FFF , 718px 369px #FFF , 869px 868px #FFF , 1674px 527px #FFF , 455px 199px #FFF , 479px 1903px #FFF , 669px 1839px #FFF , 438px 1669px #FFF , 358px 1157px #FFF , 1671px 424px #FFF , 1837px 1880px #FFF , 1447px 41px #FFF , 535px 769px #FFF , 1095px 69px #FFF , 559px 1132px #FFF , 361px 1834px #FFF , 1649px 1321px #FFF , 1696px 320px #FFF , 1163px 1925px #FFF , 1262px 703px #FFF , 1706px 133px #FFF , 1722px 409px #FFF , 585px 1844px #FFF , 280px 1022px #FFF , 1580px 1193px #FFF , 1008px 1608px #FFF , 101px 1467px #FFF , 1393px 82px #FFF , 153px 1163px #FFF , 748px 1230px #FFF , 535px 1072px #FFF , 1126px 416px #FFF , 183px 1215px #FFF , 1953px 1939px #FFF , 1749px 250px #FFF , 1252px 892px #FFF , 614px 1391px #FFF , 848px 1521px #FFF , 1044px 1442px #FFF , 1208px 1176px #FFF , 726px 273px #FFF , 613px 1490px #FFF , 104px 475px #FFF , 157px 1806px #FFF , 1804px 1606px #FFF , 1293px 847px #FFF , 78px 1734px #FFF , 904px 1054px #FFF , 793px 94px #FFF , 547px 1499px #FFF , 994px 1355px #FFF , 69px 160px #FFF , 1649px 397px #FFF , 97px 1917px #FFF , 554px 1858px #FFF , 1202px 667px #FFF , 1672px 1457px #FFF , 310px 1556px #FFF , 1550px 396px #FFF , 1309px 1402px #FFF , 945px 229px #FFF , 1147px 1129px #FFF , 775px 348px #FFF , 125px 1550px #FFF , 458px 301px #FFF , 1627px 178px #FFF , 45px 445px #FFF , 405px 1892px #FFF , 189px 273px #FFF , 1446px 1326px #FFF , 115px 1657px #FFF , 796px 1003px #FFF , 561px 459px #FFF , 933px 382px #FFF , 77px 456px #FFF , 1869px 822px #FFF , 1878px 1041px #FFF , 1725px 121px #FFF , 324px 999px #FFF , 591px 422px #FFF , 1522px 416px #FFF , 189px 435px #FFF , 634px 1230px #FFF , 17px 1783px #FFF , 1007px 1137px #FFF , 480px 1193px #FFF , 1541px 1227px #FFF , 740px 615px #FFF , 155px 1647px #FFF , 983px 846px #FFF , 1437px 140px #FFF , 1150px 614px #FFF , 1889px 648px #FFF , 1640px 415px #FFF , 1083px 1172px #FFF , 875px 1174px #FFF , 1647px 500px #FFF , 1701px 809px #FFF , 130px 1374px #FFF , 697px 1809px #FFF , 396px 1707px #FFF , 1854px 788px #FFF , 748px 861px #FFF , 392px 985px #FFF , 411px 918px #FFF , 1111px 28px #FFF , 1940px 1552px #FFF , 1150px 1409px #FFF , 1865px 864px #FFF , 1294px 364px #FFF , 1726px 64px #FFF , 745px 893px #FFF , 473px 140px #FFF , 404px 210px #FFF , 732px 645px #FFF , 321px 810px #FFF , 1896px 490px #FFF , 1308px 682px #FFF , 1421px 497px #FFF , 266px 1822px #FFF , 910px 1771px #FFF , 1228px 998px #FFF , 1933px 1282px #FFF;
}

#stars2 {
width: 2px;
height: 2px;
background: transparent;
box-shadow: 179px 816px #FFF , 1999px 214px #FFF , 141px 721px #FFF , 788px 212px #FFF , 1231px 164px #FFF , 1840px 1132px #FFF , 1724px 1942px #FFF , 1616px 614px #FFF , 920px 846px #FFF , 1477px 114px #FFF , 1475px 1466px #FFF , 919px 629px #FFF , 1399px 345px #FFF , 1353px 388px #FFF , 470px 1986px #FFF , 218px 1045px #FFF , 1881px 1795px #FFF , 1157px 1358px #FFF , 1635px 1472px #FFF , 1235px 176px #FFF , 1529px 801px #FFF , 51px 185px #FFF , 1322px 1396px #FFF , 583px 1088px #FFF , 1811px 1699px #FFF , 714px 1608px #FFF , 848px 1771px #FFF , 1240px 362px #FFF , 695px 1704px #FFF , 416px 133px #FFF , 1945px 1342px #FFF , 329px 942px #FFF , 442px 148px #FFF , 948px 1956px #FFF , 1639px 1019px #FFF , 920px 1814px #FFF , 1868px 908px #FFF , 1631px 1717px #FFF , 1952px 1113px #FFF , 486px 1388px #FFF , 144px 99px #FFF , 1154px 305px #FFF , 402px 1708px #FFF , 1375px 356px #FFF , 1999px 1910px #FFF , 1935px 1366px #FFF , 401px 884px #FFF , 1830px 1085px #FFF , 1768px 960px #FFF , 493px 179px #FFF , 810px 1791px #FFF , 99px 923px #FFF , 180px 1570px #FFF , 719px 1078px #FFF , 1780px 523px #FFF , 841px 1474px #FFF , 368px 226px #FFF , 1669px 1543px #FFF , 1433px 1077px #FFF , 1943px 1187px #FFF , 1060px 6px #FFF , 965px 333px #FFF , 1726px 836px #FFF , 375px 1959px #FFF , 183px 598px #FFF , 492px 596px #FFF , 64px 1767px #FFF , 155px 1972px #FFF , 1831px 698px #FFF , 863px 692px #FFF , 212px 261px #FFF , 865px 168px #FFF , 234px 641px #FFF , 1858px 1144px #FFF , 1762px 1158px #FFF , 43px 1465px #FFF , 1152px 351px #FFF , 1521px 1437px #FFF , 345px 21px #FFF , 1057px 1246px #FFF , 1229px 229px #FFF , 469px 589px #FFF , 422px 820px #FFF , 277px 2000px #FFF , 1172px 1302px #FFF , 1571px 1405px #FFF , 352px 307px #FFF , 1413px 1624px #FFF , 640px 549px #FFF , 9px 1197px #FFF , 859px 1964px #FFF , 164px 1259px #FFF , 530px 4px #FFF , 1073px 1058px #FFF , 228px 1590px #FFF , 1954px 1802px #FFF , 306px 835px #FFF , 1658px 1826px #FFF , 1528px 505px #FFF , 556px 1190px #FFF , 1613px 33px #FFF , 218px 191px #FFF , 223px 1967px #FFF , 800px 625px #FFF , 1640px 1913px #FFF , 1478px 475px #FFF , 1734px 1588px #FFF , 1693px 1194px #FFF , 179px 1282px #FFF , 899px 1913px #FFF , 26px 917px #FFF , 619px 214px #FFF , 1316px 1146px #FFF , 1888px 923px #FFF , 1986px 1634px #FFF , 20px 1709px #FFF , 913px 226px #FFF , 1061px 1762px #FFF , 881px 1709px #FFF , 1892px 674px #FFF , 1902px 1370px #FFF , 1088px 1285px #FFF , 1390px 1993px #FFF , 724px 1987px #FFF , 1986px 405px #FFF , 1717px 339px #FFF , 1247px 740px #FFF , 1834px 1112px #FFF , 439px 1161px #FFF , 1595px 204px #FFF , 566px 1222px #FFF , 856px 1935px #FFF , 768px 1038px #FFF , 897px 111px #FFF , 1259px 613px #FFF , 995px 324px #FFF , 1063px 697px #FFF , 1396px 112px #FFF , 1576px 1354px #FFF , 1689px 944px #FFF , 963px 156px #FFF , 746px 881px #FFF , 416px 250px #FFF , 789px 96px #FFF , 1972px 102px #FFF , 1222px 695px #FFF , 174px 389px #FFF , 758px 902px #FFF , 1001px 1395px #FFF , 919px 360px #FFF , 812px 350px #FFF , 625px 1579px #FFF , 834px 1677px #FFF , 377px 603px #FFF , 1689px 218px #FFF , 623px 1655px #FFF , 587px 444px #FFF , 449px 1529px #FFF , 453px 770px #FFF , 1877px 1409px #FFF , 1136px 1908px #FFF , 791px 855px #FFF , 1943px 1940px #FFF , 1952px 144px #FFF , 585px 521px #FFF , 1610px 527px #FFF , 1662px 1062px #FFF , 1132px 1627px #FFF , 1244px 1175px #FFF , 1388px 186px #FFF , 721px 576px #FFF , 150px 193px #FFF , 1406px 422px #FFF , 655px 981px #FFF , 1190px 1967px #FFF , 677px 556px #FFF , 1305px 1868px #FFF , 513px 697px #FFF , 847px 801px #FFF , 838px 50px #FFF , 933px 184px #FFF , 38px 1099px #FFF , 722px 1934px #FFF , 594px 731px #FFF , 692px 334px #FFF , 330px 1194px #FFF , 710px 1635px #FFF , 802px 805px #FFF , 681px 1203px #FFF , 1319px 1181px #FFF , 951px 1708px #FFF , 62px 780px #FFF , 1782px 612px #FFF , 968px 803px #FFF , 604px 1133px #FFF , 1153px 1368px #FFF , 1881px 1297px #FFF , 278px 304px #FFF , 1875px 1155px #FFF , 687px 974px #FFF;
animation: animStar 100s linear infinite;
}
#stars2:after {
content: " ";
position: absolute;
top: 2000px;
width: 2px;
height: 2px;
background: transparent;
box-shadow: 179px 816px #FFF , 1999px 214px #FFF , 141px 721px #FFF , 788px 212px #FFF , 1231px 164px #FFF , 1840px 1132px #FFF , 1724px 1942px #FFF , 1616px 614px #FFF , 920px 846px #FFF , 1477px 114px #FFF , 1475px 1466px #FFF , 919px 629px #FFF , 1399px 345px #FFF , 1353px 388px #FFF , 470px 1986px #FFF , 218px 1045px #FFF , 1881px 1795px #FFF , 1157px 1358px #FFF , 1635px 1472px #FFF , 1235px 176px #FFF , 1529px 801px #FFF , 51px 185px #FFF , 1322px 1396px #FFF , 583px 1088px #FFF , 1811px 1699px #FFF , 714px 1608px #FFF , 848px 1771px #FFF , 1240px 362px #FFF , 695px 1704px #FFF , 416px 133px #FFF , 1945px 1342px #FFF , 329px 942px #FFF , 442px 148px #FFF , 948px 1956px #FFF , 1639px 1019px #FFF , 920px 1814px #FFF , 1868px 908px #FFF , 1631px 1717px #FFF , 1952px 1113px #FFF , 486px 1388px #FFF , 144px 99px #FFF , 1154px 305px #FFF , 402px 1708px #FFF , 1375px 356px #FFF , 1999px 1910px #FFF , 1935px 1366px #FFF , 401px 884px #FFF , 1830px 1085px #FFF , 1768px 960px #FFF , 493px 179px #FFF , 810px 1791px #FFF , 99px 923px #FFF , 180px 1570px #FFF , 719px 1078px #FFF , 1780px 523px #FFF , 841px 1474px #FFF , 368px 226px #FFF , 1669px 1543px #FFF , 1433px 1077px #FFF , 1943px 1187px #FFF , 1060px 6px #FFF , 965px 333px #FFF , 1726px 836px #FFF , 375px 1959px #FFF , 183px 598px #FFF , 492px 596px #FFF , 64px 1767px #FFF , 155px 1972px #FFF , 1831px 698px #FFF , 863px 692px #FFF , 212px 261px #FFF , 865px 168px #FFF , 234px 641px #FFF , 1858px 1144px #FFF , 1762px 1158px #FFF , 43px 1465px #FFF , 1152px 351px #FFF , 1521px 1437px #FFF , 345px 21px #FFF , 1057px 1246px #FFF , 1229px 229px #FFF , 469px 589px #FFF , 422px 820px #FFF , 277px 2000px #FFF , 1172px 1302px #FFF , 1571px 1405px #FFF , 352px 307px #FFF , 1413px 1624px #FFF , 640px 549px #FFF , 9px 1197px #FFF , 859px 1964px #FFF , 164px 1259px #FFF , 530px 4px #FFF , 1073px 1058px #FFF , 228px 1590px #FFF , 1954px 1802px #FFF , 306px 835px #FFF , 1658px 1826px #FFF , 1528px 505px #FFF , 556px 1190px #FFF , 1613px 33px #FFF , 218px 191px #FFF , 223px 1967px #FFF , 800px 625px #FFF , 1640px 1913px #FFF , 1478px 475px #FFF , 1734px 1588px #FFF , 1693px 1194px #FFF , 179px 1282px #FFF , 899px 1913px #FFF , 26px 917px #FFF , 619px 214px #FFF , 1316px 1146px #FFF , 1888px 923px #FFF , 1986px 1634px #FFF , 20px 1709px #FFF , 913px 226px #FFF , 1061px 1762px #FFF , 881px 1709px #FFF , 1892px 674px #FFF , 1902px 1370px #FFF , 1088px 1285px #FFF , 1390px 1993px #FFF , 724px 1987px #FFF , 1986px 405px #FFF , 1717px 339px #FFF , 1247px 740px #FFF , 1834px 1112px #FFF , 439px 1161px #FFF , 1595px 204px #FFF , 566px 1222px #FFF , 856px 1935px #FFF , 768px 1038px #FFF , 897px 111px #FFF , 1259px 613px #FFF , 995px 324px #FFF , 1063px 697px #FFF , 1396px 112px #FFF , 1576px 1354px #FFF , 1689px 944px #FFF , 963px 156px #FFF , 746px 881px #FFF , 416px 250px #FFF , 789px 96px #FFF , 1972px 102px #FFF , 1222px 695px #FFF , 174px 389px #FFF , 758px 902px #FFF , 1001px 1395px #FFF , 919px 360px #FFF , 812px 350px #FFF , 625px 1579px #FFF , 834px 1677px #FFF , 377px 603px #FFF , 1689px 218px #FFF , 623px 1655px #FFF , 587px 444px #FFF , 449px 1529px #FFF , 453px 770px #FFF , 1877px 1409px #FFF , 1136px 1908px #FFF , 791px 855px #FFF , 1943px 1940px #FFF , 1952px 144px #FFF , 585px 521px #FFF , 1610px 527px #FFF , 1662px 1062px #FFF , 1132px 1627px #FFF , 1244px 1175px #FFF , 1388px 186px #FFF , 721px 576px #FFF , 150px 193px #FFF , 1406px 422px #FFF , 655px 981px #FFF , 1190px 1967px #FFF , 677px 556px #FFF , 1305px 1868px #FFF , 513px 697px #FFF , 847px 801px #FFF , 838px 50px #FFF , 933px 184px #FFF , 38px 1099px #FFF , 722px 1934px #FFF , 594px 731px #FFF , 692px 334px #FFF , 330px 1194px #FFF , 710px 1635px #FFF , 802px 805px #FFF , 681px 1203px #FFF , 1319px 1181px #FFF , 951px 1708px #FFF , 62px 780px #FFF , 1782px 612px #FFF , 968px 803px #FFF , 604px 1133px #FFF , 1153px 1368px #FFF , 1881px 1297px #FFF , 278px 304px #FFF , 1875px 1155px #FFF , 687px 974px #FFF;
}

#stars3 {
width: 3px;
height: 3px;
background: transparent;
box-shadow: 918px 405px #FFF , 290px 479px #FFF , 757px 420px #FFF , 620px 895px #FFF , 689px 930px #FFF , 598px 184px #FFF , 571px 632px #FFF , 981px 421px #FFF , 934px 55px #FFF , 1699px 612px #FFF , 902px 421px #FFF , 824px 1853px #FFF , 734px 1400px #FFF , 479px 602px #FFF , 1975px 1625px #FFF , 406px 808px #FFF , 654px 249px #FFF , 1858px 1277px #FFF , 559px 421px #FFF , 1847px 1675px #FFF , 1932px 1457px #FFF , 704px 1990px #FFF , 128px 1539px #FFF , 1024px 1482px #FFF , 1640px 1951px #FFF , 1181px 1585px #FFF , 451px 180px #FFF , 1444px 928px #FFF , 1684px 1958px #FFF , 1970px 1838px #FFF , 1751px 1454px #FFF , 516px 926px #FFF , 153px 1593px #FFF , 1428px 758px #FFF , 1247px 1544px #FFF , 860px 1554px #FFF , 1822px 904px #FFF , 1185px 735px #FFF , 349px 1346px #FFF , 897px 105px #FFF , 1867px 1602px #FFF , 168px 1089px #FFF , 276px 328px #FFF , 1514px 1360px #FFF , 59px 72px #FFF , 6px 988px #FFF , 1020px 699px #FFF , 1491px 558px #FFF , 1394px 486px #FFF , 1835px 555px #FFF , 385px 1817px #FFF , 1474px 878px #FFF , 1495px 1596px #FFF , 1998px 1922px #FFF , 827px 69px #FFF , 1238px 530px #FFF , 1462px 1276px #FFF , 1330px 686px #FFF , 1988px 1011px #FFF , 1072px 486px #FFF , 671px 1231px #FFF , 1228px 718px #FFF , 359px 1055px #FFF , 6px 483px #FFF , 1892px 489px #FFF , 1579px 1160px #FFF , 1979px 1505px #FFF , 589px 936px #FFF , 302px 1325px #FFF , 968px 331px #FFF , 920px 1040px #FFF , 858px 1956px #FFF , 208px 32px #FFF , 1408px 1697px #FFF , 637px 547px #FFF , 1141px 163px #FFF , 894px 574px #FFF , 1481px 1169px #FFF , 1790px 934px #FFF , 486px 1849px #FFF , 145px 314px #FFF , 956px 1973px #FFF , 1693px 620px #FFF , 1601px 1590px #FFF , 162px 676px #FFF , 1550px 1797px #FFF , 1244px 1871px #FFF , 418px 699px #FFF , 1605px 659px #FFF , 316px 1966px #FFF , 1491px 1588px #FFF , 1914px 559px #FFF , 1409px 1192px #FFF , 819px 406px #FFF , 178px 456px #FFF , 574px 1299px #FFF , 783px 1202px #FFF , 1263px 835px #FFF , 388px 1462px #FFF , 704px 861px #FFF;
animation: animStar 150s linear infinite;
}
#stars3:after {
content: " ";
position: absolute;
top: 2000px;
width: 3px;
height: 3px;
background: transparent;
box-shadow: 918px 405px #FFF , 290px 479px #FFF , 757px 420px #FFF , 620px 895px #FFF , 689px 930px #FFF , 598px 184px #FFF , 571px 632px #FFF , 981px 421px #FFF , 934px 55px #FFF , 1699px 612px #FFF , 902px 421px #FFF , 824px 1853px #FFF , 734px 1400px #FFF , 479px 602px #FFF , 1975px 1625px #FFF , 406px 808px #FFF , 654px 249px #FFF , 1858px 1277px #FFF , 559px 421px #FFF , 1847px 1675px #FFF , 1932px 1457px #FFF , 704px 1990px #FFF , 128px 1539px #FFF , 1024px 1482px #FFF , 1640px 1951px #FFF , 1181px 1585px #FFF , 451px 180px #FFF , 1444px 928px #FFF , 1684px 1958px #FFF , 1970px 1838px #FFF , 1751px 1454px #FFF , 516px 926px #FFF , 153px 1593px #FFF , 1428px 758px #FFF , 1247px 1544px #FFF , 860px 1554px #FFF , 1822px 904px #FFF , 1185px 735px #FFF , 349px 1346px #FFF , 897px 105px #FFF , 1867px 1602px #FFF , 168px 1089px #FFF , 276px 328px #FFF , 1514px 1360px #FFF , 59px 72px #FFF , 6px 988px #FFF , 1020px 699px #FFF , 1491px 558px #FFF , 1394px 486px #FFF , 1835px 555px #FFF , 385px 1817px #FFF , 1474px 878px #FFF , 1495px 1596px #FFF , 1998px 1922px #FFF , 827px 69px #FFF , 1238px 530px #FFF , 1462px 1276px #FFF , 1330px 686px #FFF , 1988px 1011px #FFF , 1072px 486px #FFF , 671px 1231px #FFF , 1228px 718px #FFF , 359px 1055px #FFF , 6px 483px #FFF , 1892px 489px #FFF , 1579px 1160px #FFF , 1979px 1505px #FFF , 589px 936px #FFF , 302px 1325px #FFF , 968px 331px #FFF , 920px 1040px #FFF , 858px 1956px #FFF , 208px 32px #FFF , 1408px 1697px #FFF , 637px 547px #FFF , 1141px 163px #FFF , 894px 574px #FFF , 1481px 1169px #FFF , 1790px 934px #FFF , 486px 1849px #FFF , 145px 314px #FFF , 956px 1973px #FFF , 1693px 620px #FFF , 1601px 1590px #FFF , 162px 676px #FFF , 1550px 1797px #FFF , 1244px 1871px #FFF , 418px 699px #FFF , 1605px 659px #FFF , 316px 1966px #FFF , 1491px 1588px #FFF , 1914px 559px #FFF , 1409px 1192px #FFF , 819px 406px #FFF , 178px 456px #FFF , 574px 1299px #FFF , 783px 1202px #FFF , 1263px 835px #FFF , 388px 1462px #FFF , 704px 861px #FFF;
}

#title {
position: absolute;
top: 50%;
left: 0;
right: 0;
color: #FFF;
text-align: center;
font-family: "lato", sans-serif;
font-weight: 300;
font-size: 50px;
letter-spacing: 10px;
margin-top: -60px;
padding-left: 10px;
}
#title span {
background: -webkit-linear-gradient(white, #38495a);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}

@keyframes animStar {
from {
  transform: translateY(0px);
}
to {
  transform: translateY(-2000px);
}
}

</style>

  </body>
</html>
