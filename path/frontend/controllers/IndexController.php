<?php

namespace frontend\controllers;
use Yii;
class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /*接受积分*/
    public function actionQian(){
        $qian=$_GET['qian'];
        date_default_timezone_set('PRC');
        $date=date('Y-m-d');
       // $time1=date('Y-m-d');
        //$time2=date('Y-m-d');
//        $a=time();
//        echo $a;die;
//        echo $time;die;
//        $time='2016-07-30';//1469808000  1469721600  1469808000 31:1469894400 1469721600
       // $end=strtotime($time);
//        echo $end;die;//1469894400
       //$date=strtotime($time1);
        //$one_time=strtotime($time2);
//        echo $one_time;die;//1469894400//1470240000
//        echo $end;die;//1469721600
//        echo $date;die;
//        $day=$_GET['day'];
        //echo $qian;die;
        $connection = \Yii::$app->db;
        $posts = $connection->createCommand('SELECT * FROM yue')->queryOne();
//        echo $end+(24*2*3600);die;//1470240000
//        echo $command['time']+(24*3600);die;//1470240000   1470585600
//        print_r($command);die;
        if($posts['time']==$date){
            echo 1;die;
//        }else if($command['time']==$end+(24*3600)){
////            $day=$command['day']+1;
////            $arr = $connection->createCommand("UPDATE yue SET `day`=1,qian=1,jifen=1,lian=1,`time`=$date WHERE id=$command[id]")->execute();
//            $arr = $connection->createCommand("UPDATE yue SET `day`=$qian+1,qian=$qian+1,jifen=$command[jifen]+$command[qian]+1,lian=$command[lian]+1,`time`=$date WHERE id=$command[id]")->execute();
////          $arr = $connection->createCommand("UPDATE yue SET `day`=$command[day]+1,qian=$command[qian]*2,jifen=$command[jifen]+$command[qian]+1,lian=$command[lian]+1,`time`=$date WHERE id=$command[id]")->execute();
////           print_r($arr);die;
//            $str="";
//            if($arr){
//                $command = $connection->createCommand('SELECT * FROM yue')->queryOne();
//                $str.="<span>";
//                $str.="今日已签到，获得积分".$command['qian']."分";
//                $str.="</span>";
//                $str.="<table border='1' id='aa'>";
//                $str.="<tr>";
//                $str.="<td>";
//                $str.="总计签到";
//                $str.="</td>";
//                $str.="<td>";
//                $str.="最近连续签到";
//                $str.="</td>";
//                $str.="<td>";
//                $str.="获得积分";
//                $str.="</td>";
//                $str.="</tr>";
//                $str.="<tr>";
//                $str.="<td>";
//                $str.=$command['lian']."次";
//                $str.="</td>";
//                $str.="<td>";
//                $str.=$command['day']."天";
//                $str.="</td>";
//                $str.="<td>";
//                $str.=$command['jifen']."分";
//                $str.="</td>";
//                $str.="</tr>";
//                $str.="</table>";
//                echo $str;
//            }
        }else {
            $num = $posts['qian'] + 1;
            if (strtotime($posts['time']) + 24 * 3600 == strtotime($date)) {
                $day = $posts['day'] + 1;
                $score = $posts['jifen'] + $day;
                Yii::$app->db->createCommand()->update('yue', [
                    'qian' => $num,
                    'day' => $day,
                    'jifen' => $score,
                    'time' => $date,
                ], "id=3")->execute();
            } else {
                $day = 1;
                $score = $posts['jifen'] + 1;
                Yii::$app->db->createCommand()->update('yue', [
                    'qian' => $num,
                    'day' => $day,
                    'jifen' => $score,
                    'time' => $date,
                ], "id=3")->execute();
            }
            $command = $connection->createCommand('SELECT * FROM yue')->queryOne();
              $str = "";
                $str .= "<span>";
                $str .= "今日已签到，获得积分" . $command['qian'] . "分";
                $str .= "</span>";
                $str .= "<table border='1' id='aa'>";
                $str .= "<tr>";
                $str .= "<td>";
                $str .= "总计签到";
                $str .= "</td>";
                $str .= "<td>";
                $str .= "最近连续签到";
                $str .= "</td>";
                $str .= "<td>";
                $str .= "获得积分";
                $str .= "</td>";
                $str .= "</tr>";
                $str .= "<tr>";
                $str .= "<td>";
                $str .= $command['lian'] . "次";
                $str .= "</td>";
                $str .= "<td>";
                $str .= $command['day'] . "天";
                $str .= "</td>";
                $str .= "<td>";
                $str .= $command['jifen'] . "分";
                $str .= "</td>";
                $str .= "</tr>";
                $str .= "</table>";
                echo $str;
        }
    }
    //签到处理
   /* public function actionQian1(){
        date_default_timezone_set('PRC');
//        $time=date('Y-m-d');
        $date=date('Y-m-d');
        //echo $date;die;
        $sql='select * from yue';
        $posts=Yii::$app->db->createCommand($sql)->queryOne();
        //print_r($posts);die;

        if($posts['time']==$date){
            echo 1;
        }else{
            $num=$posts['qian']+1;
            if(strtotime($posts['time'])+24*3600==strtotime($date)){
                $day=$posts['day']+1;
                $score=$posts['jifen']+$day;
                Yii::$app->db->createCommand()->update('yue',[
                    'qian'=>$num,
                    'day'=>$day,
                    'jifen'=>$score,
                    'time'=>$date,
                ],"id=3")->execute();
            }else{
                $day=1;
                $score=$posts['jifen']+1;
                Yii::$app->db->createCommand()->update('yue',[
                    'qian'=>$num,
                    'day'=>$day,
                    'jifen'=>$score,
                    'time'=>$date,
                ],"id=3")->execute();
            }
            $sql='select * from yue';
            $posts=Yii::$app->db->createCommand($sql)->queryAll();
            $str='';
            $str.='<span>获得积分'.$posts[0]['day'].'分</span>';
            $str.='<table border="1">';
            $str.='<tr>';
            $str.='<td>总计签到</td>';
            $str.='<td>最近连续签到</td>';
            $str.='<td>获得积分</td>';
            $str.='</tr>';
            foreach($posts as $v) {
                $str.='<tr>';
                $str.='<td>'.$v['qian'].'</td>';
                $str.='<td>'.$v['day'].'</td>';
                $str.='<td>'.$v['jifen'].'</td>';
                $str.='</tr>';
            }
            $str.='</table>';
            echo $str;
        }

    }*/

}
